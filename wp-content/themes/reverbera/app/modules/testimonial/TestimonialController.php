<?php


namespace App\Modules\Testimonial;


class TestimonialController {

	public static function homeText() {
		$args         = [
			'posts_per_page' => 4,
			'meta_query'     => [
				[
					'key'     => 'description',
					'value'   => '',
					'compare' => '!='
				]
			]
		];
		$testimonials = self::get( $args );

		if ( false === $testimonials ) {
			return null;
		}

		include __DIR__ . "/../../../../partials/testimonial/section-testimonial-home.php";
	}

	public static function video() {
		$args         = [
			'posts_per_page' => - 1,
			'meta_query'     => [
				[
					'key'     => 'url',
					'value'   => '',
					'compare' => '!='
				]
			]
		];
		$testimonials = self::get( $args );

		if ( false === $testimonials ) {
			return null;
		}

		include __DIR__ . "/../../../../partials/testimonial/section-testimonial-video.php";
	}

	public static function internal() {
		$testimonials = self::get( [ 'posts_per_page' => - 1 ] );

		if ( false === $testimonials ) {
			return null;
		}

		include __DIR__ . "/../../../../partials/testimonial/section-testimonial-internal.php";
	}

	private static function get( array $parameters = [] ) {
		$query = [
			'post_type'   => 'testimonial',
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

		$testimonials = [];

		foreach ( $query->get_posts() as $post ) {
			$testimonials[] = new Testimonial( $post );
		}

		return $testimonials;
	}
}