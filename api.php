<?php

use App\ArticleRepository;
use App\ArticleRepositoryInterface;

require_once __DIR__ . '/vendor/autoload.php';
session_start();
// Instantiate the ArticleRepository or any other class that implements ArticleServiceInterface
$articleService = new ArticleRepository();

const PREFIX_SEARCH = 'prefixsearch',
TITLE = 'title',
CONTENT = 'content',
ERROR = 'error',
ARTICLE_CACHE_PREFIX = 'article_%s',
PREFIX_SEARCH_CACHE_PREFIX = 'prefix_%s';

// Expiry time for cached data (60 seconds)
const CACHE_EXPIRY = 60;

// Route handling for API
header( 'Content-Type: application/json' );

// Mapping array associating request parameters with handler functions
$handlers = [
	PREFIX_SEARCH => 'handlePrefixSearch',
	TITLE => 'handleArticleFetch',
];

// Determine which handler to use based on request parameters
$handler = null;
foreach ( $handlers as $param => $handlerName ) {
	if ( isset( $_GET[$param] ) ) {
		$handler = $handlerName;
		break;
	}
}

// Execute the handler if found, otherwise return list of articles
if ( $handler !== null ) {
	try {
		$handler( $articleService, $_GET[$param] );
	} catch ( InvalidArgumentException $e ) {
		echo json_encode( [ ERROR => $e->getMessage() ] );
	}
} else {
	echo json_encode( [ CONTENT => ( $articleService )->getListOfArticles() ] );
}

/**
 * Function to handle Prefix Search
 *
 * @param ArticleRepositoryInterface $articleService
 * @param string $prefix
 * @return void
 */
function handlePrefixSearch( ArticleRepositoryInterface $articleService, $prefix ) {
	// Validate prefix input
	$prefix = validateAndSanitizeInput( $prefix );

	// Check if the result is cached
	$cacheKey = strtolower( sprintf( PREFIX_SEARCH_CACHE_PREFIX, $prefix ) );
	$cachedData = getValidCachedData( $cacheKey );
	if ( $cachedData !== false ) {
		echo $cachedData;
		return;
	}

	// Get list of articles
	$list = $articleService->getListOfArticles();

	// Filter articles matching the prefix
	$matchedArticles = array_filter( $list, static function ( $article ) use ( $prefix ) {
		// Match articles starting with the prefix
		return strpos( strtolower( $article ), strtolower( $prefix ) ) === 0;
	} );

	$response = json_encode( [ CONTENT => $matchedArticles ] );

	// Cache the result in session for future requests
	setCacheData( $cacheKey, $response );

	// Return matched articles
	echo $response;
}

/**
 * Function to handle article fetch
 *
 * @param ArticleRepositoryInterface $articleService
 * @param string $title
 * @return void
 */
function handleArticleFetch( ArticleRepositoryInterface $articleService, $title ) {
	// Validate title input
	$title = validateAndSanitizeInput( $title );

	// Check if the result is cached
	$cacheKey = strtolower( sprintf( ARTICLE_CACHE_PREFIX, $title ) );
	$cachedData = getValidCachedData( $cacheKey );
	if ( $cachedData !== false ) {
		echo $cachedData;
		return;
	}

	// Fetch article content
	$article = $articleService->fetch( $title );
	if ( !empty( $article ) ) {
		$response = [ CONTENT => $article ];
	} else {
		$response = [ ERROR => 'Article not found' ];
	}

	// Cache the result in session for future requests
	setCacheData( $cacheKey, $response );

	echo json_encode( $response );
}

/**
 * @param string $input
 * @return string|void
 */
function validateAndSanitizeInput( $input ) {
	// Allow alphanumeric characters and hyphen
	if ( !preg_match( '/^[a-zA-Z0-9\s-]+$/', $input ) ) {
		echo json_encode( [ ERROR => 'Invalid input. Only alphanumeric characters and hyphen are allowed.' ] );
		exit();
	}
	return htmlspecialchars( $input, ENT_QUOTES );
}

/**
 * Validate cached data and return if still valid, otherwise return false
 *
 * @param string $cacheKey
 * @return mixed
 */
function getValidCachedData( $cacheKey ) {
	if ( isset( $_SESSION[$cacheKey] ) && ( time() - $_SESSION[$cacheKey]['timestamp'] ) < CACHE_EXPIRY ) {
		return $_SESSION[$cacheKey]['data'];
	}
	return false;
}

/**
 * Cache data in session
 *
 * @param string $cacheKey
 * @param mixed $data
 * @return void
 */
function setCacheData( $cacheKey, $data ) {
	$_SESSION[$cacheKey] = [
		'data' => json_encode( $data ),
		'timestamp' => time()
	];
}
