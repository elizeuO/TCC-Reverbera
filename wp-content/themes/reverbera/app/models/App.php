<?php

namespace App\Models;

use App\Classes\Modules\Service\ServiceBuilder;
use App\Modules\Blog\BlogBuilder;
use App\Modules\Client\ClientBuilder;
use App\Modules\Contact_Form\FormBuilder;
use App\Modules\Contact_Form\FormController;
use App\Controllers\AssetController;
use App\Modules\Product\ProductBuilder;
use App\Modules\Property\PropertyBuilder;
use App\Modules\Slider\SliderBuilder;
use App\Modules\Testimonial\TestimonialBuilder;
use App\Provider\Bootstrap\BootstrapProvider;
use App\Provider\HelperProvider;

class App {
	public $contact;
	public $socialNetwork;

	public function __construct() {
		$this->contact       = new Contact();
		$this->socialNetwork = class_exists( 'CustomDashboard' ) ? new SocialNetwork( new \CustomDashboard() ) : new \stdClass();
	}

	public function run() {
		HelperProvider::addThumbnailSupport();
		HelperProvider::registerAjaxUrl();
		HelperProvider::removeAdminBar();
		HelperProvider::removeDefaultPostType();
		HelperProvider::removeDefaultImageSizes();
		AssetController::registerAssets();

		( new BlogBuilder() )->register();
	}
}
