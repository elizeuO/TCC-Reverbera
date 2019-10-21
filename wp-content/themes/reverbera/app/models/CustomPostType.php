<?php

namespace App\Models;

class CustomPostType {
	protected $postType;
	private $labels;
	private $icon;
	private $supports;
	private $rewrite;
	private $taxonomies;
	private $placeholder;
	private $publishButtonText;

	public function __construct( string $postType = null, array $labels = [], string $icon = null, array $supports = [ 'title' ], array $rewrite = [], array $taxonomies = [] ) {
		$this->postType   = $postType;
		$this->labels     = $labels;
		$this->icon       = $icon;
		$this->supports   = $supports;
		$this->rewrite    = $rewrite;
		$this->taxonomies = $taxonomies;
	}

	public function register() {
		add_action( 'init', function () {
			$customLabels = [
				'name'               => __( $this->labels['plural'], $this->postType ),
				'singular_name'      => __( $this->labels['singular'], $this->postType ),
				'add_new'            => _x( 'Adicionar ', $this->postType ),
				'all_items'          => _x( 'Ver Tudo', $this->postType ),
				'add_new_item'       => _x( 'Adicionar ' . $this->labels['singular'], $this->postType ),
				'edit_item'          => _x( 'Editar ' . $this->labels['singular'], $this->postType ),
				'new_item'           => _x( 'Novo ' . $this->labels['singular'], $this->postType ),
				'view_item'          => _x( 'Ver ' . $this->labels['plural'], $this->postType ),
				'search_items'       => _x( 'Procurar ' . $this->labels['singular'], $this->postType ),
				'not_found'          => _x( 'Não existem ' . $this->labels['plural'], $this->postType ),
				'not_found_in_trash' => _x( 'Nenhum ' . $this->labels['singular'] . ' encontrado na lixeira', $this->postType ),
				'menu_name'          => _x( $this->labels['plural'], $this->postType ),
				'parent_item_colon'  => null
			];

			if ( array_key_exists( 'featured_image', $this->labels ) ) {
				$customLabels['featured_image'] = __( $this->labels['featured_image'] );
			}

			if ( array_key_exists( 'set_featured_image', $this->labels ) ) {
				$customLabels['set_featured_image'] = __( $this->labels['set_featured_image'] );
			}

			if ( array_key_exists( 'remove_featured_image', $this->labels ) ) {
				$customLabels['remove_featured_image'] = __( $this->labels['remove_featured_image'] );
			}

			$args = [
				'labels'       => $customLabels,
				'public'       => true,
				'hierarchical' => true,
				'has_archive'  => true,
				'menu_icon'    => $this->icon,
				'supports'     => $this->supports,
				'rewrite'      => $this->rewrite,
				'taxonomies'   => $this->taxonomies
			];

			register_post_type( $this->postType, $args );
		} );
	}

	protected function addThumbColumnInAdminList() {
		add_filter( "manage_{$this->postType}_posts_columns", function ( $columns ) {
			$columns['thumbnail'] = 'Imagem';

			return $columns;
		}, 1 );

		add_filter( "manage_{$this->postType}_posts_custom_column", function ( $columns ) {
			switch ( $columns ) {
				case 'thumbnail':
					the_post_thumbnail( [ 100, 100 ] );
					break;
			}
		}, 1, 1 );
	}

