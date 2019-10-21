<?php

namespace App\Provider\Bootstrap;

class BootstrapProvider {
	private $screen;
	private $registerStyles;
	private $registerScripts;

	/**
	 * @param string $screen
	 * @param bool $styles
	 * @param bool $scripts
	 */
	public function registerAssets( $screen, $styles = true, $scripts = false ) {
		$this->screen          = $screen;
		$this->registerStyles  = $styles;
		$this->registerScripts = $scripts;

		add_action( 'current_screen', function ( $currentScreen ) {
			if ( $this->screen !== $currentScreen->id ) {
				return null;
			}

			if ( $this->registerStyles ) {
				$this->enqueueStyles();
			}

			if ( $this->registerScripts ) {
				$this->enqueueScripts();
			}
		} );
	}

	private function enqueueStyles() {
		$stylesPath = get_template_directory_uri() . '/app/provider/bootstrap/assets/styles';

		wp_enqueue_style(
			'bootstrap-4',
			$stylesPath . "/bootstrap.min.css",
			[],
			'4.1.3'
		);

		wp_enqueue_style(
			'bootstrap-normalize',
			$stylesPath . "/bootstrap-normalize.css",
			[ 'bootstrap-4' ],
			wp_get_theme()->get( 'Version' )
		);

		wp_enqueue_style(
			'FontAwesome',
			$stylesPath . "/fontawesome/all.css",
			[],
			'5.8.1'
		);
	}

	private function enqueueScripts() {
		$scriptsPath = get_template_directory_uri() . '/app/provider/bootstrap/assets/scripts';

		wp_enqueue_script(
			'bootstrap-4',
			$scriptsPath . "/bootstrap.min.js",
			[ 'jquery' ],
			'4.1.3',
			true
		);

		wp_enqueue_script(
			'popper',
			$scriptsPath . "/popper.min.js",
			[ 'jquery' ],
			wp_get_theme()->get( 'Version' ),
			true
		);

		wp_enqueue_script(
			'BootstrapController',
			$scriptsPath . "/BootstrapController.js",
			[ 'bootstrap-4', 'jQueryMask' ],
			'4.1.3',
			true
		);
	}
}
