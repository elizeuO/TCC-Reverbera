<?php

namespace App\Modules\Product;

use App\Models\CustomPostType;
use App\Modules\Gallery\Gallery;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class ProductBuilder extends CustomPostType {
	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'product',
			[ 'singular' => 'Produto', 'plural' => 'Produtos' ],
			"dashicons-products",
			[ 'title', 'thumbnail', 'editor' ],
			[ 'slug' => 'produtos' ]
		);

		$bootstrap->registerAssets( $this->postType );
	}

	public function register() {
		parent::register();
		$this->addGallery();
		$this->addMetaBoxes();
		$this->addThumbColumnInAdminList();
		$this->addImageSizes( [ [ 'thumb_product', 300, 300, true ] ] );
		$this->save();
	}

	private function addGallery() {
		$gallery = new Gallery( $this->postType, 'gallery', 'Galeria de Imagens', 'product_gallery' );
		$gallery->register();
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				'product_information',
				'Informações',
				function ( $post ) {
					$this->showInformation( $post );
				},
				$this->postType,
				'normal',
				'high'
			);
		} );

	}

	private function showInformation( $post ) {
		HelperProvider::registerNonce( $this->postType );
		$product = new Product( $post );

		include "partials/information.php";
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $productID ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return null;
			}

			$productFields = isset( $_POST['product'] ) ? $_POST['product'] : [];

			if ( ! array_key_exists( 'featured', $productFields ) ) {
				$productFields['featured'] = 0;
			}

			foreach ( $productFields as $key => $value ) {
				if ( $key === 'price' ) {
					$value = str_replace( ',', '.', str_replace( '.', '', $value ) );
				}

				update_post_meta( $productID, $key, $value );
			}
		} );
	}
}