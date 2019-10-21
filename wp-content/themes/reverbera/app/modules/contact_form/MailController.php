<?php

namespace App\Modules\Contact_Form;


class MailController {
	private static $senderEmail = "naoresponda@indexis.digital";
	private static $to = 'gerbton@indexis.com.br';
	private static $siteName = 'Martins Imóveis';

	public static function sendMail() {
		switch ( $_POST['route'] ) {
			case 'contact':
				self::contact();
				break;
			case 'work_with_us':
				self::workWithUs();
				break;
			default:
				echo false;
				die();
		}
	}

	private static function contact() {
		$message = "Nome: {$_POST['name']} <br>" .
		           "Email: {$_POST['email']} <br>" .
		           "Telefone: {$_POST['phone']} <br><br>" .
		           "Mensagem: <br>" . nl2br( $_POST['message'] ) . "<br><br>" .
		           "Email enviado a partir do formulário de Contato no site " . self::$siteName;

		$to = get_option( 'contact' ) ?: self::$to;

		$mailData = new MailData(
			$to,
			self::$siteName,
			self::$senderEmail,
			self::$siteName,
			$_POST['name'],
			$_POST['email'],
			$message,
			'Contato | ' . self::$siteName
		);

		FormController::sendMail( $mailData );
	}

	private static function workWithUs() {
		$message = "{$_POST['name']} possui interesse em trabalhar conosco, verfique os dados dele abaixo e o currículo em anexo:<br><br>" .
		           "Nome: {$_POST['name']} <br>" .
		           "Email: {$_POST['email']} <br>" .
		           "Telefone: {$_POST['phone']} <br><br>" .
		           "Email enviado a partir do formulário de Trabalhe Conosco no site " . self::$siteName;

		$to = get_option( 'work_with_us' ) ?: self::$to;

		$mailData = new MailData(
			$to,
			self::$siteName,
			self::$senderEmail,
			self::$siteName,
			$_POST['name'],
			$_POST['email'],
			$message,
			'Trabalhe Conosco | ' . self::$siteName,
			$_FILES['file']
		);

		FormController::sendMail( $mailData );
	}

	private static function requestAProposal() {
		$typeProposal    = isset( $_POST['type_proposal'] ) && ! empty( $_POST['type_proposal'] ) ? $_POST['type_proposal'] : null;
		$proposalMessage = null;

		if ( ! is_null( $typeProposal ) ) {
			$typeProposal = 'project' === $typeProposal ? 'Projeto' : 'Serviço';

			$proposalMessage = "Tipo do Orçamento: {$typeProposal}<br>" .
			                   "Título do {$typeProposal}: {$_POST['type_title']}<br>";
		}

		$message = "{$_POST['name']} solicitou um orçamento. Verifique os dados abaixo:<br><br>" .
		           "{$proposalMessage}" .
		           "Nome: {$_POST['name']} <br>" .
		           "Email: {$_POST['email']} <br>" .
		           "Telefone: {$_POST['phone']} <br>" .
		           "Cidade: {$_POST['city']}<br>" .
		           "Estado: {$_POST['state']}<br>" .
		           "Distribuidora: {$_POST['distributor']}<br>" .
		           "Tipo: {$_POST['type']}<br>" .
		           "Tipo de Trabalho: {$_POST['work_type']}<br>" .
		           "Valor da Tarifa: {$_POST['fare_amount']}<br><br>" .
		           "Mensagem: <br>" . nl2br( $_POST['message'] ) . "<br><br>" .
		           "Email enviado a partir do formulário de Solicite um Orçamento no site " . self::$siteName;

		$to = get_option( 'request_a_proposal' ) ?: self::$to;

		$mailData = new MailData(
			$to,
			self::$siteName,
			self::$senderEmail,
			self::$siteName,
			$_POST['name'],
			$_POST['email'],
			$message,
			'Solicitação de Orçamento | ' . self::$siteName,
			$_FILES['electricity_bill']
		);

		FormController::sendMail( $mailData );
	}
}

MailController::sendMail();