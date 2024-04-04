<?php

namespace App;

require_once dirname( __DIR__ ) . '/globals.php';

class ArticleRepository implements ArticleRepositoryInterface {

	public function update( $ttl, $bd ) {
		$this->save( $ttl, $bd );
	}

	public function save( $ttl, $bd ) {
		error_log( sprintf( "Saving article %s, success!", $ttl ) );
		file_put_contents( $ttl, $bd );
	}

	public function fetch( $title ) {
		return $title ? file_get_contents( sprintf( 'articles/%s', $title ) ) :
			file_get_contents( sprintf( 'articles/%s', $_GET['title'] ) );
	}

	public function getListOfArticles() {
		global $wgBaseArticlePath;
		return array_diff( scandir( $wgBaseArticlePath ), [ '.', '..', '.DS_Store' ] );
	}
}