	/**
	 * @param array $columnArgs
	 * This parameter must be an associative array, e.g:
	 * ['columnID' => [ 'title' => 'Column title Here', 'metaKey' => 'Meta Key to show'], n...]
	 */
	protected function addCustomColumnInAdminList( array $columnArgs ) {
		add_filter( "manage_{$this->postType}_posts_columns", function ( $columns ) use ( $columnArgs ) {

			foreach ( $columnArgs as $key => $args ) {
				$columns[ $key ] = $args['title'];
			}

			return $columns;
		}, 1 );

		add_filter( "manage_{$this->postType}_posts_custom_column", function ( $columns ) use ( $columnArgs ) {
			if ( array_key_exists( $columns, $columnArgs ) ) {
				echo get_post_meta( get_the_ID(), $columnArgs[ $columns ]['metaKey'], true );
			}
		}, 1, 1 );

		add_filter( "manage_edit-{$this->postType}_sortable_columns", function ( $columns ) use ( $columnArgs ) {
			foreach ( $columnArgs as $key => $args ) {
				if ( array_key_exists( 'sortable', $args ) && $args['sortable'] ) {
					$columns[ $key ] = $key;
				}
			}

			return $columns;
		} );

		add_action( "pre_get_posts", function ( $query ) use ( $columnArgs ) {
			global $current_screen;

			if ( ! is_admin() || is_null( $current_screen ) || "edit-{$this->postType}" !== $current_screen->id ) {
				return false;
			}

			$key = $query->get( 'orderby' );

			if ( ! array_key_exists( $key, $columnArgs ) ) {
				return false;
			}

			$query->set( 'meta_key', $columnArgs[ $key ]['metaKey'] );
			$query->set( 'orderby', 'meta_value' );
		} );
	}

	protected function changeTitlePlaceholder( $placeholder ) {
		$this->placeholder = $placeholder;

		add_filter( 'enter_title_here', function ( $title ) {
			global $current_screen;

			if ( $this->postType !== $current_screen->id ) {
				return null;
			}

			$title = $this->placeholder;

			return $title;
		} );
	}

	/*
	 * Array Keys:
	 * [publish => 'define text in button and label from metabox submit']
	 * [published => 'define text in status on metabox submit after publish']
	 * [update => 'define text in button on metabox submit after publish']
	 */
	protected function changePublishButtonText( array $publishButtonText ) {
		$this->publishButtonText = $publishButtonText;

		add_filter( 'gettext', function ( $translation, $text ) {
			if ( $this->postType !== get_post_type() ) {
				return $translation;
			}

			if ( $text === 'Publish' && array_key_exists( 'publish', $this->publishButtonText ) ) {
				return $this->publishButtonText['publish'];
			}

			if ( $text === 'Published' && array_key_exists( 'published', $this->publishButtonText ) ) {
				return $this->publishButtonText['published'];
			}

			if ( $text === 'Update' && array_key_exists( 'update', $this->publishButtonText ) ) {
				return $this->publishButtonText['update'];
			}

			return $translation;
		}, 10, 4 );
	}

	protected function removePreviewButton() {
		add_action( 'admin_head-post-new.php', function () {
			$this->hidePreviewButton();
		} );

		add_action( 'admin_head-post.php', function () {
			$this->hidePreviewButton();
		} );
	}

	private function hidePreviewButton() {
		global $post_type;

		if ( $post_type === $this->postType ) {
			echo '<style type="text/css">#post-preview, #view-post-btn{display: none;}</style>';
		}
	}

	/**
	 * @param array $imageSizes
	 * This parameter must be an array of arrays, e.g:
	 * [['thumb_name_here', width here (int), height here (int), crop here (boolean)], n...]
	 */
	protected function addImageSizes( array $imageSizes = [] ) {
		add_action( 'after_setup_theme', function () use ( $imageSizes ) {
			foreach ( $imageSizes as $imageSize ) {
				add_image_size( $imageSize[0], $imageSize[1], $imageSize[2], $imageSize[3] );
			}
		} );
	}

	public function renderAdminFilterByAuthor() {
		add_action( 'restrict_manage_posts', function () {
			global $post_type;

			if ( $this->postType !== $post_type ) {
				return false;
			}

			$args = [
				'name'            => 'author',
				'show_option_all' => 'Todos os Autores'
			];

			if ( isset( $_GET['user'] ) ) {
				$args['selected'] = $_GET['user'];
			}

			wp_dropdown_users( $args );
		} );
	}

