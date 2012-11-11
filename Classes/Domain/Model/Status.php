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
 *
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Domain_Model_Status extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * isAborted
	 *
	 * @var boolean
	 */
	protected $isAborted = FALSE;

	/**
	 * isFailed
	 *
	 * @var boolean
	 */
	protected $isFailed = FALSE;

	/**
	 * isPassed
	 *
	 * @var boolean
	 */
	protected $isPassed = FALSE;

	/**
	 * Returns the isAborted
	 *
	 * @return boolean $isAborted
	 */
	public function getIsAborted() {
		return $this->isAborted;
	}

	/**
	 * Sets the isAborted
	 *
	 * @param boolean $isAborted
	 * @return void
	 */
	public function setIsAborted($isAborted) {
		$this->isAborted = $isAborted;
	}

	/**
	 * Returns the boolean state of isAborted
	 *
	 * @return boolean
	 */
	public function isIsAborted() {
		return $this->getIsAborted();
	}

	/**
	 * Returns the isFailed
	 *
	 * @return boolean $isFailed
	 */
	public function getIsFailed() {
		return $this->isFailed;
	}

	/**
	 * Sets the isFailed
	 *
	 * @param boolean $isFailed
	 * @return void
	 */
	public function setIsFailed($isFailed) {
		$this->isFailed = $isFailed;
	}

	/**
	 * Returns the boolean state of isFailed
	 *
	 * @return boolean
	 */
	public function isIsFailed() {
		return $this->getIsFailed();
	}

	/**
	 * Returns the isPassed
	 *
	 * @return boolean $isPassed
	 */
	public function getIsPassed() {
		return $this->isPassed;
	}

	/**
	 * Sets the isPassed
	 *
	 * @param boolean $isPassed
	 * @return void
	 */
	public function setIsPassed($isPassed) {
		$this->isPassed = $isPassed;
	}

	/**
	 * Returns the boolean state of isPassed
	 *
	 * @return boolean
	 */
	public function isIsPassed() {
		return $this->getIsPassed();
	}
}

?>