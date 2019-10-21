<?php

namespace App\Classes\Modules\Service;


use App\Models\CustomPostType;
use App\Modules\Gallery\Gallery;
use App\Provider\Attachment\AttachmentProvider;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class ServiceBuilder extends CustomPostType {
	public function __construct( BootstrapProvider $bootstrap ) {
		parent::__construct(
			'service',
			[
				'plural'   => 'Serviços',
				'singular' => 'Serviço'
			],
			'dashicons-admin-tools',
			[ 'title', 'thumbnail', 'editor' ],
			[ 'slug' => 'servicos' ]
		);

		$bootstrap->registerAssets( $this->postType );

	}

	public function register() {
		parent::register();
		$this->addGallery();
		$this->addIcon();
		$this->addThumbColumnInAdminList();
		$this->addImageSizes( [ [ 'thumb_service', 385, 220, true ] ] );
		$this->save();
	}

	private function addGallery() {
		$gallery = new Gallery( $this->postType, "gallery", "Galeria de Imagens", "service_gallery" );
		$gallery->register();
	}

	private function addIcon() {
		$attachment = new AttachmentProvider(
			$this->postType,
			[
				'id'    => 'service_icon',
				'title' => 'Ícone',
				'key'   => 'icon_id'
			]
		);

		$attachment->register();
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $serviceID ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return null;
			}

			$serviceFields = isset( $_POST['service'] ) ? $_POST['service'] : [];

			foreach ( $serviceFields as $key => $value ) {
				update_post_meta( $serviceID, $key, $value );
			}

			return true;
		} );
	}
}