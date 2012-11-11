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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Question.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_QuestionTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Question
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Question();
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
	public function getQuestionTextReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setQuestionTextForStringSetsQuestionText() { 
		$this->fixture->setQuestionText('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getQuestionText()
		);
	}
	
	/**
	 * @test
	 */
	public function getPointsReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPoints()
		);
	}

	/**
	 * @test
	 */
	public function setPointsForIntegerSetsPoints() { 
		$this->fixture->setPoints(12);

		$this->assertSame(
			12,
			$this->fixture->getPoints()
		);
	}
	
	/**
	 * @test
	 */
	public function getMaxAnswerCountReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getMaxAnswerCount()
		);
	}

	/**
	 * @test
	 */
	public function setMaxAnswerCountForIntegerSetsMaxAnswerCount() { 
		$this->fixture->setMaxAnswerCount(12);

		$this->assertSame(
			12,
			$this->fixture->getMaxAnswerCount()
		);
	}
	
	/**
	 * @test
	 */
	public function getImagesReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setImagesForStringSetsImages() { 
		$this->fixture->setImages('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getImages()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsRandomOrderReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsRandomOrder()
		);
	}

	/**
	 * @test
	 */
	public function setIsRandomOrderForBooleanSetsIsRandomOrder() { 
		$this->fixture->setIsRandomOrder(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsRandomOrder()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsRequiredReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsRequired()
		);
	}

	/**
	 * @test
	 */
	public function setIsRequiredForBooleanSetsIsRequired() { 
		$this->fixture->setIsRequired(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsRequired()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsPassedRequiredReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsPassedRequired()
		);
	}

	/**
	 * @test
	 */
	public function setIsPassedRequiredForBooleanSetsIsPassedRequired() { 
		$this->fixture->setIsPassedRequired(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsPassedRequired()
		);
	}
	
	/**
	 * @test
	 */
	public function getShowIfDependenciesReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getShowIfDependencies()
		);
	}

	/**
	 * @test
	 */
	public function setShowIfDependenciesForBooleanSetsShowIfDependencies() { 
		$this->fixture->setShowIfDependencies(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getShowIfDependencies()
		);
	}
	
	/**
	 * @test
	 */
	public function getTypeReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getType()
		);
	}

	/**
	 * @test
	 */
	public function setTypeForIntegerSetsType() { 
		$this->fixture->setType(12);

		$this->assertSame(
			12,
			$this->fixture->getType()
		);
	}
	
	/**
	 * @test
	 */
	public function getDependonReturnsInitialValueForTx_HsQuestionnaire_Domain_Model_Depency() { }

	/**
	 * @test
	 */
	public function setDependonForTx_HsQuestionnaire_Domain_Model_DepencySetsDependon() { }
	
	/**
	 * @test
	 */
	public function getAnswersReturnsInitialValueForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_Answer() { 
		$newObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->fixture->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setAnswersForObjectStorageContainingTx_HsQuestionnaire_Domain_Model_AnswerSetsAnswers() { 
		$answer = new Tx_HsQuestionnaire_Domain_Model_Answer();
		$objectStorageHoldingExactlyOneAnswers = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAnswers->attach($answer);
		$this->fixture->setAnswers($objectStorageHoldingExactlyOneAnswers);

		$this->assertSame(
			$objectStorageHoldingExactlyOneAnswers,
			$this->fixture->getAnswers()
		);
	}
	
	/**
	 * @test
	 */
	public function addAnswerToObjectStorageHoldingAnswers() {
		$answer = new Tx_HsQuestionnaire_Domain_Model_Answer();
		$objectStorageHoldingExactlyOneAnswer = new Tx_Extbase_Persistence_ObjectStorage();
		$objectStorageHoldingExactlyOneAnswer->attach($answer);
		$this->fixture->addAnswer($answer);

		$this->assertEquals(
			$objectStorageHoldingExactlyOneAnswer,
			$this->fixture->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function removeAnswerFromObjectStorageHoldingAnswers() {
		$answer = new Tx_HsQuestionnaire_Domain_Model_Answer();
		$localObjectStorage = new Tx_Extbase_Persistence_ObjectStorage();
		$localObjectStorage->attach($answer);
		$localObjectStorage->detach($answer);
		$this->fixture->addAnswer($answer);
		$this->fixture->removeAnswer($answer);

		$this->assertEquals(
			$localObjectStorage,
			$this->fixture->getAnswers()
		);
	}
	
}
?>