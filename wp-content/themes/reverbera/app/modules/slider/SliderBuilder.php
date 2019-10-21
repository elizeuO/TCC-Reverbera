<?php

namespace App\Modules\Slider;

use App\Models\CustomPostType;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class SliderBuilder extends CustomPostType {

	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'slider',
			[ 'singular' => 'Slide', 'plural' => 'Slides' ],
			'dashicons-images-alt2',
			[ 'title', 'thumbnail' ]
		);

		$bootstrap->registerAssets( $this->postType );
	}

	public function register() {
		parent::register();
		$this->addThumbColumnInAdminList();
		$this->removePreviewButton();

		$this->changePublishButtonText( [
			'publish'   => 'Cadastrar',
			'published' => 'Cadastrado',
			'update'    => 'Salvar'
		] );

		$this->addImageSizes( [ [ 'thumb_slider', 2000, 650, true ] ] );
		$this->addMetaBoxes();
		$this->save();
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				'idx_link_slider',
				'Informações',
				function ( $post ) {
					$this->renderFields( $post );
				},
				$this->postType,
				'normal',
				'high'
			);
		} );
	}

	private function renderFields( $post ) {
		HelperProvider::registerNonce( $this->postType );
		$slide = new Slide( $post );

		require "partials/fields.php";
	}

	public static function registerAssets() {
		add_action( 'wp_enqueue_scripts', function () {
			$version = wp_get_theme()->get( 'Version' );
			self::enqueueStyles( $version );
			self::enqueueScripts( $version );
		} );
	}

	private static function enqueueStyles( $version ) {
		$stylesPath = get_template_directory_uri() . '/app/modules/slider/assets/styles/';

		wp_enqueue_style(
			'slick',
			$stylesPath . '/slick/slick.css',
			[],
			$version
		);

		wp_enqueue_style(
			'slick-theme',
			$stylesPath . '/slick/slick-theme.css',
			[],
			$version
		);

		wp_enqueue_style(
			'slick-custom',
			$stylesPath . '/slick/slick-custom.css',
			[],
			$version
		);
	}

	private static function enqueueScripts( $version ) {
		$scriptsPath = get_template_directory_uri() . '/app/modules/slider/assets/scripts';

		wp_enqueue_script(
			'slick',
			$scriptsPath . '/slick/slick.min.js',
			[ 'jquery' ],
			$version,
			true
		);

		wp_enqueue_script(
			'slick.appscripts',
			$scriptsPath . '/slick/slick.appscripts.js',
			[ 'slick' ],
			$version,
			true
		);
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $slideID ) {

			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return false;
			}

			$slideFields = isset( $_POST['slide'] ) ? $_POST['slide'] : [];

			if ( ! array_key_exists( 'target', $slideFields ) ) {
				$slideFields['target'] = '_self';
			}

			foreach ( $slideFields as $key => $value ) {
				update_post_meta( $slideID, $key, $value );
			}

			return true;
		} );
	}
}
