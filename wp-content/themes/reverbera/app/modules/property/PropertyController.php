<?php


namespace App\Modules\Property;


class PropertyController {
	public static function renderSliderHome() {
		$properties = self::get( [
			'meta_query' => [
				[
					'key'     => 'release',
					'value'   => '1',
					'compare' => '='
				]
			]
		] );

		if ( false === $properties ) {
			return null;
		}

		include __DIR__ . "/../../../partials/property/section-property-slider-home.php";
	}

	public static function renderFeaturedHome() {
		$properties = self::get( [
			'meta_query'     => [
				[
					'key'     => 'featured',
					'value'   => '1',
					'compare' => '='
				]
			],
			'posts_per_page' => 3
		] );

		if ( false === $properties ) {
			return null;
		}

		include __DIR__ . "/../../../partials/property/section-property-featured-home.php";
	}

	public static function renderPropertiesHome() {
		$properties = self::get( [ 'posts_per_page' => 12 ] );

		if ( false === $properties ) {
			return null;
		}

		include __DIR__ . "/../../../partials/property/section-property-home.php";
	}

	public static function renderArchive() {
		$properties = self::get();

		if ( empty( $properties ) ) {
			return null;
		}

		foreach ( $properties as $property ) {
			include __DIR__ . "/../../../partials/property/property.php";
		}
	}

	public static function getOtherPosts( $postNotIn ) {
		$properties = self::get( [ 'posts_per_page' => 3, 'post__not_in' => [ $postNotIn ] ] );

		if ( false === $properties ) {
			return null;
		}

		include __DIR__ . "/../../../partials/property/section-property-others-single.php";
	}

	public static function get( array $parameters = [] ) {
		$query = [
			'post_type'   => 'property',
			'post_status' => 'publish'
		];

		if ( ! empty( $parameters ) ) {
			foreach ( $parameters as $key => $parameter ) {
				$query[ $key ] = $parameter;
			}
		}

		$query = new \WP_Query( $query );

		if ( ! $query->have_posts() ) {
			return false;
		}

		$properties = [];

		foreach ( $query->get_posts() as $post ) {
			$properties[] = new Property( $post );
		}

		return $properties;
	}
}