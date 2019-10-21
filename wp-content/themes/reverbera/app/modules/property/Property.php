<?php

namespace App\Modules\Property;

class Property {
	private $ID;
	private $code;
	private $title;
	private $description;
	private $address;
	private $neighborhood;
	private $city;
	private $state;
	private $adType;
	private $type;
	private $price;
	private $thumbnailID;
	private $gallery;
	private $bedrooms;
	private $toilets;
	private $parkingLots;
	private $buildingArea;
	private $totalArea;
	private $pool;
	private $featured;
	private $release;
	private $permalink;

	public function __construct( \WP_Post $itemPost ) {
		$this->ID           = $itemPost->ID;
		$this->code         = $itemPost->{'code'};
		$this->title        = $itemPost->post_title;
		$this->description  = $itemPost->{'description'};
		$this->address      = $itemPost->{'address'};
		$this->neighborhood = $itemPost->{'neighborhood'};
		$this->city         = $itemPost->{'city'};
		$this->state        = $itemPost->{'state'};
		$this->adType       = $itemPost->{'ad_type'};
		$this->type         = $itemPost->{'type'};
		$this->price        = $itemPost->{'price'};
		$this->thumbnailID  = $itemPost->{'_thumbnail_id'};
		$this->gallery      = $itemPost->{'gallery'};
		$this->bedrooms     = $itemPost->{'bedrooms'};
		$this->toilets      = $itemPost->{'toilets'};
		$this->parkingLots  = $itemPost->{'parking_lots'};
		$this->buildingArea = $itemPost->{'building_area'};
		$this->totalArea    = $itemPost->{'total_area'};
		$this->pool         = $itemPost->{'pool'};
		$this->featured     = $itemPost->{'featured'};
		$this->release      = $itemPost->{'release'};
		$this->permalink    = get_permalink( $itemPost );
	}

	public function getID() {
		return $this->ID;
	}

	public function getCode() {
		return $this->code;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getDescription() {
		return $this->description;
	}

	public function getAddress() {
		return $this->address;
	}

	public function getNeighborhood() {
		return $this->neighborhood;
	}

	public function getCity() {
		return $this->city;
	}

	public function getState() {
		return $this->state;
	}

	public function getAdType() {
		return $this->adType;
	}

	public function getType() {
		return $this->type;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

	public function getGallery() {
		return $this->gallery;
	}

	public function getBedrooms() {
		return $this->bedrooms;
	}

	public function getToilets() {
		return $this->toilets;
	}

	public function getParkingLots() {
		return $this->parkingLots;
	}

	public function getBuildingArea() {
		return $this->buildingArea;
	}

	public function getTotalArea() {
		return $this->totalArea;
	}

	public function hasPool() {
		return 1 === intval( $this->pool );
	}

	public function isFeatured() {
		return 1 === intval( $this->featured );
	}

	public function isRelease() {
		return 1 === intval( $this->release );
	}

	public function getPermalink() {
		return $this->permalink;
	}

	public function getFormattedPrice() {
		return ! empty( $this->price ) ? number_format( $this->price, 2, ',', '.' ) : null;
	}

	public function getFormattedAddress() {

		$state = ! empty( $this->state ) ? " - " . $this->state : '';

		if ( ! empty( $this->neighborhood ) && ! empty( $this->city ) ) {
			return $this->neighborhood . ", " . $this->city . $state;
		} else if ( ! empty( $this->neighborhood ) ) {
			return $this->neighborhood;
		} else if ( ! empty( $this->city ) ) {
			return $this->city . $state;
		} else {
			return null;
		}
	}

}
