<?php

namespace App\Modules\Testimonial;

use App\Models\CustomPostType;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class TestimonialBuilder extends CustomPostType {

	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'testimonial',
			[
				'plural'   => 'Depoimentos',
				'singular' => 'Depoimento'
			],
			'dashicons-format-status'
		);

		$bootstrap->registerAssets( $this->postType );
	}

	public function register() {
		parent::register();

		$this->changeTitlePlaceholder( 'Nome' );
		$this->addMetaBoxes();
		$this->save();

		$this->addCustomColumnInAdminList( [
			'Url'  => [ 'metaKey' => 'url', 'title' => 'URL do Vídeo' ],
			'Type' => [ 'metaKey' => 'testimonial_type', 'title' => 'Tipo do Vídeo' ],
		] );

		$this->addCustomFilterByMetaKey( 'testimonial_type', [ 'type' => 'radio', 'value' => 'Texto' ], 'Texto' );
		$this->addCustomFilterByMetaKey( 'testimonial_type', [ 'type' => 'radio', 'value' => 'Texto' ], 'Texto' );
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			$testimonial = new Testimonial( new \WP_Post( get_post() ) );

			add_meta_box(
				'idx_testimonial',
				'Depoimento',
				function ( $post, $data ) {
					$this->showDescription( $data );
				},
				$this->postType,
				'normal',
				'high',
				[ $testimonial ]
			);

			add_meta_box(
				'testimonialType',
				'Tipo',
				function ( $post, $data ) {
					$this->showType( $data );
				},
				$this->postType,
				'side',
				'high',
				[ $testimonial ]
			);

			add_meta_box(
				'url_testimonials',
				'URL do Youtube do Vídeo',
				function ( $post, $data ) {
					$this->showVideoUrl( $data );
				},
				$this->postType,
				'normal',
				'high',
				[ $testimonial ]
			);
		} );
	}

	private function showDescription( $data ) {
		HelperProvider::registerNonce( $this->postType );
		$testimonial = $data['args'][0];

		include "partials/description.php";
	}

	private function showType( $data ) {
		HelperProvider::registerNonce( $this->postType );
		$testimonial = $data['args'][0];

		include "partials/type.php";
	}

	public function showVideoUrl( $data ) {
		HelperProvider::registerNonce( $this->postType );
		$testimonial = $data['args'][0];

		include "partials/url.php";
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $testimonialId ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return false;
			}

			update_post_meta( $testimonialId, "description", $_POST['description'] );
			update_post_meta( $testimonialId, 'url', $_POST['url'] );

			$testimonialFields = isset( $_POST['testimonial'] ) ? $_POST['testimonial'] : [];

			foreach ( $testimonialFields as $key => $value ) {
				update_post_meta( $testimonialId, $key, $value );
			}

			return true;
		} );
	}
}