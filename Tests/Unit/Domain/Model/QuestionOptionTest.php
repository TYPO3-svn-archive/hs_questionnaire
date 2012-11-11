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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_QuestionOption.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_QuestionOptionTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_QuestionOption
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_QuestionOption();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getSelectionTypeReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getSelectionType()
		);
	}

	/**
	 * @test
	 */
	public function setSelectionTypeForIntegerSetsSelectionType() { 
		$this->fixture->setSelectionType(12);

		$this->assertSame(
			12,
			$this->fixture->getSelectionType()
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
	
}
?>