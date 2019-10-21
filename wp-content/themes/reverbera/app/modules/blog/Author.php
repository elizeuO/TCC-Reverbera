<?php

namespace App\Modules\Blog;

class Author {
	private $ID;
	private $name;
	private $description;
	private $avatar;
	private $postsUrl;

	public function __construct( $authorID ) {
		$this->ID          = $authorID;
		$this->name        = get_the_author_meta( 'display_name', $authorID );
		$this->description = get_the_author_meta( 'description', $authorID );
		$this->avatar      = get_avatar_url( $authorID );
		$this->postsUrl    = get_author_posts_url( $authorID );
	}

	public function getID(): string {
		return $this->ID;
	}

	public function getName(): string {
		return $this->name;
	}

	public function getDescription(): string {
		return $this->description;
	}

	public function getAvatar() {
		return $this->avatar;
	}

	public function getPostsUrl(): string {
		return $this->postsUrl;
	}
}