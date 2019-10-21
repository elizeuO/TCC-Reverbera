<?php

namespace App\Models;

class PostType {
	protected $ID;
	protected $title;
	protected $publishedDate;
	protected $content;
	protected $unfilteredContent;
	protected $excerpt;
	protected $thumbnailID;
	protected $thumbnailUrl;
	protected $permalink;

	public function __construct( \WP_Post $itemPost = null, $thumbnailSize = 'full' ) {
		if ( is_null( $itemPost ) ) {
			return null;
		}

		$this->ID                = $itemPost->ID;
		$this->title             = $itemPost->post_title;
		$this->excerpt           = $itemPost->post_excerpt;
		$this->thumbnailID       = $itemPost->{'_thumbnail_id'};
		$this->unfilteredContent = $itemPost->post_content;
		$this->content           = apply_filters( 'the_content', $itemPost->post_content );
		$this->setPermalink( $itemPost );
		$this->setThumbnailUrl( $thumbnailSize );
		$this->setPublishedDate( $itemPost->post_date );
	}

	public function getID() {
		return $this->ID;
	}

	public function getTitle( $limitWords = 99999 ) {
		return wp_trim_words( $this->title, $limitWords );
	}

	protected function setPublishedDate( $publishedDate ) {
		if ( empty( $publishedDate ) ) {
			return null;
		}

		setlocale( LC_ALL, 'pt_BR', 'pt_BR.UTF-8', 'pt_BR.utf-8', 'portuguese_brazil' );
		$this->publishedDate = strftime( "%d de %B de %Y", strtotime( $publishedDate ) );
	}

	public function getPublishedDate() {
		return $this->publishedDate;
	}

	public function getThumbnailID() {
		return $this->thumbnailID;
	}

	public function getContent() {
		return $this->content;
	}

	public function getOnlyContentText( $limitWords = 99999 ) {
		return wp_trim_words( wp_strip_all_tags( $this->content ), $limitWords );
	}

	public function getExcerpt( $limitWords = 99999 ) {
		if ( empty( $this->excerpt ) ) {
			return $this->getOnlyContentText( $limitWords );
		}

		return wp_trim_words( $this->excerpt, $limitWords );
	}

	public function getThumbnailUrl() {
		return $this->thumbnailUrl;
	}

	public function setThumbnailUrl( $thumbnailSize ) {
		$imageUrl = wp_get_attachment_image_src( $this->thumbnailID, $thumbnailSize )[0];
		$imageSrc = str_replace( home_url( '/' ), ABSPATH, $imageUrl );

		if ( file_exists( $imageSrc ) ) {
			$this->thumbnailUrl = $imageUrl;
		}
	}

	protected function setPermalink( \WP_Post $itemPost ) {
		$this->permalink = get_permalink( $itemPost );
	}

	public function getPermalink() {
		return $this->permalink;
	}

	public function getNoFilteredContent() {
		return $this->unfilteredContent;
	}
}
