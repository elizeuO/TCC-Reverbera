<?php

namespace App\Modules\Gallery;

class Gallery {
	private const NONCE_NAME = "idx_gallery_nonce";
	private $attachments;
	private $metaKey;
	private $postType;
	private $title;
	private $id;
	private $modulePath;

	public function __construct( $postType, $metaKey, $title, $id ) {
		$this->postType    = $postType;
		$this->metaKey     = $metaKey;
		$this->title       = $title;
		$this->id          = $id;
		$this->attachments = [];
		$this->modulePath  = get_template_directory_uri() . "/app/modules/gallery";
	}

	public function register() {
		$this->registerAssets();
		$this->addMetaBoxes();
		$this->save();
	}

	private function registerAssets() {
		add_action( 'admin_enqueue_scripts', function () {
			$version = wp_get_theme()->get( 'Version' );
			$this->registerStyles( $version );
			$this->registerScripts( $version );
		} );
	}

	private function registerStyles( $version ) {
		$stylesPath = $this->modulePath . "/assets/styles";

		wp_enqueue_style(
			'gallery-metabox',
			$stylesPath . '/gallery-metabox.css',
			[],
			$version
		);
	}

	private function registerScripts( $version ) {
		$scriptPath = $this->modulePath . "/assets/scripts";

		wp_enqueue_media();

		wp_enqueue_script(
			'GalleryController',
			$scriptPath . '/GalleryController.js',
			[ 'jquery-ui-sortable' ],
			$version,
			true
		);
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				$this->id,
				$this->title,
				[ $this, 'renderFormAttachments' ],
				$this->postType,
				'normal',
				'default'
			);
		} );
	}

	public function renderFormAttachments() {
		wp_nonce_field( 'idx_gallery', $this::NONCE_NAME );

		$this->attachments = get_post_meta( ( new \WP_Post( get_post() ) )->ID, $this->metaKey, true );

		require 'partials/form-gallery.php';
	}

	public function renderAttachments( $imagePath ) {
		if ( ! is_array( $this->attachments ) ) {
			return null;
		}

		foreach ( $this->attachments as $index => $attachmentIDs ) {

			$attachment = new Attachment( get_post( $attachmentIDs['id'] ) );
			$image      = null;

			switch ( $attachment->getMimeType() ) {
				case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
					$image = $imagePath . 'doc.png';
					break;
				case "application/pdf":
					$image = $imagePath . 'pdf.png';
					break;
				case "application/zip":
					$image = $imagePath . 'zip.png';
					break;
				case "application/vnd.ms-powerpoint":
					$image = $imagePath . 'ppt.png';
					break;
				case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
					$image = $imagePath . 'xls.png';
					break;
				case "image/png":
				case "image/jpeg":
				case "image/gif":
					$image = wp_get_attachment_url( $attachment->getID() );
					break;
				default:
					$image = $imagePath . 'file.png';
			}

			$attachment->setUrl( $image );

			include "partials/item-gallery.php";
		}
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $postID ) {

			if ( ! isset( $_POST[ $this::NONCE_NAME ] ) || ! wp_verify_nonce( $_POST[ $this::NONCE_NAME ], 'idx_gallery' ) ) {
				return false;
			}

			$gallery = isset( $_POST[ $this->metaKey ] ) ? $_POST[ $this->metaKey ] : [];

			update_post_meta( $postID, $this->metaKey, $gallery );

			return true;
		} );
	}
}
