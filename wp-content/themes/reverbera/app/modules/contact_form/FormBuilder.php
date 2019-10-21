<?php

namespace App\Modules\Contact_Form;

use App\Provider\Bootstrap\BootstrapProvider;

class FormBuilder {
	const PAGE_SLUG = 'form-manager';
	private $forms;

	public function __construct( BootstrapProvider $bootstrap ) {
		$this->forms = [
			[ 'title' => 'Contato', 'name' => 'contact' ],
			[ 'title' => 'Trabalhe Conosco', 'name' => 'work_with_us' ],
			[ 'title' => 'Financiamento', 'name' => 'financing' ]
		];

		$bootstrap->registerAssets( "toplevel_page_" . $this::PAGE_SLUG );
	}

	public function register() {
		$this->addMenu();
		$this->registerAssets();
		$this->registerAjax();
		$this->save();
	}

	private function addMenu() {
		add_action( 'admin_menu', function () {
			if ( empty( $this->forms ) ) {
				return null;
			}

			add_menu_page(
				'Gerenciar Formulários',
				'Formulários',
				'manage_options',
				$this::PAGE_SLUG,
				[ $this, 'render' ],
				'dashicons-email-alt',
				6
			);
		} );
	}

	public function render() {
		include "partials/index.php";
	}

	private function registerAssets() {
		add_action( 'current_screen', function ( $currentScreen ) {
			if ( ( 'toplevel_page_' . $this::PAGE_SLUG ) !== $currentScreen->id ) {
				return null;
			}

			add_action( 'admin_enqueue_scripts', function () {
				wp_enqueue_style(
					'form',
					get_template_directory_uri() . "/app/classes/modules/contact_form/assets/styles/form.css",
					[],
					wp_get_theme()->get( 'Version' )
				);
			} );
		} );
	}

	private function registerAjax() {
		add_action( 'wp_ajax_nopriv_sendContactForm', [ MailController::class, 'sendMail' ] );
		add_action( 'wp_ajax_sendContactForm', [ MailController::class, 'sendMail' ] );
	}

	private function save() {
		add_action( "current_screen", function ( $currentScreen ) {
			if ( ( 'toplevel_page_' . self::PAGE_SLUG ) !== $currentScreen->id || ! isset( $_POST[ $this::PAGE_SLUG ] ) || ! wp_verify_nonce( $_POST[ $this::PAGE_SLUG ], $this::PAGE_SLUG ) ) {
				return null;
			}

			$forms = $_POST['forms'];

			foreach ( $forms as $form ) {
				update_option( $form['id'], $form['emails'] );
			}

			update_option( 'siteKey', $_POST['siteKey'] );
			update_option( 'secretKey', $_POST['secretKey'] );
		} );
	}
}