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
 * answer controller
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_AnswerController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * answerRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_AnswerRepository
	 */
	protected $answerRepository;

	/**
	 * injectAnswerRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_AnswerRepository $answerRepository
	 * @return void
	 */
	public function injectAnswerRepository(Tx_HsQuestionnaire_Domain_Repository_AnswerRepository $answerRepository) {
		$this->answerRepository = $answerRepository;
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$answers = $this->answerRepository->findAll();
		$answers = $this->answerRepository->findbyRandom();
		$this->view->assign('answers', $answers);
	}
}
?>