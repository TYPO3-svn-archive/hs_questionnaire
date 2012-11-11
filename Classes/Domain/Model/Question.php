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
 * Model question
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 */
class Tx_HsQuestionnaire_Domain_Model_Question extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Title in Backend
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * The text of question.
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $questionText;

	/**
	 * The points of the question.
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $points;

	/**
	 * Maximum count of answers to be given by participant.
	 *
	 * @var integer
	 */
	protected $maxAnswerCount;

	/**
	 * Add a custom image to the question.
	 *
	 * @var string
	 */
	protected $images;

	/**
	 * Answers displayed in radom order.
	 *
	 * @var boolean
	 */
	protected $isRandomOrder = FALSE;

	/**
	 * Is question need to be answered?
	 *
	 * @var boolean
	 */
	protected $isRequired = FALSE;

	/**
	 * Question need to be answered correctly?
	 *
	 * @var boolean
	 */
	protected $isPassedRequired = FALSE;

	/**
	 * Show when question has dependencies?
	 *
	 * @var boolean
	 */
	protected $showIfDependencies = FALSE;

	/**
	 * The question type.
	 *
	 * @var integer
	 */
	protected $type;

	/**
	 * Dependencies to other questions.
	 *
	 * @var Tx_HsQuestionnaire_Domain_Model_Depency
	 */
	protected $dependon;

	/**
	 * The answers of the question.
	 *
	 * @var Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Answer>
	 */
	protected $answers;

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
		$this->answers = new Tx_Extbase_Persistence_ObjectStorage();
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
	 * Returns the questionText
	 *
	 * @return string $questionText
	 */
	public function getQuestionText() {
		return $this->questionText;
	}

	/**
	 * Sets the questionText
	 *
	 * @param string $questionText
	 * @return void
	 */
	public function setQuestionText($questionText) {
		$this->questionText = $questionText;
	}

	/**
	 * Returns the points
	 *
	 * @return integer $points
	 */
	public function getPoints() {
		return $this->points;
	}

	/**
	 * Sets the points
	 *
	 * @param integer $points
	 * @return void
	 */
	public function setPoints($points) {
		$this->points = $points;
	}

	/**
	 * Returns the maxAnswerCount
	 *
	 * @return integer $maxAnswerCount
	 */
	public function getMaxAnswerCount() {
		return $this->maxAnswerCount;
	}

	/**
	 * Sets the maxAnswerCount
	 *
	 * @param integer $maxAnswerCount
	 * @return void
	 */
	public function setMaxAnswerCount($maxAnswerCount) {
		$this->maxAnswerCount = $maxAnswerCount;
	}

	/**
	 * Returns the images
	 *
	 * @return string $images
	 */
	public function getImages() {
		return $this->images;
	}

	/**
	 * Sets the images
	 *
	 * @param string $images
	 * @return void
	 */
	public function setImages($images) {
		$this->images = $images;
	}

	/**
	 * Returns the isRandomOrder
	 *
	 * @return boolean $isRandomOrder
	 */
	public function getIsRandomOrder() {
		return $this->isRandomOrder;
	}

	/**
	 * Sets the isRandomOrder
	 *
	 * @param boolean $isRandomOrder
	 * @return void
	 */
	public function setIsRandomOrder($isRandomOrder) {
		$this->isRandomOrder = $isRandomOrder;
	}

	/**
	 * Returns the boolean state of isRandomOrder
	 *
	 * @return boolean
	 */
	public function isIsRandomOrder() {
		return $this->getIsRandomOrder();
	}

	/**
	 * Returns the isRequired
	 *
	 * @return boolean $isRequired
	 */
	public function getIsRequired() {
		return $this->isRequired;
	}

	/**
	 * Sets the isRequired
	 *
	 * @param boolean $isRequired
	 * @return void
	 */
	public function setIsRequired($isRequired) {
		$this->isRequired = $isRequired;
	}

	/**
	 * Returns the boolean state of isRequired
	 *
	 * @return boolean
	 */
	public function isIsRequired() {
		return $this->getIsRequired();
	}

	/**
	 * Returns the isPassedRequired
	 *
	 * @return boolean $isPassedRequired
	 */
	public function getIsPassedRequired() {
		return $this->isPassedRequired;
	}

	/**
	 * Sets the isPassedRequired
	 *
	 * @param boolean $isPassedRequired
	 * @return void
	 */
	public function setIsPassedRequired($isPassedRequired) {
		$this->isPassedRequired = $isPassedRequired;
	}

	/**
	 * Returns the boolean state of isPassedRequired
	 *
	 * @return boolean
	 */
	public function isIsPassedRequired() {
		return $this->getIsPassedRequired();
	}

	/**
	 * Returns the showIfDependencies
	 *
	 * @return boolean $showIfDependencies
	 */
	public function getShowIfDependencies() {
		return $this->showIfDependencies;
	}

	/**
	 * Sets the showIfDependencies
	 *
	 * @param boolean $showIfDependencies
	 * @return void
	 */
	public function setShowIfDependencies($showIfDependencies) {
		$this->showIfDependencies = $showIfDependencies;
	}

	/**
	 * Returns the boolean state of showIfDependencies
	 *
	 * @return boolean
	 */
	public function isShowIfDependencies() {
		return $this->getShowIfDependencies();
	}

	/**
	 * Returns the type
	 *
	 * @return integer $type
	 */
	public function getType() {
		return $this->type;
	}

	/**
	 * Sets the type
	 *
	 * @param integer $type
	 * @return void
	 */
	public function setType($type) {
		$this->type = $type;
	}

	/**
	 * Returns the dependon
	 *
	 * @return Tx_HsQuestionnaire_Domain_Model_Depency $dependon
	 */
	public function getDependon() {
		return $this->dependon;
	}

	/**
	 * Sets the dependon
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Depency $dependon
	 * @return void
	 */
	public function setDependon(Tx_HsQuestionnaire_Domain_Model_Depency $dependon) {
		$this->dependon = $dependon;
	}

	/**
	 * Adds a Answer
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Answer $answer
	 * @return void
	 */
	public function addAnswer(Tx_HsQuestionnaire_Domain_Model_Answer $answer) {
		$this->answers->attach($answer);
	}

	/**
	 * Removes a Answer
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Answer $answerToRemove The Answer to be removed
	 * @return void
	 */
	public function removeAnswer(Tx_HsQuestionnaire_Domain_Model_Answer $answerToRemove) {
		$this->answers->detach($answerToRemove);
	}

	/**
	 * Returns the answers
	 *
	 * @return Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Answer> $answers
	 */
	public function getAnswers() {
		return $this->sortAnswers();
	}

	/**
	 * Sets the answers
	 *
	 * @param Tx_Extbase_Persistence_ObjectStorage<Tx_HsQuestionnaire_Domain_Model_Answer> $answers
	 * @return void
	 */
	public function setAnswers(Tx_Extbase_Persistence_ObjectStorage $answers) {
		$this->answers = $answers;
	}

	/**
	 *
	 * @return array
	 */
	private function sortAnswers() {

		if ($this->isRandomOrder == 1) {
			$answers = $this->answers;

			$answerUidArray = array();

			foreach ($answers as $answer) {
				array_push($answerUidArray, $answer->getUid());
			}
			shuffle($answerUidArray);

			$answerArray = array();
			foreach ($answerUidArray as $uid) {
				foreach ($answers as $answer) {
					if ($uid == $answer->getUid()) {
						array_push($answerArray, $answer);
					}
				}
			}

			return $answerArray;
		} else {
			return $this->answers;
		}
	}
}

?>