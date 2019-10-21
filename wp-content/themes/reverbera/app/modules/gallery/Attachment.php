<?php


namespace App\Modules\Gallery;


class Attachment {
	private $ID;
	private $title;
	private $mimeType;
	private $url;

	public function __construct( \WP_Post $post, string $url = null ) {
		$this->ID       = $post->ID;
		$this->title    = $post->post_title;
		$this->mimeType = $post->post_mime_type;
		$this->url      = $url;
	}

	public function getID() {
		return $this->ID;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getMimeType() {
		return $this->mimeType;
	}

	public function getUrl() {
		return $this->url;
	}

	public function setUrl( string $url ) {
		$this->url = $url;
	}
}