<?php

namespace App;

interface ArticleRepositoryInterface {
	public function save( $ttl, $bd );

	public function update( $ttl, $bd );

	public function fetch( $title );

	public function getListOfArticles();
}
