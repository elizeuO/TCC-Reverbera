<?php

namespace App\Modules\Client;

class Client {
	private $ID;
	private $name;
	private $link;
	private $thumbnailID;

	public function __construct( \WP_Post $client ) {
		$this->ID          = $client->ID;
		$this->name        = $client->post_title;
		$this->link        = $client->{"link"};
		$this->thumbnailID = $client->{"_thumbnail_id"};
	}

	public function getID() {
		return $this->ID;
	}

	public function getName() {
		return $this->name;
	}

	public function getLink() {
		return $this->link;
	}

	public function hasLink() {
		if ( ! empty( $this->link ) ) {
			return true;
		}

		return false;
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

}