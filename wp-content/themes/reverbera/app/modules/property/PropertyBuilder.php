<?php

namespace App\Modules\Property;

use App\Models\CustomPostType;
use App\Modules\Gallery\Gallery;
use App\Provider\Bootstrap\BootstrapProvider;

class PropertyBuilder extends CustomPostType {
	private const NONCE_NAME = 'idx_property_nonce';

	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'property',
			[ 'singular' => 'Imóvel', 'plural' => 'Imóveis' ],
			'dashicons-admin-multisite',
			[ 'title', 'thumbnail' ],
			[ 'slug' => 'imoveis' ]
		);

		$bootstrap->registerAssets( $this->postType );
	}

	public function register() {
		parent::register();

		$this->addThumbColumnInAdminList();
		$this->changePostsPerPage( 12, [ 'post_types' => [ $this->postType ], 'is_search' => true ] );
		$this->addImageSizes( [
			[ 'thumb_property', 365, 210, true ],
			[ 'thumb_property_slider', 2000, 575, true ],
			[ 'thumb_property_slider_single', 535, 355, true ]
		] );
		$this->addCustomColumnInAdminList( [ 'code' => [ 'metaKey' => 'code', 'title' => 'Código' ] ] );
		$this->addCustomColumnInAdminList( [ 'city' => [ 'metaKey' => 'city', 'title' => 'Cidade' ] ] );
		$this->addGallery();
		$this->addMetaBoxes();
		$this->registerAssets();
		$this->addRewriteRule();
		$this->addCustomFilterByMetaKey( 'code', [ 'type' => 'text' ], 'Código' );
		$this->addCustomFilterByMetaKey( 'release', [ 'type' => 'checkbox', 'value' => 1 ], 'Lançamento' );
		$this->addCustomFilterByMetaKey( 'featured', [ 'type' => 'checkbox', 'value' => 1 ], 'Destaque' );
		$this->addCustomFilterByMetaKey(
			'ad_type',
			[
				'type'    => 'select',
				'options' => [
					[ 'value' => 'rent', 'title' => 'Aluguel' ],
					[ 'value' => 'sale', 'title' => 'Venda' ],
				]
			],
			'Tipo de Anúncio'
		);
		$this->save();
	}

	private function addGallery() {
		$gallery = new Gallery( $this->postType, 'gallery', 'Galeria', 'property_gallery' );
		$gallery->register();
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			$property = new Property( new \WP_Post( get_post() ) );

			add_meta_box(
				'property_info',
				'Informações',
				[ $this, 'showInformation' ],
				$this->postType,
				'normal',
				'high',
				[ $property ]
			);

			add_meta_box(
				'property_features',
				'Características',
				[ $this, 'showFeatures' ],
				$this->postType,
				'normal',
				'high',
				[ $property ]
			);
		} );
	}

	public function showInformation( $post, $data ) {
		wp_nonce_field( 'idx_property', $this::NONCE_NAME );
		$property = $data['args'][0];

		include "partials/info.php";
	}

	public function showFeatures( $post, $data ) {
		wp_nonce_field( 'idx_property', $this::NONCE_NAME );
		$property = $data['args'][0];

		include "partials/features.php";
	}

	private function registerAssets() {
		add_action( 'current_screen', function ( $currentScreen ) {
			if ( $this->postType !== $currentScreen->id ) {
				return null;
			}

			add_action( 'admin_enqueue_scripts', function () {
				$templateDirectoryUri = get_template_directory_uri();
				$this->enqueueStyles( $templateDirectoryUri );
				$this->enqueueScripts( $templateDirectoryUri );
			} );

		} );
	}

	private function enqueueStyles( $templateDirectoryUri ) {
		$stylePath = $templateDirectoryUri . "/app/modules/property/assets/styles";

		wp_enqueue_style(
			'Property',
			$stylePath . "/property.css",
			[],
			wp_get_theme()->get( 'Version' )
		);
	}

	private function enqueueScripts( $templateDirectoryUri ) {
		wp_enqueue_script(
			'jquery.mask',
			$templateDirectoryUri . "/assets/scripts/lib/jquery.mask.js",
			[ 'jquery' ],
			'1.14.15'
		);

		wp_enqueue_script(
			'MaskController',
			$templateDirectoryUri . "/assets/scripts/controllers/MaskController.js",
			[ 'jquery.mask' ],
			'1.14.15'
		);

		wp_enqueue_script(
			'JS Autocomplete',
			$templateDirectoryUri . "/app/modules/property/assets/scripts/Autocomplete.js",
			[],
			wp_get_theme()->get( 'Version' )
		);

	}

	private function addRewriteRule() {
		add_action( 'init', function () {
			add_rewrite_rule( "^lancamentos/?$", "index.php?post_type={$this->postType}&release=1", 'top' );
			add_rewrite_rule( "^lancamentos/page/([0-9])?$", 'index.php?post_type=' . $this->postType . '&page=$matches[1]&release=1', 'top' );
		} );

		add_action( 'query_vars', function ( $queryVars ) {
			$queryVars[] = 'release';

			return $queryVars;
		} );

		add_filter( 'pre_get_posts', function ( $query ) {
			if ( ! is_post_type_archive( 'property' ) ) {
				return null;
			}

			$release = get_query_var( 'release' );

			if ( ! empty( $release ) ) {
				$query->set( 'meta_query', [
					[
						'key'     => 'release',
						'value'   => $release,
						'compare' => '='
					]
				] );
			}
		} );
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $propertyID ) {
			if ( ! isset( $_POST[ $this::NONCE_NAME ] ) || ! wp_verify_nonce( $_POST[ $this::NONCE_NAME ], 'idx_property' ) ) {
				return false;
			}

			$data = $_POST['property'];

			if ( ! array_key_exists( 'featured', $data ) ) {
				$data['featured'] = 0;
			}

			if ( ! array_key_exists( 'release', $data ) ) {
				$data['release'] = 0;
			}

			if ( ! array_key_exists( 'pool', $data ) ) {
				$data['pool'] = 0;
			}

			if ( ! empty( $data['price'] ) ) {
				$data['price'] = str_replace( ',', '.', str_replace( '.', '', $data['price'] ) );
			}

			foreach ( $data as $field => $value ) {
				update_post_meta( $propertyID, $field, $value );
			}

			return true;
		} );
	}
}
