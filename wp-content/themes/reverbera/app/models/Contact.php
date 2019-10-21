<?php

namespace App\Models;

class Contact {
	private $email;
	private $address;
	private $phone;
	private $phones;

	public function __construct() {
		$this->email   = get_option( 'idx_email' );
		$this->address = get_option( 'idx_address' );
		$this->phone   = get_option( 'idx_phone' );
		$this->phones  = get_option( 'idx_repeatable_phones' );
	}

	public function getEmail() {
		return $this->email;
	}

	public function hasEmail() {
		if ( ! empty( $this->email ) ) {
			return true;
		}

		return false;
	}

	public function getAddress() {
		return nl2br( $this->address );
	}

	public function hasAddress() {
		if ( ! empty( $this->address ) ) {
			return true;
		}

		return false;
	}

	public function getPhone() {
		return $this->phone;
	}

	public function hasPhone() {
		if ( ! empty( $this->phone ) ) {
			return true;
		}

		return false;
	}

	public function getPhones() {
		return $this->phones;
	}

	public function hasPhones() {
		if ( ! empty( $this->phones ) ) {
			return true;
		}

		return false;
	}
}
