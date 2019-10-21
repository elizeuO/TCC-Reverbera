<?php

namespace App\Modules\Contact_Form;

class FormController {
	const RECAPTCHA_URL = 'https://www.google.com/recaptcha/api/siteverify';
	const MODULE_PATH = '/app/modules/contact_form';

	public static function sendMail( MailData $mailData ) {
		self::checkReCaptcha();

		$headers[] = "MIME-Version: 1.0";
		$headers[] = "Content-Type: text/html; charset=UTF-8";

		if ( ! empty( $mailData->getUserEmail() ) ) {
			$headers[] = "Reply-To: {$mailData->getUserEmail()}";
			$headers[] = "From: {$mailData->getUserName()} <{$mailData->getUserEmail()}>";
		} else {
			$headers[] = "From: {$mailData->getSiteName()} <{$mailData->getSenderEmail()}>";
		}

		$headers[] = "X-Sender: {$mailData->getSiteName()} <{$mailData->getSenderEmail()}>";

		$message = htmlspecialchars_decode(
			htmlentities( $mailData->getMessage(), ENT_NOQUOTES, 'UTF-8', false ),
			ENT_NOQUOTES
		);

		// Uploading attachment
		$files = [];
		if ( ! empty( $mailData->getAttachments() ) ) {
			foreach ( $mailData->getAttachments() as $attachment ) {
				$files[] = wp_upload_bits( $attachment['name'], null, file_get_contents( $attachment['tmp_name'] ) )['file'];
			}
		}

		$sent = wp_mail(
			$mailData->getTo(),
			$mailData->getSubject(),
			$message,
			$headers,
			$files
		);

		if ( ! empty( $files ) ) {
			foreach ( $files as $file ) {
				unlink( $file['file'] );
			}
		}

		echo $sent;
		die();
	}

	/**
	 * @param array $availablePages: Insert slug name of pages. eg. ['contact', 'work-with-us', ...]
	 * To register site-wide scripts use ['all'], to register on homepage use ['home']
	*/
	public static function registerAssets( array $availablePages ) {
		add_action( 'wp_footer', function () use ( $availablePages ) {
			if ( self::checkAvailablePage( $availablePages ) ) {
				self::enqueueStyles( wp_get_theme()->get( 'Version' ) );
				self::enqueueScripts( wp_get_theme()->get( 'Version' ) );
			}
		} );
	}

	private static function enqueueStyles( string $version ) {
		wp_enqueue_style(
			'blockIU',
			get_template_directory_uri() . self::MODULE_PATH . "/assets/styles/blockui.css",
			[],
			$version
		);

		wp_enqueue_style(
			'contactStyle',
			get_template_directory_uri() . self::MODULE_PATH . "/assets/styles/contact.style.css",
			[],
			$version
		);
	}

	private static function enqueueScripts( string $version ) {
		wp_enqueue_script(
			'BlockUI',
			get_template_directory_uri() . self::MODULE_PATH . "/assets/scripts/BlockUIController.js",
			[],
			$version,
			true
		);

		wp_enqueue_script(
			'FormController',
			get_template_directory_uri() . self::MODULE_PATH . "/assets/scripts/FormController.js",
			[ 'BlockUI' ],
			$version,
			true
		);

		wp_enqueue_script(
			'reCaptcha',
			"https://www.google.com/recaptcha/api.js?render=" . get_option( 'siteKey' ),
			[],
			$version,
			true
		);

		wp_enqueue_script(
			'GoogleReCaptcha',
			include "partials/script.php",
			[],
			$version,
			true
		);

	}

	public static function checkReCaptcha() {
		if ( ! isset( $_POST['recaptcha'] ) ) {
			echo false;
			die();
		}

		$url = self::RECAPTCHA_URL . '?secret=' . get_option( 'secretKey' ) . '&response=' . $_POST['recaptcha'];

		$recaptcha = file_get_contents( $url );
		$recaptcha = json_decode( $recaptcha );

		if ( ! $recaptcha->success || 0.6 > $recaptcha->score ) {
			echo false;
			die();
		}
	}

	private static function checkAvailablePage( array $pages ) {
		foreach ( $pages as $page ) {
			if ( $page === 'all' ) {
				return true;
			}

			if ( $page === 'home' && is_home() ) {
				return true;
			}

			if ( is_page( $page ) ) {
				return true;
			}
		}

		return false;
	}
}