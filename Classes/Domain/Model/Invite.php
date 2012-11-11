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
 * Model invite
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 */
class Tx_HsQuestionnaire_Domain_Model_Invite extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * inviteon
	 *
	 * @var DateTime
	 */
	protected $inviteon;

	/**
	 * invitecode
	 *
	 * @var string
	 */
	protected $invitecode;

	/**
	 * The questionnaire of the invite.
	 *
	 * @var Tx_HsQuestionnaire_Domain_Model_Questionnaire
	 */
	protected $questionnaire;

	/**
	 * The feuser of the invite.
	 *
	 * @var Tx_HsQuestionnaire_Domain_Model_Feuser
	 */
	protected $feuser;

	/**
	 * The feuser of the invite.
	 *
	 * @var Tx_HsQuestionnaire_Domain_Model_Fegroup
	 */
	protected $fegroup;

	/**
	 * Returns the inviteon
	 *
	 * @return DateTime $inviteon
	 */
	public function getInviteon() {
		return $this->inviteon;
	}

	/**
	 * Sets the inviteon
	 *
	 * @param DateTime $inviteon
	 * @return void
	 */
	public function setInviteon($inviteon) {
		$this->inviteon = $inviteon;
	}

	/**
	 * Returns the invitecode
	 *
	 * @return string $invitecode
	 */
	public function getinvitecode() {
		return $this->invitecode;
	}

	/**
	 * Sets the invitecode
	 *
	 * @param string $invitecode
	 * @return void
	 */
	public function setinvitecode($invitecode) {
		$this->invitecode = $invitecode;
	}

	/**
	 * Returns the questionnaire
	 *
	 * @return Tx_HsQuestionnaire_Domain_Model_Questionnaire $questionnaire
	 */
	public function getQuestionnaire() {
		return $this->questionnaire;
	}

	/**
	 * Sets the questionnaire
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Questionnaire $questionnaire
	 * @return void
	 */
	public function setQuestionnaire(Tx_HsQuestionnaire_Domain_Model_Questionnaire $questionnaire) {
		$this->questionnaire = $questionnaire;
	}

	/**
	 * Returns the feuser
	 *
	 * @return Tx_HsQuestionnaire_Domain_Model_Feuser $feuser
	 */
	public function getFeuser() {
		return $this->feuser;
	}

	/**
	 * Sets the feuser
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Feuser $feuser
	 * @return void
	 */
	public function setFeuser(Tx_HsQuestionnaire_Domain_Model_Feuser $feuser) {
		$this->feuser = $feuser;
	}

	/**
	 *
	 * @return Tx_HsQuestionnaire_Domain_Model_Fegroup
	 */
	public function getFegroup() {
		return $this->fegroup;
	}

	/**
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Fegroup $fegroup
	 */
	public function setFegroup($fegroup) {
		$this->fegroup = $fegroup;
	}

}

?>