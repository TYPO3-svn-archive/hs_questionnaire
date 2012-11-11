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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Status.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_StatusTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Status
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Status();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getIsAbortedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsAborted()
		);
	}

	/**
	 * @test
	 */
	public function setIsAbortedForBooleanSetsIsAborted() { 
		$this->fixture->setIsAborted(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsAborted()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsFailedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsFailed()
		);
	}

	/**
	 * @test
	 */
	public function setIsFailedForBooleanSetsIsFailed() { 
		$this->fixture->setIsFailed(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsFailed()
		);
	}
	
	/**
	 * @test
	 */
	public function getIsPassedReturnsInitialValueForBoolean() { 
		$this->assertSame(
			TRUE,
			$this->fixture->getIsPassed()
		);
	}

	/**
	 * @test
	 */
	public function setIsPassedForBooleanSetsIsPassed() { 
		$this->fixture->setIsPassed(TRUE);

		$this->assertSame(
			TRUE,
			$this->fixture->getIsPassed()
		);
	}
	
}
?>