	public function changePostsPerPage( $postsPerPage = - 1, array $screens = null ) {
		add_action( 'pre_get_posts', function ( $query ) use ( $postsPerPage, $screens ) {
			$availableScreen = false;

			if ( array_key_exists( 'post_types', $screens ) ) {
				foreach ( $screens['post_types'] as $postType ) {
					if ( is_post_type_archive( $postType ) ) {
						$availableScreen = true;
						break;
					}
				}
			}

			if ( array_key_exists( 'taxonomies', $screens ) ) {
				foreach ( $screens['taxonomies'] as $taxonomy ) {
					if ( is_tax( $taxonomy ) ) {
						$availableScreen = true;
						break;
					}
				}
			}

			if ( array_key_exists( 'is_category', $screens ) && is_category() ) {
				$availableScreen = true;
			}

			if ( array_key_exists( 'is_search', $screens ) && is_search() ) {
				$availableScreen = true;
			}

			if ( $availableScreen ) {
				$query->set( 'posts_per_page', $postsPerPage );
			}
		} );
	}

	/**
	 * @param string $metaKey : The meta key that will be used to search the posts
	 * @param array $field : The type of field to build on admin list. Eg. ['type' => 'text'],
	 *
	 * If the type is checkbox, then is necessary to add the key 'value':
	 * Eg. ['type' => 'checkbox', 'value' => 'the value here']
	 *
	 * Or if is select [ 'type' => 'select', 'options' => [['value' => 'Value', 'title' => 'title'], [n]...]]
	 * the key 'options' is optional, default value will be loaded from the database.
	 *
	 * @param string $title : The title to field in admin list
	 */
	public function addCustomFilterByMetaKey( string $metaKey, array $field, string $title ) {
		add_action( "restrict_manage_posts", function () use ( $metaKey, $field, $title ) {
			global $typenow;

			if ( $this->postType !== $typenow ) {
				return null;
			}

			switch ( $field['type'] ) {
				case "text":
					echo "<input type='text' name='{$metaKey}' placeholder='{$title}' style='margin-right: 10px;'>";
					break;
				case "radio":
				case "checkbox":
					echo "<label style='margin-right: 10px;'><input type='{$field['type']}' name='{$metaKey}' value='{$field['value']}'>{$title}</label>";
					break;
				case "select":
					$options = null;

					if ( isset( $field['options'] ) ) {
						$options = $field['options'];
					} else {
						$options = $this::getMetaValues( $metaKey, $this->postType );
					}

					if ( ! empty( $options ) ) {
						echo "<select name='{$metaKey}'>";
						echo "<option value=''>{$title}</option>";

						foreach ( $options as $option ) {
							if ( is_array( $option ) && array_key_exists( 'value', $option ) && array_key_exists( 'title', $option ) ) {
								echo "<option value='{$option['value']}'>{$option['title']}</option>";
								continue;
							}

							echo "<option value='$option'>{$option}</option>";
						}

						echo "</select>";
					}
					break;
				default:
					return null;
			}
		} );

		add_filter( "parse_query", function ( $query ) use ( $metaKey ) {
			global $typenow;

			if ( $this->postType !== $typenow ) {
				return null;
			}

			if ( ! isset( $_GET[ $metaKey ] ) || empty( $_GET[ $metaKey ] ) ) {
				return null;
			}

			$query->query_vars['meta_key']     = $metaKey;
			$query->query_vars['meta_value']   = $_GET[ $metaKey ];
			$query->query_vars['meta_compare'] = '=';
		} );

	}

	public static function getMetaValues( $metaKey, $postType ) {
		global $wpdb;

		$query = "SELECT pm.meta_value FROM {$wpdb->prefix}postmeta pm INNER JOIN {$wpdb->prefix}posts p " .
		         "ON (pm.post_id = p.ID AND pm.meta_key = '{$metaKey}') WHERE p.post_type = '{$postType}' GROUP BY pm.meta_value";

		return $wpdb->get_col( $query );
	}
}
