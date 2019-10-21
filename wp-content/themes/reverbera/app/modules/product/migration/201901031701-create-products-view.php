<?php
require_once "../../../../../../../../wp-load.php";

class CreateProductsView {

	private static function query() {
		return "CREATE VIEW products AS (
					SELECT p.ID, p.post_title AS title, p.post_content AS content, pm1.meta_value AS thumbnail_id, 
					pm2.meta_value AS featured, pm3.meta_value AS gallery, pm4.meta_value AS model, 
					pm5.meta_value AS price, tr1.term_taxonomy_id AS brand_id, pm6.meta_value AS instalment_quantity,
					pm7.meta_value AS normal_price, pm8.meta_value AS visualization, 
					tr2.term_taxonomy_id AS category_id, p.post_status AS status, p.post_date, p.menu_order 
					FROM _posts p 
				    LEFT JOIN _postmeta pm1 ON (p.ID = pm1.post_id AND pm1.meta_key = '_thumbnail_id')
				    LEFT JOIN _postmeta pm2 ON (p.ID = pm2.post_id AND pm2.meta_key = 'product_featured')
				    LEFT JOIN _postmeta pm3 ON (p.ID = pm3.post_id AND pm3.meta_key = 'product_gallery')
				    LEFT JOIN _postmeta pm4 ON (p.ID = pm4.post_id AND pm4.meta_key = 'product_model')
				    LEFT JOIN _postmeta pm5 ON (p.ID = pm5.post_id AND pm5.meta_key = 'product_price')
				    LEFT JOIN _postmeta pm6 ON (p.ID = pm6.post_id AND pm6.meta_key = 'product_instalment_quantity')
				    LEFT JOIN _postmeta pm7 ON (p.ID = pm7.post_id AND pm7.meta_key = 'product_normal_price')
				    LEFT JOIN _postmeta pm8 ON (p.ID = pm8.post_id AND pm8.meta_key = 'product_visualization')
				    LEFT JOIN _term_relationships tr1 ON (p.ID = tr1.object_id AND tr1.term_taxonomy_id IN (
						SELECT term_taxonomy_id FROM _term_taxonomy WHERE taxonomy = 'product_brand'
					))
					LEFT JOIN _term_relationships tr2 ON (p.ID = tr2.object_id AND tr2.term_taxonomy_id IN (
						SELECT term_taxonomy_id FROM _term_taxonomy WHERE taxonomy = 'product_category'
					))
				    WHERE p.post_type = 'product' AND p.post_status != 'auto-draft'
		)";
	}

	public static function executeQuery() {
		global $wpdb;

		$wpdb->query( self::query() );
	}
}

CreateProductsView::executeQuery();