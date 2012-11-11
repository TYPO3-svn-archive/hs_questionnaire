<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Ruether <tim@holosystems.de>
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

/**
 * Export Email
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Export_Email {

	/**
	 * send to
	 * @var string
	 */
	protected $to;

	/**
	 * send by
	 * @var string
	 */
	protected $from;

	/**
	 * the subject
	 * @var string
	 */
	protected $subject;

	/**
	 * the message
	 * @var string
	 */
	protected $message;

	/**
	 *
	 * @var string
	 */
	protected $attachmentName;

	/**
	 *
	 * @var string
	 */
	protected $AttachmentPath;

	/**
	 * Create a new object of type email
	 *
	 * @param string $to
	 * @param string $from
	 * @param string $subject
	 * @param string $message
	 * @param string $attachmentName
	 * @param string $AttachmentPath
	 * @return void
	 */
	public function __construct($to, $from, $subject, $message, $attachmentName = NULL, $AttachmentPath = NULL) {
		$this->to = $to;
		$this->from = $from;
		$this->subject = $subject;
		$this->message = $message;
		$this->attachmentName = $attachmentName;
		$this->AttachmentPath = $AttachmentPath;
	}

	/**
	 * get, where email should be send to
	 *
	 * @return string
	 */
	protected function getTo() {
		return $this->to;
	}

	/**
	 * set where message should be send to
	 *
	 * @param string $to
	 * @return void
	 */
	protected function setTo($to) {
		$this->to = $to;
	}

	/**
	 * get where message was send by
	 *
	 * @return string
	 */
	protected function getFrom() {
		return $this->from;
	}

	/**
	 * set where message was send by
	 *
	 * @param string $from
	 * @return void
	 */
	protected function setFrom($from) {
		$this->from = $from;
	}

	/**
	 * get the subject
	 *
	 * @return string
	 */
	protected function getSubject() {
		return $this->subject;
	}

	/**
	 * set the subject
	 *
	 * @param string $subject
	 * @return void
	 */
	protected function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * get the message
	 *
	 * @return string
	 */
	protected function getMessage() {
		return $this->message;
	}

	/**
	 * set the message
	 *
	 * @param string $message
	 * @return void
	 */
	protected function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * get the name of the attachment
	 *
	 * @return string
	 */
	protected function getAttachmentName() {
		return $this->attachmentName;
	}

	/**
	 * set the name of the attachment
	 *
	 * @param string $attachmentName
	 * @return void
	 */
	protected function setAttachmentName($attachmentName) {
		$this->attachmentName = $attachmentName;
	}

	/**
	 * get the attachment content
	 *
	 * @return string
	 * @return void
	 */
	protected function getAttachmentPath() {
		return $this->AttachmentPath;
	}

	/**
	 * set the attachment content
	 *
	 * @param string $AttachmentPath
	 * @return void
	 */
	protected function setAttachmentPath($AttachmentPath) {
		$this->AttachmentPath = $AttachmentPath;
	}

	/**
	 * send the mail
	 *
	 * @return void
	 */
	public function send() {
		/*
		 * Mail mit Anhang nur versenden, wenn Anhang vorhanden ist
		 * Abesendung und Empfänger Adressen festlegen
		 */
		if ($this->getAttachmentPath() != NULL && $this->getAttachmentName() != NULL) {
			$boundary = strtoupper(md5(uniqid(time())));

			$mailHeader = 'From:' . $this->getFrom() . '\n';
			$mailHeader .= 'MIME-Version: 1.0';
			$mailHeader .= '\nContent-Type: multipart/mixed; boundary=$boundary';
			$mailHeader .= '\n\nThis is a multi-part message in MIME format  --  Dies ist eine mehrteilige Nachricht im MIME-Format';
			$mailHeader .= '\n--$boundary';
			/*
			 * add attachment datat to email
			 */
			$mailHeader .= '\nContent-Type: text/html; charset=utf-8';
			$mailHeader .= '\nContent-Transfer-Encoding: 8bit';
			$mailHeader .= '\n\n' . $this->getMessage();
			$fileContent = fread(fopen($this->getAttachmentPath(), 'r'), filesize($this->getAttachmentPath()));
			$fileContent = chunk_split(base64_encode($fileContent));
			$mailHeader .= '\n--$boundary';
			/*
			 * Add attachment name to email
			 */
			$mailHeader .= '\nContent-Type: application/octetstream; name=\'' . $this->getAttachmentName() . '\'';
			$mailHeader .= '\nContent-Transfer-Encoding: base64';
			$mailHeader .= '\nContent-Disposition: attachment; filename=\'' . $this->getAttachmentName() . '\'';
			$mailHeader .= '\n\n$fileContent';
			$mailHeader .= '\n--$boundary--';

			/*
			 * put all things together to send mail with
			 * php mail() function
			 */
			mail($this->getTo(), $this->getSubject(), $this->getMessage(), $mailHeader);
		} else {
			$mailHeader = 'From:' . $this->getFrom();
			mail($this->getTo(), $this->getSubject(), $this->getMessage(), $mailHeader);
		}
	}
}

?>