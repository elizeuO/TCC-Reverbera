<?php

namespace App\Modules\Taxonomy;


class TermBuilder {
	public static function get( \WP_Post $post, string $taxonomy, bool $arrayMode = null ) {
		$items = get_the_terms( $post, $taxonomy );

		if ( ! $items ) {
			return $arrayMode ? [] : new Term();
		}

		$terms = [];

		foreach ( $items as $item ) {
			$terms[] = new Term( $item );
		}

		return $arrayMode ? $terms : $terms[0];
	}

	public static function getByTaxonomy( array $parameters = null ) {
		$items = get_terms( $parameters );

		if ( empty( $items ) ) {
			return [];
		}

		$terms = [];

		foreach ( $items as $item ) {
			$terms[] = new Term( $item );
		}

		return $terms;
	}
}