<?php

namespace Tests;

use App\ArticleRepository;

/**
 * @coversDefaultClass ArticleRepository
 */
class AppTest extends \PHPUnit\Framework\TestCase {

	/**
	 * @covers ::fetch
	 */
	public function testFetch() {
		$app = new ArticleRepository();
		$x = $app->fetch( [ 'title' => 'Foo' ] );
		$this->assertStringContainsString( 'Use of metasyntactic variables', $x );
	}
}
