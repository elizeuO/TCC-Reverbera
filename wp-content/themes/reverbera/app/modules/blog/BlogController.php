<?php

namespace App\Modules\Blog;

class BlogController {
	public static function home() {
		$posts = self::get( [ 'posts_per_page' => 3 ] );

		if ( false === $posts ) {
			return null;
		}

		include __DIR__ . "/../../../../partials/blog/section-blog-home.php";
	}

	public static function getArchivePosts() {
		return self::get( [ 'paged' => get_query_var( 'paged' ) ?: 1 ] );
	}

	public static function getOtherPosts( $postNotIn ) {
		return self::get( [ 'posts_per_page' => 3, 'post__not_in' => [ $postNotIn ] ] );
	}

	private static function get( array $parameters = [] ) {
		$query = [
			'post_type'   => 'blog',
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

		$posts = [];

		foreach ( $query->get_posts() as $post ) {
			$posts[] = new Post( $post );
		}

		return $posts;
	}
}