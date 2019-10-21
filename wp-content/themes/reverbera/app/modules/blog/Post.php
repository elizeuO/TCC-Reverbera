<?php

namespace App\Modules\Blog;

use App\Models\PostType;

class Post extends PostType {
	private $author;
	private $type;

	/**
	 * @param \WP_Post $itemPost
	 * @param string $imageSize
	 */
	public function __construct( \WP_Post $itemPost, $imageSize = 'thumb_blog' ) {
		parent::__construct( $itemPost, $imageSize );
		$this->author = new Author( $itemPost->post_author );
		$this->type   = $itemPost->{'type'};
	}

	public function getAuthor(): Author {
		return $this->author;
	}

	public function getType() {
		return $this->type;
	}

}