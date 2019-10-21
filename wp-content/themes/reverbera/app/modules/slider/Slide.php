<?php

namespace App\Modules\Slider;

class Slide {
	private $ID;
	private $thumbnailID;
	private $link;
	private $target;
	private $location;

	public function __construct( \WP_Post $slider ) {
		$this->ID          = $slider->ID;
		$this->link        = $slider->{'link'};
		$this->target      = $slider->{'target'};
		$this->location    = $slider->{'location'};
		$this->thumbnailID = $slider->{'_thumbnail_id'};
	}

	public function getID() {
		return $this->ID;
	}

	public function getTarget() {
		return $this->target;
	}

	public function getLink() {
		return $this->link;
	}

	public function hasLink() {
		return ! empty( $this->link );
	}

	public function getLocation() {
		return $this->location;
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

	public function selectedLocation( $location ) {
		if ( $location === $this->location ) {
			echo 'selected';
		}
	}

	public function checkedTarget( $target ) {
		if ( $target === $this->target ) {
			echo 'checked';
		}
	}
}
