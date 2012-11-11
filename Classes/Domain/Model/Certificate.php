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
 * Model certificate
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Domain_Model_Certificate extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title;

	/**
	 * city
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $city;

	/**
	 * Adds an image to the certificate
	 *
	 * @var string
	 */
	protected $image;


	/**
	 * postNameX
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $postNameX;

	/**
	 * postNameY
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $postNameY;

	/**
	 * postCityX
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $postCityX;

	/**
	 * postCityY
	 *
	 * @var integer
	 * @validate NotEmpty
	 */
	protected $postCityY;

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return void
	 */
	public function setCity($city) {
		$this->city = $city;
	}

	/**
	 * Returns the postNameX
	 *
	 * @return integer $postNameX
	 */
	public function getPostNameX() {
		return $this->postNameX;
	}

	/**
	 * Sets the postNameX
	 *
	 * @param integer $postNameX
	 * @return void
	 */
	public function setPostNameX($postNameX) {
		$this->postNameX = $postNameX;
	}

	/**
	 * Returns the postNameY
	 *
	 * @return integer $postNameY
	 */
	public function getPostNameY() {
		return $this->postNameY;
	}

	/**
	 * Sets the postNameY
	 *
	 * @param integer $postNameY
	 * @return void
	 */
	public function setPostNameY($postNameY) {
		$this->postNameY = $postNameY;
	}

	/**
	 * Returns the postCityX
	 *
	 * @return integer $postCityX
	 */
	public function getPostCityX() {
		return $this->postCityX;
	}

	/**
	 * Sets the postCityX
	 *
	 * @param integer $postCityX
	 * @return void
	 */
	public function setPostCityX($postCityX) {
		$this->postCityX = $postCityX;
	}

	/**
	 * Returns the postCityY
	 *
	 * @return integer $postCityY
	 */
	public function getPostCityY() {
		return $this->postCityY;
	}

	/**
	 * Sets the postCityY
	 *
	 * @param integer $postCityY
	 * @return void
	 */
	public function setPostCityY($postCityY) {
		$this->postCityY = $postCityY;
	}

	/**
	 * Returns the image of the certificate
	 *
	 * @return string
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image of the certificate
	 *
	 * @param string $image
	 */
	public function setImage($image) {
		$this->image = $image;
	}
}

?>