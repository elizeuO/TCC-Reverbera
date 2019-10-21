<?php

namespace App\Provider\Pagination;

class PaginationProvider {

	private static function enqueueStyles() {
		add_action( 'wp_footer', function () {
			$stylesPath = get_template_directory_uri() . '/app/provider/pagination/assets/styles';

			wp_enqueue_style(
				'pagination',
				$stylesPath . '/pagination.css',
				[],
				wp_get_theme()->get( 'Version' )
			);
		} );
	}

	public static function renderLinks() {
		self::enqueueStyles();

		global $wp_query;

		echo paginate_links(
			[
				'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
				'total'     => $wp_query->max_num_pages,
				'current'   => max( 1, $wp_query->query_vars['paged'] ),
				'prev_text' => '<',
				'next_text' => '>'
			]
		);
	}
}
