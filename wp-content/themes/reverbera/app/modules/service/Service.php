<?php

namespace App\Classes\Modules\Service;

use App\Models\PostType;

class Service extends PostType {
	private $gallery;
	private $iconID;

	public function __construct( \WP_Post $service = null ) {

		parent::__construct( $service, 'thumb_service' );

		$this->gallery = get_post_meta($service->ID, 'gallery', true);
		$this->iconID  = $service->{'icon_id'};
	}

	public function getGallery() {
		return $this->gallery;
	}

	public function getIconID() {
		return $this->iconID;
	}

}
