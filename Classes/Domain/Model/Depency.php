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
 * Model depency
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Domain_Model_Depency extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * Dependencies on question.
	 *
	 * @var integer
	 */
	protected $question;

	/**
	 * Dependencies on answer.
	 *
	 * @var integer
	 */
	protected $answer;

	/**
	 * Returns the question
	 *
	 * @return integer $question
	 */
	public function getQuestion() {
		return $this->question;
	}

	/**
	 * Sets the question
	 *
	 * @param integer $question
	 * @return void
	 */
	public function setQuestion($question) {
		$this->question = $question;
	}

	/**
	 * Returns the answer
	 *
	 * @return integer $answer
	 */
	public function getAnswer() {
		return $this->answer;
	}

	/**
	 * Sets the answer
	 *
	 * @param integer $answer
	 * @return void
	 */
	public function setAnswer($answer) {
		$this->answer = $answer;
	}

}
?>