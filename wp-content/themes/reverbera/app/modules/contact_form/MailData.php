<?php


namespace App\Modules\Contact_Form;


class MailData {
	private $to;
	private $siteName;
	private $userName;
	private $userEmail;
	private $attachments;
	private $message;
	private $subject;
	private $senderEmail;
	private $senderName;


	public function __construct( string $to, string $siteName, string $senderEmail, string $senderName, string $userName, string $userEmail, string $message, string $subject, array $attachments = null ) {
		$this->to          = $to;
		$this->siteName    = $siteName;
		$this->senderEmail = $senderEmail;
		$this->senderName  = $senderName;
		$this->userName    = $userName;
		$this->userEmail   = $userEmail;
		$this->attachments = $attachments;
		$this->message     = $message;
		$this->subject     = $subject;
	}

	public function getTo() {
		return $this->to;
	}

	public function getSiteName() {
		return $this->siteName;
	}

	public function getUserName() {
		return $this->userName;
	}

	public function getUserEmail() {
		return $this->userEmail;
	}

	public function getAttachments() {
		return $this->attachments;
	}

	public function getMessage() {
		return $this->message;
	}

	public function getSubject(  ) {
		return $this->subject;
	}

	public function getSenderEmail() {
		return $this->senderEmail;
	}

	public function getSenderName() {
		return $this->senderName;
	}
}