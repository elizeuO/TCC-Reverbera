<?php

namespace App\Modules\Taxonomy;

class Term implements \JsonSerializable {
	private $ID;
	private $name;
	private $description;
	private $slug;
	private $taxonomy;
	private $link;
	private $thumbnailID;

	public function __construct( \WP_Term $term = null ) {
		if ( is_null( $term ) ) {
			return null;
		}

		$this->ID              = $term->term_id;
		$this->name            = $term->name;
		$this->description     = $term->description;
		$this->slug            = $term->slug;
		$this->taxonomy        = $term->taxonomy;
		$this->thumbnailID     = $term->{'thumbnail_id'};
		$this->setLink( $term );
	}

	public function getID() {
		return $this->ID;
	}

	public function getName() {
		return $this->name;
	}

	public function getDescription( $limit = 99999 ) {
		return wp_trim_words( $this->description, $limit );
	}

	public function getSlug() {
		return $this->slug;
	}

	public function getLink() {
		return $this->link;
	}

	private function setLink( \WP_Term $term ) {
		$this->link = get_term_link( $term );
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

	public function jsonSerialize() {
		return get_object_vars( $this );
	}
}