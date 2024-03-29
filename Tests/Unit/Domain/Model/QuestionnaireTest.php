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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Questionnaire.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_QuestionnaireTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Questionnaire
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Questionnaire();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() { 
		$this->fixture->setTitle('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getTitle()
		);
	}
	
	/**
	 * @test
	 */
	public function getDescriptionReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() { 
		$this->fixture->setDescription('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getDescription()
		);
	}
	
	/**
	 * @test
	 */
	public function getQuestionsReturnsInitialValueForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_Question() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getQuestions()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionsForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_QuestionSetsQuestions() { 
		$question = new Tx_HsQuestionnaire_Domain_Model_Question();
		$objectStorageHoldingExactlyOneQuestions = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQuestions->attach($question);
		$this->fixture->setQuestions($objectStorageHoldingExactlyOneQuestions);

		$this->assertSame(
			$objectStorageHoldingExactlyOneQuestions,
			$this->fixture->getQuestions()
		);
	}
	
	/**
	 * @test
	 */
	public function addQuestionToObjectStorageHoldingQuestions() {
		$question = new Tx_HsQuestionnaire_Domain_Model_Question();
		$objectStorageHoldingExactlyOneQuestion = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneQuestion->attach($question);
		$this->fixture->addQuestion($question);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneQuestion,
			$this->fixture->getQuestions()
		);
	}

	/**
	 * @test
	 */
	public function removeQuestionFromObjectStorageHoldingQuestions() {
		$question = new Tx_HsQuestionnaire_Domain_Model_Question();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($question);
		$localObjectStorage->detach($question);
		$this->fixture->addQuestion($question);
		$this->fixture->removeQuestion($question);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getQuestions()
		);
	}
	
}
?>