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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Depency.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_DepencyTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Depency
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Depency();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getQuestionReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getQuestion()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionForIntegerSetsQuestion() { 
		$this->fixture->setQuestion(12);

		$this->assertSame(
			12,
			$this->fixture->getQuestion()
		);
	}
	
	/**
	 * @test
	 */
	public function getAnswerReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getAnswer()
		);
	}

	/**
	 * @test
	 */
	public function setAnswerForIntegerSetsAnswer() { 
		$this->fixture->setAnswer(12);

		$this->assertSame(
			12,
			$this->fixture->getAnswer()
		);
	}
	
}
?>