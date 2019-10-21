<?php

namespace App\Controllers;

class AssetController {
	private static $assetsPath;

	public static function registerAssets() {
		add_action( 'wp_enqueue_scripts', function () {
			self::$assetsPath = get_template_directory_uri().'../';
			$version          = wp_get_theme()->get( 'Version' );

			self::registerStyles( $version );
			self::registerScripts( $version );
		} );
	}

	private static function registerStyles( $version ) {
		wp_enqueue_style(
			'normalize',
			self::$assetsPath . '/css/normalize.css',
			[],
			$version
		);

		wp_enqueue_style(
			'style',
			self::$assetsPath . '/css/style.css',
			[],
			$version
		);

		wp_enqueue_style(
			'Fancybox',
			self::$assetsPath . '/css/reverbera.css',
			[],
			$version
		);
	}

	private static function registerScripts( $version ) {
		wp_deregister_script( 'jquery' );

		wp_enqueue_script(
			'jquery',
			self::$assetsPath . '/js/jquery-3.4.1.min.js',
			[],
			'3.4.1',
			true
		);

		wp_enqueue_script(
			'audioplayer',
			self::$assetsPath . '/js/audioplayer.js',
			[],
			'',
			true
		);

		wp_enqueue_script(
			'fontSize',
			self::$assetsPath . '/scripts/controllers/fontSize.js',
			[],
			'',
			true
		);

        wp_enqueue_script(
            'scripts',
            self::$assetsPath . '/scripts/controllers/scripts.js',
            [],
            '',
            true
        );
	}
}
