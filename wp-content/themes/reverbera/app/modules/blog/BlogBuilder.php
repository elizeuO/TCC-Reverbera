<?php


namespace App\Modules\Blog;


use App\Models\CustomPostType;
use App\Modules\Taxonomy\CustomTaxonomy;
use App\Provider\HelperProvider;

class BlogBuilder extends CustomPostType {

	public function __construct() {
		$taxonomy = new CustomTaxonomy( [
			'taxonomy' => 'blog_category',
			'slug'     => 'categoria-de-posts',
			'label'    => [ 'plural' => 'Categorias', 'singular' => 'Categoria' ],
			'rewrite'  => [ 'slug' => 'categoria-de-posts' ],
			'postType' => 'blog'
		] );

		$taxonomy->register();
		$taxonomy->renderAdminFilter();

		parent::__construct(
			'blog',
			[ 'singular' => 'Post', 'plural' => 'Publicações' ],
			'dashicons-welcome-write-blog',
			[ 'title', 'editor', 'thumbnail', 'excerpt' ],
			[ 'slug' => 'publicacoes' ]
		);
	}

	public function register() {
		parent::register();

		$this->addThumbColumnInAdminList();
		$this->changePostsPerPage(
			12,
			[
				'post_types' => [ $this->postType ],
				'is_search'  => true
			]
		);

		$this->addImageSizes( [ [ 'thumb_blog', 365, 210, true ] ] );
		$this->addType();
		$this->save();
	}

	private function addType() {
		add_action( "add_meta_boxes_{$this->postType}", function () {
			add_meta_box(
				'type_blog',
				'Tipo da publicação',
				[ $this, 'renderType' ],
				$this->postType,
				'side',
				'high'
			);
		} );
	}

	public function renderType() {
		HelperProvider::registerNonce( $this->postType );
		$itemPost = new Post( new \WP_Post( get_post() ) );

		include "partials/type.php";
	}

	private function save() {
		add_action( "save_post_{$this->postType}", function ( $postID ) {
			if ( ! HelperProvider::checkNonce( $this->postType ) ) {
				return false;
			}

			update_post_meta( $postID, 'type', $_POST['type'] );

			return true;
		} );
	}
}