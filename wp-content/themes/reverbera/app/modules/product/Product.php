<?php

namespace App\Modules\Product;

class Product {
	private $ID;
	private $title;
	private $content;
	private $thumbnailID;
	private $featured;
	private $model;
	private $gallery;
	private $price;
	private $instalmentQuantity;
	private $instalmentValue;
	private $visualizations;

	public function __construct( \WP_Post $product ) {
		$this->ID                 = $product->ID;
		$this->title              = $product->post_title;
		$this->content            = apply_filters( "the_content", $product->post_content );
		$this->thumbnailID        = $product->{"_thumbnail_id"};
		$this->featured           = $product->{"featured"};
		$this->model              = $product->{"model"};
		$this->gallery            = get_post_meta( $product->ID, 'gallery', true );
		$this->price              = $product->{"price"};
		$this->instalmentQuantity = $product->{"instalment_quantity"};
		$this->visualizations     = $product->{"visualizations"};
		$this->setInstalmentValue();
	}

	public function getID() {
		return $this->ID;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getContent() {
		return $this->content;
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

	public function isFeatured() {
		return 1 === intval( $this->featured );
	}

	public function getModel() {
		return $this->model;
	}

	public function getGallery() {
		return $this->gallery;
	}

	public function getPrice() {
		return $this->price;
	}

	public function getFormattedPrice() {
		return number_format( $this->price, 2, ',', '.' );
	}

	public function getInstalmentQuantity() {
		return $this->instalmentQuantity;
	}

	public function getInstalmentValue() {
		return $this->instalmentValue;
	}

	public function getVisualizations() {
		return $this->visualizations;
	}

	public function setVisualizations( $visualizations ) {
		$this->visualizations = $visualizations;
	}

	private function setInstalmentValue() {
		if ( empty( $this->price ) ) {
			return null;
		}

		$instalmentValue = $this->price / $this->instalmentQuantity;

		$this->instalmentValue = number_format( $instalmentValue, 2, ',', '.' );
	}

}