<?php

namespace App\Classes\Modules\Product;


use App\Classes\Controllers\ThemeController;
use App\Classes\Modules\Asset_Controller\AssetController;
use App\Classes\Modules\Taxonomy\Term;
use App\Classes\Modules\Taxonomy\TermController;

class ProductPublicController {
	private static $categories;

	public static function init() {
		self::addActions();
	}

	private static function addActions() {
		add_action( 'init', [ self::class, 'rewriteUrl' ] );
		add_filter( 'query_vars', [ self::class, 'addQueryVars' ] );
	}

	public static function addQueryVars( $queryVars ) {
		$queryVars[] = "type";
		$queryVars[] = "ordination";

		return $queryVars;
	}

	public static function rewriteUrl() {
		add_rewrite_rule( "^produtos/([a-z0-9-]+)/titulo/asc?$", 'index.php?product_category=$matches[1]&type=title&ordination=asc', 'top' );
		add_rewrite_rule( "^produtos/([a-z0-9-]+)/titulo/desc?$", 'index.php?product_category=$matches[1]&type=title&ordination=desc', 'top' );
		add_rewrite_rule( "^produtos/([a-z0-9-]+)/preco/min?$", 'index.php?product_category=$matches[1]&type=price&ordination=asc', 'top' );
		add_rewrite_rule( "^produtos/([a-z0-9-]+)/preco/max?$", 'index.php?product_category=$matches[1]&type=price&ordination=desc', 'top' );
	}

	public static function renderByVisualization( ThemeController $themeController ) {
		$products = ProductBuilder::get( 6, 0, 'ID', 'visualization' );

		if ( empty( $products ) ) {
			return null;
		}

		$themeController::getPublicPartial( 'section-most-viewed-products.php', 'product', compact( 'products' ) );
	}

	public static function updateVisualization( Product $product ) {
		$visualizations = $product->getVisualizations();

		if ( empty( $visualizations ) ) {
			$visualizations = 1;
		} else {
			$visualizations ++;
		}

		$product->setVisualizations( $visualizations );
		update_post_meta( $product->getID(), 'product_visualization', $visualizations );
	}

	public static function renderRelated( ThemeController $themeController, $categoryId, $idNotIn = null ) {
		$products = ProductBuilder::getByCategoryID( $categoryId, 6, 0, $idNotIn );

		if ( empty( $products ) ) {
			return null;
		}

		$themeController::getPublicPartial( 'others-products.php', 'product', compact( 'products' ) );
	}

	private static function setCategories() {
		if ( ! empty( self::$categories ) ) {
			return false;
		}

		self::$categories = TermController::getByTaxonomy( 'product_category', true, true );

		return true;
	}

	public static function renderProductCategory() {
		self::setCategories();

		if ( empty( self::$categories ) ) {
			return null;
		}

		$categories = self::$categories;

		foreach ( $categories as $key => $category ) {
			if ( ! ( 3 <= $category->getID() && 7 >= $category->getID() ) ) {
				unset( $categories[ $key ] );
			}
		}

		ThemeController::getPublicPartial( 'categories.php', 'product_category', compact( 'categories' ) );
	}

	public static function renderLateralProductCategories() {
		self::setCategories();

		if ( empty( self::$categories ) ) {
			return null;
		}

		$categories = self::$categories;

		foreach ( $categories as $key => $category ) {
			if ( 3 !== $category->getID() && 8 !== $category->getID() ) {
				unset( $categories[ $key ] );
			}
		}

		ThemeController::getPublicPartial( 'lateral-categories.php', 'product_category', compact( 'categories' ) );
	}

	public static function renderHomeProductCategories() {
		self::setCategories();

		if ( empty( self::$categories ) ) {
			return null;
		}

		$categories = self::$categories;

		foreach ( $categories as $key => $category ) {
			if ( 3 !== $category->getID() && 5 !== $category->getID() ) {
				unset( $categories[ $key ] );
			}
		}

		ThemeController::getPublicPartial( 'section-product-categories-home.php', 'product_category', compact( 'categories' ) );
	}

