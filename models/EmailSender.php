<?php
// Pomocná třída, poskytující metody pro odeslání emailu
class EmailSender
{

	// Odešle email jako HTML, lze tedy používat základní HTML tagy a nové
	// řádky je třeba psát jako <br /> nebo používat odstavce. Kódování je
	// odladěno pro UTF-8.
	public function send($recipient, $subject, $message, $from)
	{
		$header = "From: " . $from;
		$header .= "\nMIME-Version: 1.0\n";
		$header .= "Content-Type: text/html; charset=\"utf-8\"\n";
		if (!mb_send_mail($recipient, $subject, $message, $header))
			throw new UserError('Email se nepodařilo odeslat.');
	}
	
	// Zkontroluje zda byl zadán aktuální rok jako antispam a odešle email
	public function sendWAntispam($year, $recipient, $subject, $message, $from)
	{
		if ($year != date("Y"))
			throw new UserError('Chybně vyplněný antispam.');
		$this->send($recipient, $subject, $message, $from);
	}
	
}