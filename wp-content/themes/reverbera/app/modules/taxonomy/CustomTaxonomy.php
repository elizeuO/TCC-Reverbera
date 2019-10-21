<?php

namespace App\Modules\Taxonomy;

class CustomTaxonomy {
	protected $taxonomy;
	protected $postType;
	protected $label;
	protected $rewrite;
	protected $hierarchical;
	protected $hasIcon;

	public function __construct( array $args ) {
		foreach ( $args as $key => $value ) {
			$this->{$key} = $value;
		}
	}

	public function register() {
		if ( ! is_array( $this->label ) ) {
			return new \Error( 'label is not array' );
		}

		$labels = [
			'name'                       => __( $this->label['plural'], $this->taxonomy ),
			'singular_name'              => __( $this->label['singular'], $this->taxonomy ),
			'edit_item'                  => __( "Editar {$this->label['singular']}", $this->taxonomy ),
			'search_items'               => __( "Pesquisar {$this->label['plural']}", $this->taxonomy ),
			'update_item'                => __( "Atualizar {$this->label['singular']}", $this->taxonomy ),
			'parent_item'                => __( "{$this->label['singular']} ascendente", $this->taxonomy ),
			'parent_item_colon'          => __( "Parent:", $this->taxonomy ),
			'menu_name'                  => __( $this->label['plural'], $this->taxonomy ),
			'add_new_item'               => __( "Adicionar {$this->label['singular']}", $this->taxonomy ),
			'new_item_name'              => __( "Novo", $this->taxonomy ),
			'all_items'                  => __( "Todos", $this->taxonomy ),
			'separate_items_with_commas' => __( "Separar", $this->taxonomy ),
			'choose_from_most_used'      => __( "Mais utilizados", $this->taxonomy )
		];

		$args = [
			'labels'            => $labels,
			'show_ui'           => true,
			'rewrite'           => $this->rewrite ?: [],
			'hierarchical'      => $this->hierarchical ?: true,
			'show_admin_column' => true
		];

		register_taxonomy( $this->taxonomy, $this->postType, $args );
	}

	public function renderAdminFilter() {

		add_action( 'restrict_manage_posts', function () {
			global $post_type;

			if ( $this->postType !== $post_type ) {
				return false;
			}

			wp_dropdown_categories(
				[
					'show_option_all' => is_array( $this->label ) ? $this->label['plural'] : 'Todos',
					'taxonomy'        => $this->taxonomy,
					'name'            => $this->taxonomy,
					'value_field'     => 'slug',
					'orderby'         => 'name',
					'hierarchical'    => true,
					'depth'           => 3,
					'show_count'      => true,
					'hide_empty'      => true,
				]
			);
		} );
	}

	protected function showFieldsInEditForm() {
		add_action( "{$this->taxonomy}_edit_form_fields", function () {
			$itemTerm = new Term( new \WP_Term( get_term( $_GET['tag_ID'] ) ) );

			require "partials/edit-form-fields.php";
		} );
	}

	protected function showFieldsInAddForm() {
		add_action( "{$this->taxonomy}_add_form_fields", function () {
			require "partials/add-form-fields.php";
		} );
	}

	protected function registerAssets() {
		add_action( "current_screen", function ( $currentScreen ) {
			if ( $this->taxonomy !== $currentScreen->taxonomy ) {
				return false;
			}

			add_action( 'admin_enqueue_scripts', function () {
				$scriptPath = get_template_directory_uri() . "/app/modules/taxonomy/assets/scripts";

				wp_enqueue_script(
					'ThumbnailSelector',
					$scriptPath . "/ThumbnailSelector.js",
					[],
					wp_get_theme()->get( 'Version' )
				);

				wp_enqueue_media();
			} );

			return true;
		} );
	}

	protected function save() {
		add_action( "create_{$this->taxonomy}", function ( $termID ) {
			$this->updateMetaFields( $termID );
		} );

		add_action( "edit_{$this->taxonomy}", function ( $termID ) {
			$this->updateMetaFields( $termID );
		} );
	}

	private function updateMetaFields( $termID ) {
		$thumbnailID = isset( $_POST['thumbnail_id'] ) ? $_POST['thumbnail_id'] : '';

		update_term_meta( $termID, "thumbnail_id", $thumbnailID );

		if ( $this->hasIcon ) {
			update_term_meta( $termID, "icon_id", $_POST['icon_id'] );
		}

		return true;
	}

	public function getTaxonomy() {
		return $this->taxonomy;
	}
}