	public static function renderFooterProductCategories() {
		self::setCategories();

		if ( empty( self::$categories ) ) {
			return null;
		}

		$categories = self::$categories;

		ThemeController::getPublicPartial( 'footer-categories.php', 'product_category', compact( 'categories' ) );
	}

	public static function renderMenuProductCategory() {
		self::setCategories();

		if ( empty( self::$categories ) ) {
			return null;
		}

		foreach ( self::$categories as $key => $category ) {
			if ( 9 !== $category->getID() ) {
				continue;
			}
			ThemeController::getPublicPartial( 'category-menu-link.php', 'product_category', compact( 'category' ) );
		}

	}

	public static function renderBySearchTerm( $term, $limit = 99999, $offset = 0 ) {
		if ( empty( $term ) ) {
			echo "<h3>Sem Resultados</h3>";

			return null;
		}

		$products = ProductBuilder::getBySearchTerm( $term, $limit, $offset );

		if ( empty( $products ) ) {
			echo "<h3>Sem Resultados</h3>";

			return null;
		}

		foreach ( $products as $product ) {
			ThemeController::getPublicPartial( 'item-product.php', 'product', compact( 'product' ) );
		}
	}

	public static function getProductMinPriceByCategory( $categoryId ) {
		if ( empty( $categoryId ) ) {
			return null;
		}

		$products = ProductBuilder::getByCategoryID( $categoryId, 99999, 0, null, 'ID', 'CAST(price AS DECIMAL)', 'ASC' );

		if ( empty( $products ) ) {
			return null;
		}

		foreach ( $products as $key => $product ) {
			if ( ! empty( $product->getPrice() ) ) {
				return $product;
			}
		}

		return new Product();
	}

	public static function getMinAndMaxPriceByCategory( Term $category ) {
		$products = ProductBuilder::getByCategoryID( $category->getID(), 99999, 0, null, 'ID', 'CAST(price AS DECIMAL)', 'ASC' );
		$price    = [ 'min' => 0, 'max' => 0 ];

		if ( empty( $products ) ) {
			return $price;
		}

		$price['min'] = ceil( $products[0]->getPrice() );
		$price['max'] = ceil( end( $products )->getPrice() );

		return $price;
	}

	public static function getFeaturedProduct( Term $category ) {
		$product = ProductBuilder::getFeatured( 1, 0, $category->getID() );

		if ( empty( $product ) ) {
			$product = ProductBuilder::getByCategoryID( $category->getID(), 1 );
		}

		if ( empty( $product ) ) {
			return Product::emptyConstruct();
		}

		return $product[0];
	}

	public static function renderByCategory( Term $category, ThemeController $themeController ) {
		$products   = [];
		$type       = get_query_var( 'type' );
		$ordination = get_query_var( 'ordination' );

		if ( ! empty( $type ) ) {
			if ( 'price' === $type ) {
				$products = ProductBuilder::getByCategoryID( $category->getID(), 99999, 0, null, 'ID', "CAST({$type} AS DECIMAL)", $ordination );
			} else {
				$products = ProductBuilder::getByCategoryID( $category->getID(), 99999, 0, null, 'ID', $type, $ordination );
			}
		} else if ( isset( $_GET['preco_maximo'] ) ) {
			$products = ProductBuilder::getByCategoryID( $category->getID(), 99999, 0, null, 'ID', 'CAST(price AS DECIMAL)', 'DESC', $_GET['preco_maximo'] );
		} else {
			$products = ProductBuilder::getByCategoryID( $category->getID() );
		}


		if ( ! empty( $products ) ) {
			foreach ( $products as $product ) {
				$themeController::getPublicPartial( 'item-product.php', 'product', compact( 'product' ) );
			}
		} else {
			echo "<h3>Nenhum produto relacionado.</h3>";
		}
	}
}