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
 * ExcelController
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_ExcelController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * questionnaireRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_QuestionnaireRepository
	 */
	protected $questionnaireRepository;

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
	 * resultRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_ResultRepository
	 */
	protected $resultRepository;

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
	 * feuserRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_FeuserRepository
	 */
	protected $feuserRepository;

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
	 * fegroupRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_FegroupRepository
	 */
	protected $fegroupRepository;

	/**
	 * injectFegroupRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_FegroupRepository $fegroupRepository
	 * @return void
	 */
	public function injectFegroupRepository(Tx_HsQuestionnaire_Domain_Repository_FegroupRepository $fegroupRepository) {
		$this->fegroupRepository = $fegroupRepository;
	}

	/**
	 * Dummy function for listAction
	 *
	 * @return void
	 */
	public function listAction() {

	}

	/**
	 * executes the creationg actions for all reportings
	 *
	 * @return void
	 */
	public function sendAction() {
		$this->certificateAction(TRUE);
		$this->groupAction(TRUE);
		$this->statAction(TRUE);
	}

	/**
	 * action certificate reporting
	 *
	 * @param bool $auto
	 * @return void
	 */
	public function certificateAction($auto = FASLE) {
		$excelObj = t3lib_div::makeInstance('Tx_HsQuestionnaire_Excel_QuestionnaireExcel');
			// @TODO: Move to Translationfile
		$excelObj->getProperties()->setCreator('HS Questionnaire Reporting Module')
			->setLastModifiedBy('HS Questionnaire Reporting Module')
			->setTitle('Reporting by Certificates')
			->setSubject('')
			->setDescription('Reporting Certificates created by HS Questionnaire Reporting Module')
			->setKeywords('')
			->setCategory('');

		$excelObj = $this->createQuestionnaireStat($excelObj);
		$docname = strtolower('certificates_' . date('FY', time()) . '.xlsx');
		$filename = $this->settings['reporting']['tempFolder'] . $docname;

		$objWriter = $excelObj->createXlsxWriter();
		$objWriter->save($filename);

		$mailer = t3lib_div::makeInstance(
			'Tx_HsQuestionnaire_Export_Email',
			$this->settings['reporting']['email']['to'],
			$this->settings['reporting']['email']['from'],
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectCertificates', $this->extensionName),
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.message', $this->extensionName),
			$docname,
			$filename
		);
		$mailer->send();
		unlink($filename);

		if (!$auto) {
			$this->redirect('list');
		}
	}

	/**
	 * action group reporting
	 *
	 * @param bool $auto
	 * @return void
	 */
	public function groupAction($auto = FASLE) {
		$excelObj = t3lib_div::makeInstance('Tx_HsQuestionnaire_Excel_QuestionnaireExcel');
		$excelObj->getProperties()->setCreator('HS Questionnaire Reporting Module')
			->setLastModifiedBy('HS Questionnaire Reporting Module')
			->setTitle('Reporting by Groups')
			->setSubject('')
			->setDescription('Reporting Groups created by HS Questionnaire Reporting Module')
			->setKeywords('')
			->setCategory('');

		$excelObj = $this->createGroupStat($excelObj);
		$docname = strtolower('groups_' . date('FY', time()) . '.xlsx');
		$filename = $this->settings['reporting']['tempFolder'] . $docname;

		$objWriter = $excelObj->createXlsxWriter();
		$objWriter->save($filename);

		$mailer = t3lib_div::makeInstance(
			'Tx_HsQuestionnaire_Export_Email',
			$this->settings['reporting']['email']['to'],
			$this->settings['reporting']['email']['from'],
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectGroups', $this->extensionName),
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.message', $this->extensionName),
			$docname,
			$filename
		);
		$mailer->send();
		unlink($filename);

		if (!$auto) {
			$this->redirect('list');
		}
	}

	/**
	 * stat action
	 *
	 * @param bool $auto
	 * @return void
	 */
	public function statAction($auto = FASLE) {
		$excelObj = t3lib_div::makeInstance('Tx_HsQuestionnaire_Excel_QuestionnaireExcel');
		$excelObj->getProperties()->setCreator('HS Questionnaire Reporting Module')
			->setLastModifiedBy('HS Questionnaire Reporting Module')
			->setTitle('Reporting by Statistic')
			->setSubject('')
			->setDescription('Reporting Statistic created by HS Questionnaire Reporting Module')
			->setKeywords('')
			->setCategory('');

		$excelObj = $this->createStats($excelObj);
		$docname = strtolower('statistic_' . date('FY', time()) . '.xlsx');
		$filename = $this->settings['reporting']['tempFolder'] . $docname;

		$objWriter = $excelObj->createXlsxWriter();
		$objWriter->save($filename);

		$mailer = t3lib_div::makeInstance(
			'Tx_HsQuestionnaire_Export_Email',
			$this->settings['reporting']['email']['to'],
			$this->settings['reporting']['email']['from'],
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectStats', $this->extensionName),
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.message', $this->extensionName),
			$docname,
			$filename
		);
		$mailer->send();
		unlink($filename);

		if (!$auto) {
			$this->redirect('list');
		}
	}

	/**
	 * creates the certificate report
	 *
	 * @param Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj
	 * @return Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj
	 */
	private function createQuestionnaireStat(Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj) {
		/**
		 * Set the headline
		 */
		$excelObj->getActiveSheet()->setCellValue('A1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.certificate', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('B1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.lastname', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('C1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.firstname', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('D1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.company', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('E1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.group', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('F1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.status', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('G1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.givendate', $this->extensionName));
		$counter = 2;

		/**
		 * get all questionnaires and find the results of them
		 */
		$questionnaires = $this->questionnaireRepository->findAll();
		foreach ($questionnaires as $questionnaire) {
			$results = $this->resultRepository->findByQuestionnaire($questionnaire->getUid());

			/**
			 * if we have no certificate for the questionnaire, an error will accur
			 */
			$certificateTitle = $questionnaire->getCertificate()->getTitle();

			/**
			 * walking throught every found result,
			 * get the user and it's usergroup
			 *
			 * create a line and with the data
			 */
			foreach ($results as $result) {
				$feuser = $this->feuserRepository->findByUid($result->getFeuser());
				$fegroup = $this->fegroupRepository->findByUid($feuser->getUsergroup());

					// test for first and last name
				if ($feuser->getFirstName() != '' && $feuser->getLastName() != '') {
					$fristName = $feuser->getFirstName();
					$lastName = $feuser->getLastName();
				}

				$cc = 'A' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $certificateTitle);
				$cc = 'B' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $lastName);
				$cc = 'C' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $fristName);
				$cc = 'D' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $feuser->getCompany());
				$cc = 'E' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $fegroup->getTitle());

				/**
				 * check status, if it's passed, failed or abborded
				 */
				$status = $this->getStatus($result->getStatus());

				/**
				 * add status and finished date
				 */
				$cc = 'F' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $status);
				$cc = 'G' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, PHPExcel_Shared_Date::PHPToExcel($result->getFinished()));
				$excelObj->getActiveSheet()->getStyle($cc)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DMYSLASH);

				/**
				 * update counter twice, after current result and current questionnaire
				 */
				$counter++;
			}
			$counter++;
		}

		/**
		 * set the active page title and put a flash message
		 */
		$excelObj->getActiveSheet()->setTitle(utf8_decode(Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectCertificates', $this->extensionName)));
		$excelObj->setActiveSheetIndex(0);
		$this->flashMessageContainer->add($counter . ' rows has been written.', '', t3lib_Flashmessage::OK);

		return $excelObj;
	}

	/**
	 * creates the group report
	 *
	 * @param Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj
	 * @return Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj
	 */
	private function createGroupStat(Tx_HsQuestionnaire_Excel_QuestionnaireExcel $excelObj) {
		/**
		 * Set the headline
		 */
		$excelObj->getActiveSheet()->setCellValue('E1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.group', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('B1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.lastname', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('C1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.firstname', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('D1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.company', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('A1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.certificate', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('F1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.status', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('G1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.givendate', $this->extensionName));

		$counter = 2;

		$groups = $this->fegroupRepository->findAll();
		foreach ($groups as $fegroup) {
			$hasresult = FASLE;
			$users = $this->feuserRepository->findByUsergroup($fegroup->getUid());

			foreach ($users as $feuser) {
				$results = $this->resultRepository->findByFeuser($feuser->getUid());

				foreach ($results as $result) {
					$questionnaire = $this->questionnaireRepository->findByUid($result->getQuestionnaire());
					$certificateTitle = $questionnaire->getCertificate()->getTitle();

						// test for first and last name
					if ($feuser->getFirstName() != '' && $feuser->getLastName() != '') {
						$fristName = $feuser->getFirstName();
						$lastName = $feuser->getLastName();
					}

					$cc = 'A' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $fegroup->getTitle());
					$cc = 'B' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $lastName);
					$cc = 'C' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $fristName);
					$cc = 'D' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $feuser->getCompany());
					$cc = 'E' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $certificateTitle);

					/**
					 * check status, if it's passed, failed or abborded
					 */
					$status = $this->getStatus($result->getStatus());

					/**
					 * add status and finished date
					 */
					$cc = 'F' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, $status);
					$cc = 'G' . $counter;
					$excelObj->getActiveSheet()->setCellValue($cc, PHPExcel_Shared_Date::PHPToExcel($result->getFinished()));
					$excelObj->getActiveSheet()->getStyle($cc)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DMYSLASH);

					/**
					 * update counter twice, after current result and current questionnaire
					 */
					$counter++;

					$hasresult = TRUE;
				}
			}
			if ($hasresult) {
				$counter++;
			}
		}

		/**
		 * set the active page title and put a flash message
		 */
		$excelObj->getActiveSheet()->setTitle(utf8_decode(Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectGroups', $this->extensionName)));
		$excelObj->setActiveSheetIndex(0);
		$this->flashMessageContainer->add($counter . ' rows has been written.', '', t3lib_Flashmessage::OK);

		return $excelObj;
	}

	/**
	 * create stats
	 *
	 * @param  mixed $excelObj
	 * @return mixed
	 */
	private function createStats($excelObj) {
		/**
		 * Set the headline
		 */
		$excelObj->getActiveSheet()->setCellValue('A1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.statsgroup', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('B1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.statsmembers', $this->extensionName));
		$excelObj->getActiveSheet()->setCellValue('C1', Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.statsparticipants', $this->extensionName));

		$excludedGroups = t3lib_div::trimExplode(',', $this->settings['reporting']['excludedGroups']);
		$counter = 2;

		$groups = $this->fegroupRepository->findAll();
		foreach ($groups as $fegroup) {
			$participantCounter = 0;
			if (!in_array($fegroup->getUid(), $excludedGroups)) {
				$users = $this->feuserRepository->findByUsergroup($fegroup->getUid());

				$userCount = $users->count();
				foreach ($users as $user) {
					$participantCount = $this->resultRepository->findByFeuser($user->getUid())->count();
					if ($participantCount > 0) {
						$participantCounter++;
					}
				}

				$cc = 'A' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $fegroup->getTitle());
				$cc = 'B' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $userCount);
				$cc = 'C' . $counter;
				$excelObj->getActiveSheet()->setCellValue($cc, $participantCounter);
				$counter++;
			}
		}

		/**
		 * set the active page title and put a flash message
		 */
		$excelObj->getActiveSheet()->setTitle(utf8_decode(Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_excel.subjectStats', $this->extensionName)));
		$excelObj->setActiveSheetIndex(0);
		$this->flashMessageContainer->add($counter . ' rows has been written.', '', t3lib_Flashmessage::OK);
		return $excelObj;
	}

	/**
	 * get status
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Status $statusObj
	 * @return string
	 */
	private function getStatus(Tx_HsQuestionnaire_Domain_Model_Status $statusObj) {
		if ($statusObj->getIsPassed() == 1) {
			$status = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_certificate.passed', $this->extensionName);
		} elseif ($statusObj->isIsFailed() == 1) {
			$status = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_certificate.failed', $this->extensionName);
		} else {
			$status = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_certificate.abort', $this->extensionName);
		}
		return $status;
	}

}

?>