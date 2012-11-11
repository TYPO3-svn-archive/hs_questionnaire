<?php

/***************************************************************
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
 ***************************************************************/

/**
 * Model questionnaire
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Domain_Model_Questionnaire extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * The title of the questionnaire.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * The description of the questionnaire.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $description;

	/**
	 * Adds an image to the questionnaire
	 *
	 * @var string
	 */
	protected $image;

	/**
	 * questions
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Question>
	 */
	protected $questions;

	/**
	 * The certifikat of the questionnaire.
	 *
	 * @var Tx_HsQuestionnaire_Domain_Model_Certificate
	 */
	protected $certificate;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
			// Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all Tx_Extbase_Persistence_ObjectStorage properties.
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		/**
		 * Do not modify this method!
		 * It will be rewritten on each save in the extension builder
		 * You may modify the constructor of this class instead
		 */
		$this->questions = t3lib_div::makeInstance('Tx_Extbase_Persistence_ObjectStorage');
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Adds a Question
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Question $question
	 * @return void
	 */
	public function addQuestion(Tx_HsQuestionnaire_Domain_Model_Question $question) {
		$this->questions->attach($question);
	}

	/**
	 * Removes a Question
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Question $questionToRemove The Question to be removed
	 * @return void
	 */
	public function removeQuestion(Tx_HsQuestionnaire_Domain_Model_Question $questionToRemove) {
		$this->questions->detach($questionToRemove);
	}

	/**
	 * Returns the questions
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Question> $questions
	 */
	public function getQuestions() {
		return $this->questions;
	}

	/**
	 * Sets the questions
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Question> $questions
	 * @return void
	 */
	public function setQuestions(Tx_Extbase_Persistence_ObjectStorage $questions) {
		$this->questions = $questions;
	}

	/**
	 * Returns the certificate
	 *
	 * @return Tx_HsQuestionnaire_Domain_Model_Certificate $certificate
	 */
	public function getCertificate() {
		return $this->certificate;
	}

	/**
	 * Sets the certificate
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Certificate $certificate
	 * @return void
	 */
	public function setCertificate(Tx_HsQuestionnaire_Domain_Model_Certificate $certificate) {
		$this->certificate = $certificate;
	}

	/**
	 * Returns the image of the questionnaire
	 *
	 * @return string
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image of the questionnaire
	 *
	 * @param string $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}

}

?>