<?php

namespace App\Models;

class SocialNetwork {
	private $socialNetworks;

	public function __construct( \CustomDashboard $customDashboard ) {
		$this->socialNetworks = $customDashboard::get_social_networks();
	}

	public function hasSocialNetworks() {
		return $this->hasFacebook() || $this->hasInstagram() || $this->hasYouTube();
	}

	public function getFacebook() {
		return $this->socialNetworks['facebook'];
	}

	public function hasFacebook() {
		if ( is_array( $this->socialNetworks ) && isset( $this->socialNetworks['facebook'] ) ) {
			if ( ! empty( $this->socialNetworks['facebook'] ) ) {
				return true;
			}
		}

		return false;
	}

	public function getInstagram() {
		return $this->socialNetworks['instagram'];
	}

	public function hasInstagram() {
		if ( is_array( $this->socialNetworks ) && isset( $this->socialNetworks['instagram'] ) ) {
			if ( ! empty( $this->socialNetworks['instagram'] ) ) {
				return true;
			}
		}

		return false;
	}

	public function getTwitter() {
		return $this->socialNetworks['twitter'];
	}

	public function hasTwitter() {
		if ( is_array( $this->socialNetworks ) && isset( $this->socialNetworks['twitter'] ) ) {
			if ( ! empty( $this->socialNetworks['twitter'] ) ) {
				return true;
			}
		}

		return false;
	}

	public function getYouTube() {
		return $this->socialNetworks['youtube'];
	}

	public function hasYouTube() {
		if ( is_array( $this->socialNetworks ) && isset( $this->socialNetworks['youtube'] ) ) {
			if ( ! empty( $this->socialNetworks['youtube'] ) ) {
				return true;
			}
		}

		return false;
	}

	public function getWhatsapp() {
		return $this->socialNetworks['whatsapp'];
	}

	public function hasWhatsapp() {
		if ( is_array( $this->socialNetworks ) && isset( $this->socialNetworks['whatsapp'] ) ) {
			if ( ! empty( $this->socialNetworks['whatsapp'] ) ) {
				return true;
			}
		}

		return false;
	}
}
