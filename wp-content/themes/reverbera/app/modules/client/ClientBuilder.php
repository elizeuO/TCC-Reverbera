<?php

namespace App\Modules\Client;

use App\Models\CustomPostType;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class ClientBuilder extends CustomPostType {

	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'client',
			[ 'singular' => 'Cliente', 'plural' => 'Clientes' ],
			'dashicons-groups',
			[ 'title', 'thumbnail' ]
		);

		$bootstrap->registerAssets( $this->postType );
	}

	public function register() {
		parent::register();
		$this->addMetaBoxes();
		$this->save();
		$this->addThumbColumnInAdminList();
		$this->addImageSizes( [ [ 'thumb_client', 200, 200, true ] ] );
		$this->changeTitlePlaceholder( 'Nome' );
	}

	private function addMetaBoxes() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				'client_link',
				'Link do Site',
				function ( $post ) {
					$this->showLink( $post );
				},
				$this->postType,
				'normal',
				'high'
			);
		} );
	}

	private function showLink( $post ) {
		HelperProvider::registerNonce( $this->postType );
		$client = new Client( $post );

		require "partials/link.php";
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $clientID ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return null;
			}

			$clientFields = isset( $_POST['client'] ) ? $_POST['client'] : [];

			foreach ( $clientFields as $key => $value ) {
				update_post_meta( $clientID, $key, $value );
			}
		} );
	}
}