<?php

namespace App\Modules\Slider;

class SliderController {

	public static function renderHome() {
		$sliders = self::get( [ 'posts_per_page' => 5 ] );

		if ( is_null( $sliders ) ) {
			return null;
		}

		include __DIR__ . "/../../../partials/slider/section-slider-home.php";
	}

	public static function get( array $parameters = [] ) {
		$query = [
			'post_type'   => 'slider',
			'post_status' => 'publish'
		];

		if ( ! empty( $parameters ) ) {
			foreach ( $parameters as $key => $parameter ) {
				$query[ $key ] = $parameter;
			}
		}

		$query = new \WP_Query( $query );

		if ( ! $query->have_posts() ) {
			return null;
		}

		$slides = [];

		foreach ( $query->get_posts() as $slide ) {
			$slides[] = new Slider( $slide );
		}

		return $slides;
	}
}