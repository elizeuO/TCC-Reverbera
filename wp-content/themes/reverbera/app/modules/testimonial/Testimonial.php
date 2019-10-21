<?php

namespace App\Modules\Testimonial;

class Testimonial {
	private $ID;
	private $name;
	private $description;
	private $videoUrl;
	private $type;

	public function __construct( \WP_Post $itemPost = null ) {
		$this->ID          = $itemPost->ID;
		$this->name       = $itemPost->post_title;
		$this->description = $itemPost->{'description'};
		$this->videoUrl    = $itemPost->{'url'};
		$this->type        = $itemPost->{'testimonial_type'};
	}

	public function getID() {
		return $this->ID;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getVideoUrl() {
		return $this->videoUrl;
	}

	public function getEmbedVideoUrl() {
		$finalUrl = $this->convertYoutube( $this->videoUrl );

		return $finalUrl;
	}

	private function convertYoutube( $string ) {
		return preg_replace(
			"/\s*[a-zA-Z\/\/:\.]*youtu(be.com\/watch\?v=|.be\/)([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
			"<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/$2\" frameborder=\"0\"
            allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\"
            allowfullscreen></iframe>",
			$string
		);
	}

	public function getType() {
		return $this->type;
	}
}