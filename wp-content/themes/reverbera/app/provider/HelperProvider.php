<?php

namespace App\Provider;

class HelperProvider {

	public static function addThumbnailSupport() {
		add_action( 'after_setup_theme', function () {
			add_theme_support( 'post-thumbnails' );
		} );
	}

	public static function removeAdminBar() {
		add_filter( 'show_admin_bar', '__return_false' );
	}

	public static function removeDefaultPostType() {
		add_action( 'admin_menu', function () {
			remove_menu_page( 'edit.php' );
		} );
	}

	public static function hidePagesFromAdmin( array $pageIDs ) {
		if ( is_super_admin() ) {
			return null;
		}

		add_filter( 'parse_query', function ( $wpQuery ) use ( $pageIDs ) {
			global $pagenow, $post_type;

			if ( is_admin() && $pagenow === 'edit.php' && $post_type === 'page' ) {
				$wpQuery->query_vars['post__not_in'] = $pageIDs;
			}
		} );
	}

	public static function registerAjaxUrl() {
		add_action( 'wp_head', function () {
			echo "<script>let ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "';</script>";
		} );
	}

	public static function clearPhoneMask( $phone ) {
		if ( empty( $phone ) ) {
			return null;
		}

		return str_replace( [ '(', ')', ' ', '-' ], '', $phone );
	}

	public static function getPageLink( $pageSlug ) {
		return get_permalink( get_page_by_path( $pageSlug ) );
	}

	public static function getHomeUrl() {
		return home_url( '/' );
	}

	public static function getPostTypeArchiveLink( $postType ) {
		return get_post_type_archive_link( $postType );
	}

	public static function isCurrentLink( $page, $isEcho = true ) {
		$isCurrent = false;

		if ( 'home' === $page && is_home() ) {
			$isCurrent = true;
		} else if ( is_page( $page ) || is_singular( $page ) || is_tax( $page ) ) {
			$isCurrent = true;
		} else if ( is_post_type_archive( $page ) ) {
			$isCurrent = true;
		}

		if ( $isCurrent ) {
			if ( ! $isEcho ) {
				return true;
			}

			echo "w--current";
		} else {
			return false;
		}
	}

	public static function getTitle() {
		if ( is_home() ) {
			return self::getName();
		}

		return wp_title( '|', false, 'right' ) . self::getName();
	}

	public static function getDescription() {
		return get_bloginfo( 'description' );
	}

	public static function getName() {
		return get_bloginfo( 'name' );
	}

	public static function getSharedImage() {
		if ( is_single() ) {
			$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumb_to_share' )[0];

			if ( self::imageFileExists( $thumbnail ) ) {
				return $thumbnail;
			}
		}

		return self::getImageUri( 'fb-share.jpg' );
	}

	public static function getCurrentPermalink() {
		return is_home() ? home_url() : get_permalink();
	}

	public static function removeDefaultImageSizes() {
		add_filter( 'intermediate_image_sizes', function ( $imageSizes ) {
			$default = [ 'thumbnail', 'medium', 'medium_large', 'large' ];

			foreach ( $imageSizes as $key => $size ) {
				if ( in_array( $size, $default ) ) {
					unset( $imageSizes[ $key ] );
				}
			}

			return $imageSizes;
		} );
	}

	public static function getVideoUri( $fileName ) {
		return get_template_directory_uri() . "/assets/videos/{$fileName}";
	}

	public static function getImageUri( $fileName, $moduleName = null ) {
		$path = get_template_directory_uri();

		if ( ! empty( $isModule ) ) {
			$path .= "/app/modules/{$moduleName}";
		}

		return $path . "/assets/images/{$fileName}";
	}

	public static function imageFileExists( $imageSrc ) {
		$imageFileSrc = str_replace( home_url( '/' ), ABSPATH, $imageSrc );

		return file_exists( $imageFileSrc );
	}

	public static function getImageUrlById( $id, $imageSize = 'full', $noImage = null ) {
		$imageUrl = null;

		if ( ! empty( $id ) ) {
			$imageUrl = wp_get_attachment_image_src( $id, $imageSize )[0];
		}

		if ( ! is_null( $imageUrl ) && self::imageFileExists( $imageUrl ) ) {
			return $imageUrl;
		}

		return ! empty( $noImage ) ? self::getImageUri( $noImage ) : null;
	}

	public static function registerNonce( string $label ) {
		$action = "idx_{$label}";
		$name   = "idx_{$label}_nonce";

		wp_nonce_field( $action, $name );
	}

	public static function checkNonce( string $label ) {
		$action = "idx_{$label}";
		$name   = "idx_{$label}_nonce";

		if ( ! isset( $_POST[ $name ] ) ) {
			return false;
		}

		return wp_verify_nonce( $_POST[ $name ], $action );
	}
}
