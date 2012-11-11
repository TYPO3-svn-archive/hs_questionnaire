<?php

/* * *************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Tim Ruether <tim@holosystems.de> Stefan Seehafer @ Holosystems <stefan@holosystems>
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
 * ************************************************************* */

/**
 *
 * @package hs_questionnaire
 *
 */
class Tx_HsQuestionnaire_ViewHelpers_HtmlscViewHelper extends Tx_Fluid_Core_ViewHelper_AbstractViewHelper {

	/**
	 * Viewhelper to check radiobuttons and checkboxes in order to given current answer id $current
	 * and results array $valArray
	 * if return is true, radiobuttons/checkboxes is checked
	 * if return in false, radiobuttons/checkboxes is not checked
	 *
	 * @param string $string
	 * @return string
	 */
	public function render($string) {

		return html_entity_decode($string);
	}

}

?>