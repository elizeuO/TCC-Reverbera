<?php

namespace App\Provider\Attachment;

use App\Provider\HelperProvider;

class AttachmentProvider {
	private $postType;
	private $metaOptions;
	private $attachmentID;
	private $attachmentUrl;

	/**
	 * @param string $postType: Post type to render de Attachment
	 * @param array $metaOptions: Parameter for to insert the title and meta_key to the meta_box
	 * eg.
	 * [
	 *      'title' => 'Title for meta_box',
	 *      'id'    => 'id_to_meta_box',
	 *      'key'   => 'meta_key_to_save_in_Postmeta'
	 * ]
	*/
	public function __construct( string $postType, array $metaOptions ) {
		$this->postType    = $postType;
		$this->metaOptions = $metaOptions;
	}

	public function register() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				$this->metaOptions['id'],
				$this->metaOptions['title'],
				[ $this, 'addAttachment' ],
				$this->postType,
				'side',
				'high'
			);
		} );

		$this->registerAssets();
		$this->save();
	}

	public function addAttachment() {
		HelperProvider::registerNonce( $this->postType );
		global $post;
		$this->attachmentID  = $post->{$this->metaOptions['key']};
		$this->attachmentUrl = HelperProvider::getImageUrlById( $this->attachmentID );

		include "partials/attachment.php";
	}

	private function registerAssets() {
		add_action( "current_screen", function ( $currentScreen ) {
			if ( $this->postType !== $currentScreen->id ) {
				return null;
			}

			add_action( "admin_enqueue_scripts", function () {
				$assetsPath = get_template_directory_uri() . "/app/provider/attachment/assets";
				$version    = wp_get_theme()->get( 'Version' );

				wp_enqueue_media();

				wp_enqueue_style(
					'attachment',
					$assetsPath . '/styles/attachment.css',
					[],
					$version
				);

				wp_enqueue_script(
					'Attachment',
					$assetsPath . '/scripts/Attachment.js',
					[],
					$version,
					true
				);
			} );
		} );
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $postID ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return null;
			}

			update_post_meta( $postID, $this->metaOptions['key'], $_POST[ $this->metaOptions['key'] ] );
		} );
	}
}