<?php

/* * *************************************************************
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
 * ************************************************************* */

/**
 * Questionnaire controller
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_QuestionnaireController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * questionnaireRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_QuestionnaireRepository
	 */
	protected $questionnaireRepository;

	/**
	 * resultRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_ResultRepository
	 */
	protected $resultRepository;

	/**
	 * inviteRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_InviteRepository
	 */
	protected $inviteRepository;

	/**
	 * feuserRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_FeuserRepository
	 */
	protected $feuserRepository;

	/**
	 * injectQuestionnaireRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_QuestionnaireRepository $questionnaireRepository
	 * @return void
	 */
	public function injectQuestionnaireRepository(Tx_HsQuestionnaire_Domain_Repository_QuestionnaireRepository $questionnaireRepository) {
		$this->questionnaireRepository = $questionnaireRepository;
	}

	/**
	 * injectResultRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_ResultRepository $resultRepository
	 * @return void
	 */
	public function injectResultRepository(Tx_HsQuestionnaire_Domain_Repository_ResultRepository $resultRepository) {
		$this->resultRepository = $resultRepository;
	}

	/**
	 * injectInviteRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_InviteRepository $inviteRepository
	 * @return void
	 */
	public function injectInviteRepository(Tx_HsQuestionnaire_Domain_Repository_InviteRepository $inviteRepository) {
		$this->inviteRepository = $inviteRepository;
	}

	/**
	 * injectFeuserRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_FeuserRepository $feuserRepository
	 * @return void
	 */
	public function injectFeuserRepository(Tx_HsQuestionnaire_Domain_Repository_FeuserRepository $feuserRepository) {
		$this->feuserRepository = $feuserRepository;
	}

	/**
	 * list action
	 *
	 * @param bool $passedShowDownload
	 * @param array $result
	 * @return void
	 */
	public function listAction($passedShowDownload = FALSE, $result = array()) {
		$this->view->assign('result', $result);
		$this->view->assign('passedShowDownload', $passedShowDownload);
	}

	/**
	 * action show
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Questionnaire $questionnaire
	 * @param array $result
	 * @param array $emptyquestions
	 * @return void
	 */
	public function showAction(Tx_HsQuestionnaire_Domain_Model_Questionnaire $questionnaire, $result = array(), $emptyquestions = NULL) {

		$hasPassed = FALSE;

		try {
			$existingResults = $this->resultRepository->findByFeuserAndQuestionnaire($GLOBALS['TSFE']->fe_user->user['uid'], $questionnaire);
		} catch (Exception $e) {
			$existingResults = FALSE;
		}

		if (is_object($existingResults)) {
			foreach ($existingResults AS $existingResult) {
				if ($existingResult->getStatus()->getIsPassed()) {
					$hasPassed = TRUE;
					$resultDownload = $existingResult;
				}
			}
		}

		if (!$hasPassed) {
			$this->view->assign('emptyquestions', $emptyquestions);
			$this->view->assign('result', $result);
			$this->view->assign('questionnaire', $questionnaire);

		} else {
			$this->redirect(
				'list',
				'Questionnaire',
				$this->extensionName,
				array(
					'passedShowDownload' => TRUE,
					'result' => $resultDownload
				)
			);
		}
	}

	/**
	 * creates a direkt link to the questionnaire
	 *
	 * @return void
	 */
	public function linkAction() {

		$hasPassed = FALSE;

		try {
			$questionnaire = $this->questionnaireRepository->findByUid($this->settings['questionnaire']);
		} catch (Exception $e) {
			$questionnaire = FALSE;
		}

		if ($questionnaire !== FALSE) {

			try {
				$existingResults = $this->resultRepository->findByFeuserAndQuestionnaire($GLOBALS['TSFE']->fe_user->user['uid'], $questionnaire);
			} catch (Exception $e) {
				$existingResults = FALSE;
			}

			if ($existingResults !== FALSE) {
				foreach ($existingResults AS $existingResult) {
					if ($existingResult->getStatus()->getIsPassed()) {
						$hasPassed = TRUE;
						break;
					}
				}
			}

			$GLOBALS['TSFE']->clearPageCacheContent_pidList($GLOBALS['TSFE']->id);
			$GLOBALS['TSFE']->clearPageCacheContent_pidList($this->config['redirect_page']);

			if (!$hasPassed) {
				$this->view->assign('showdownload', '1');
			} else {
				$this->view->assign('showdownload', '0');
			}

			$pageId = (int) $this->settings['certificate']['detailPid'];

			if (!$pageId) {
				throw new Exception('No Page found! Please check your configuration.');
			}

			$this->view->assign('page', $pageId);
			$this->view->assign('questionnaire', $questionnaire);
		}
	}

	/**
	 * shows a private statistic for an user
	 *
	 * @return void
	 */
	public function statisticAction() {
			// @TODO: Check toArray
		$results = $this->resultRepository->findByFeuser((int) $GLOBALS['TSFE']->fe_user->user['uid'])->toArray();
		$this->view->assign('results', $results);
		$this->view->assign('page', $this->settings['certificate']['detailPid']);
	}

}

?>