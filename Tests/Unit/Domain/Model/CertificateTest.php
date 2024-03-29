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
 * Test case for class Tx_HsQuestionnaire_Domain_Model_Certificate.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage hs_Questionnaire
 *
 */
class Tx_HsQuestionnaire_Domain_Model_CertificateTest extends Tx_Extbase_Tests_Unit_BaseTestCase {
	/**
	 * @var Tx_HsQuestionnaire_Domain_Model_Certificate
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_HsQuestionnaire_Domain_Model_Certificate();
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
	public function getCityReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setCityForStringSetsCity() { 
		$this->fixture->setCity('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getCity()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostNameXReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPostNameX()
		);
	}

	/**
	 * @test
	 */
	public function setPostNameXForIntegerSetsPostNameX() { 
		$this->fixture->setPostNameX(12);

		$this->assertSame(
			12,
			$this->fixture->getPostNameX()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostNameYReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPostNameY()
		);
	}

	/**
	 * @test
	 */
	public function setPostNameYForIntegerSetsPostNameY() { 
		$this->fixture->setPostNameY(12);

		$this->assertSame(
			12,
			$this->fixture->getPostNameY()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostCityXReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPostCityX()
		);
	}

	/**
	 * @test
	 */
	public function setPostCityXForIntegerSetsPostCityX() { 
		$this->fixture->setPostCityX(12);

		$this->assertSame(
			12,
			$this->fixture->getPostCityX()
		);
	}
	
	/**
	 * @test
	 */
	public function getPostCityYReturnsInitialValueForInteger() { 
		$this->assertSame(
			0,
			$this->fixture->getPostCityY()
		);
	}

	/**
	 * @test
	 */
	public function setPostCityYForIntegerSetsPostCityY() { 
		$this->fixture->setPostCityY(12);

		$this->assertSame(
			12,
			$this->fixture->getPostCityY()
		);
	}
	
	/**
	 * @test
	 */
	public function getQuestionnaireReturnsInitialValueForTx_HsQuestionnaire_Domain_Model_Questionnaire() { }

	/**
	 * @test
	 */
	public function setQuestionnaireForTx_HsQuestionnaire_Domain_Model_QuestionnaireSetsQuestionnaire() { }
	
}
?>