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
 * Result controller
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_ResultController extends Tx_Extbase_MVC_Controller_ActionController {

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
	 * action create
	 *
	 * @return void
	 */
	public function createAction() {

		$valid = TRUE;
			// get arguments of the request
		$temp = $this->request->getArguments();
			// select anwers ids given by the answer form
		$resArray = $temp['result'];

			// put the answer ids into a linear array widthout arrays in an array
		$newResArray = array();
		foreach ($resArray as $tmp) {
			if (is_array($tmp)) {
				foreach ($tmp as $innerTmp) {
					array_push($newResArray, $innerTmp);
				}
			} else {
				array_push($newResArray, $tmp);
			}
		}

			// get the questions of the current questionnaire
		$questionnaire = $this->questionnaireRepository->findByUid($temp['qid']);

		/**
		 *
		 * Testing of the data input
		 *
		 * check if every question has at least one answer given
		 *
		 */
		$emptyQuestions = array();

		foreach ($questionnaire->getQuestions() as $tmp) {
			if (!isset($resArray[$tmp->getUid()]) || empty($resArray[$tmp->getUid()])) {
				if ($tmp->getIsRequired() == 1) {
					array_push($emptyQuestions, $tmp->getUid());
					$valid = FALSE;
				}
			}
		}
		if (!$valid) {
			$this->redirect('show', 'Questionnaire', NULL, array('questionnaire' => $questionnaire, 'result' => $resArray, 'emptyquestions' => $emptyQuestions));
		}
		unset($valid);

		/*
		 * Create the result set
		 *
		 * run throught all questions and answers
		 * check if answer in given result set and
		 * check is answer is correct answer
		 * calculate the score of the user
		 *
		 * maximum score of a questionnaire
		 */
		$userScore = 0;
		$questionnaireMaxPoints = 0;
		$percentToPass = 0.9;

		foreach ($questionnaire->getQuestions() as $question) {
			if ($question->getIsRequired() == 1) {
				/*
				 * calculate the score of a questionnaire
				 * get the max count of answer to be given
				 */
				$maxAnswers = $question->getMaxAnswerCount();
				$pointsPerQuestion = $question->getPoints();
				$pointsPerAnswer = $pointsPerQuestion / $maxAnswers;
				$questionnaireMaxPoints += $pointsPerQuestion;

					// if getIsPassedRequired() is TRUE, an array for all correct answers is needed
				if ($question->getIsPassedRequired()) {
					$correctAnswerArray = array();
				}

					// walking throught all answers
				foreach ($question->getAnswers() as $answer) {
					/*
					 * if getIsPassedRequired() is TRUE and the answer is correct, add anwers to correctAnswerArray
					 * else add points of the answer to user score
					 */
					if ($question->getIsPassedRequired() && $answer->isCorrectAnswer()) {
						array_push($correctAnswerArray, $answer->getUid());
					} else {
						if (in_array($answer->getUid(), $newResArray) && $answer->isCorrectAnswer()) {
							$userScore += $pointsPerAnswer;
						}
					}
				}

				/*
				 * if correctAnswerArray is set, then getIsPassedRequired() is TRUE
				 * we need to check if an number of correct answer is the numer of given answers
				 *
				 */
				if ($question->getIsPassedRequired() == 1) {
					foreach ($correctAnswerArray as $correctAnswer) {
						if (in_array($correctAnswer, $newResArray)) {
							$answerCounter++;
						}
					}

					if ($answerCounter == $question->$maxAnswers) {
						$userScore += $pointsPerQuestion;
					}
					unset($correctAnswerArray);
				}
			}
		}

			// calculate the percentage of the user score
		$scoreInPercent = $userScore / $questionnaireMaxPoints;

		/**
		 * if user has more than or equal 90% correct answers, questionnaire was passen
		 * if lower than, user has failed
		 * else he maybe has aborted
		 */
		$newResultStatus = t3lib_div::makeInstance('Tx_HsQuestionnaire_Domain_Model_Status');
		$newResult = t3lib_div::makeInstance('Tx_HsQuestionnaire_Domain_Model_Result');
		$newResult->setIp($_SERVER['REMOTE_ADDR']);
		if ($GLOBALS['TSFE']->loginUser) {
			$newResult->setFeuser($GLOBALS['TSFE']->fe_user->user['uid']);
		}
		$newResult->setQuestionnaire($questionnaire);
		$newResult->setScore($userScore);
		$newResult->setResultData($resArray);

			// check if passed
		if ($scoreInPercent >= $percentToPass) {
			$newResultStatus->setIsPassed(1);
			$newResultStatus->setIsFailed(0);
			$newResultStatus->setIsAborted(0);

			$newResult->setFinished(time());
			$passed = TRUE;
		} else {
			$passed = FALSE;
				// check if failed
			if ($scoreInPercent < $percentToPass) {
				$newResultStatus->setIsPassed(0);
				$newResultStatus->setIsFailed(1);
				$newResultStatus->setIsAborted(0);

				$newResult->setFinished(time());
			} else {
					// anything else
				$newResultStatus->setIsPassed(0);
				$newResultStatus->setIsFailed(0);
				$newResultStatus->setIsAborted(1);

				$newResult->setFinished(time());
			}
		}

			// add result including status to repository
		$newResult->setStatus($newResultStatus);
		$this->resultRepository->add($newResult);

		$persistenceManager = t3lib_div::makeInstance('Tx_Extbase_Persistence_Manager');
		$persistenceManager->persistAll();

		if ($passed) {
			/**
			 * if questionnaire was passed, throw a new message and
			 * prepare data to be send as pdf via email
			 * @param float $userscore
			 */
			$passedMsg = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_certificate.created', $this->extensionName);
			$passedMsg = str_replace('{userpercent}', ($scoreInPercent * 100), $passedMsg);
			$passedMsg = str_replace('{userscore}', $userScore, $passedMsg);

			$this->flashMessageContainer->add($passedMsg, '', t3lib_Flashmessage::OK);
			$this->forward('create', 'Pdf', $this->extensionName, array('result' => $newResult));
		} else {
				// if questionnaire is failed, then move to failed action of result controller
			$this->forward('failed', 'Result', $this->extensionName, array('questionnaire' => $questionnaire->getUid(), 'userScore' => (float) $userScore, 'maxScore' => $questionnaireMaxPoints));
		}
	}

	/**
	 * action update
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Result $result
	 * @return void
	 */
	public function updateAction(Tx_HsQuestionnaire_Domain_Model_Result $result) {
		$this->resultRepository->update($result);
		$this->flashMessageContainer->add('Your Result was updated.');
		$this->redirect('list');
	}

	/**
	 * shows a message if questionnaire was failed
	 *
	 * @param int $questionnaire
	 * @param float $userScore
	 * @param int $maxScore
	 *
	 * @return void
	 */
	public function failedAction($questionnaire, $userScore, $maxScore) {
		$value = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_result.failed', $this->extensionName);
		$userpercent = $userScore / $maxScore;

		$value = str_replace('{userscore}', $userscore, $value);
		$value = str_replace('{userpercent}', ($userpercent * 100), $value);
		$value = str_replace('{maxscore}', $maxscore, $value);

		$this->view->assign('text', $value);
		$questionnaire = $this->questionnaireRepository->findByUid($questionnaire);
		$this->view->assign('questionnaire', $questionnaire);
	}

}

?>