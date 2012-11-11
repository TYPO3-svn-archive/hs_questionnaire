<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Invite.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_InviteTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Invite
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Invite();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getInviteonReturnsInitialValueForDateTime() { }

	/**
	 * @test
	 */
	public function setInviteonForDateTimeSetsInviteon() { }
	
	/**
	 * @test
	 */
	public function getinvitecodeReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setinvitecodeForStringSetsinvitecode() { 
		$this->fixture->setinvitecode('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getinvitecode()
		);
	}
	
	/**
	 * @test
	 */
	public function getQuestionnaireReturnsInitialValueForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_Questionnaire() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getQuestionnaire()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionnaireForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_QuestionnaireSetsQuestionnaire() { 
		$questionnaire = new Tx_HsQuestionnaire_Domain_Model_Questionnaire();
		$objectStorageHoldingExactlyOneQuestionnaire = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQuestionnaire->attach($questionnaire);
		$this->fixture->setQuestionnaire($objectStorageHoldingExactlyOneQuestionnaire);

		$this->assertSame(
			$objectStorageHoldingExactlyOneQuestionnaire,
			$this->fixture->getQuestionnaire()
		);
	}
	
	/**
	 * @test
	 */
	public function addQuestionnaireToObjectStorageHoldingQuestionnaire() {
		$questionnaire = new Tx_HsQuestionnaire_Domain_Model_Questionnaire();
		$objectStorageHoldingExactlyOneQuestionnaire = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQuestionnaire->attach($questionnaire);
		$this->fixture->addQuestionnaire($questionnaire);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneQuestionnaire,
			$this->fixture->getQuestionnaire()
		);
	}

	/**
	 * @test
	 */
	public function removeQuestionnaireFromObjectStorageHoldingQuestionnaire() {
		$questionnaire = new Tx_HsQuestionnaire_Domain_Model_Questionnaire();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($questionnaire);
		$localObjectStorage->detach($questionnaire);
		$this->fixture->addQuestionnaire($questionnaire);
		$this->fixture->removeQuestionnaire($questionnaire);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getQuestionnaire()
		);
	}
	
	/**
	 * @test
	 */
	public function getFeuserReturnsInitialValueForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_Feuser() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getFeuser()
		);
	}

	/**
	 * @test
	 */
	public function setFeuserForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_FeuserSetsFeuser() { 
		$feuser = new Tx_HsQuestionnaire_Domain_Model_Feuser();
		$objectStorageHoldingExactlyOneFeuser = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneFeuser->attach($feuser);
		$this->fixture->setFeuser($objectStorageHoldingExactlyOneFeuser);

		$this->assertSame(
			$objectStorageHoldingExactlyOneFeuser,
			$this->fixture->getFeuser()
		);
	}
	
	/**
	 * @test
	 */
	public function addFeuserToObjectStorageHoldingFeuser() {
		$feuser = new Tx_HsQuestionnaire_Domain_Model_Feuser();
		$objectStorageHoldingExactlyOneFeuser = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneFeuser->attach($feuser);
		$this->fixture->addFeuser($feuser);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneFeuser,
			$this->fixture->getFeuser()
		);
	}

	/**
	 * @test
	 */
	public function removeFeuserFromObjectStorageHoldingFeuser() {
		$feuser = new Tx_HsQuestionnaire_Domain_Model_Feuser();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($feuser);
		$localObjectStorage->detach($feuser);
		$this->fixture->addFeuser($feuser);
		$this->fixture->removeFeuser($feuser);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getFeuser()
		);
	}
	
}
?>