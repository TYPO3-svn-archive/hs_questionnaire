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
 * Pdf controller
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_PdfController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * questionnaireRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_QuestionnaireRepository
	 */
	protected $questionnaireRepository;

	/**
	 * feuserRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_FeuserRepository
	 */
	protected $feuserRepository;

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
	 * injectFeuserRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_FeuserRepository $feuserRepository
	 * @return void
	 */
	public function injectFeuserRepository(Tx_HsQuestionnaire_Domain_Repository_FeuserRepository $feuserRepository) {
		$this->feuserRepository = $feuserRepository;
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
	 * @param Tx_HsQuestionnaire_Domain_Model_Result $result
	 * @return void
	 */
	public function createAction(Tx_HsQuestionnaire_Domain_Model_Result $result) {
		$questionnaire = $this->questionnaireRepository->findByUid($result->getQuestionnaire());
		$user = $this->feuserRepository->findByUid($result->getFeuser());
		$certificate = $questionnaire->getCertificate();

		/**
		 * create a new object of type QuestionnairePdf
		 */
		$pdfObject = t3lib_div::makeInstance('Tx_HsQuestionnaire_Pdf_QuestionnairePdf','P', 'mm', 'A4');
		$pdfObject->AddPage();

			// insert the image to pdf
		$file = 'uploads/tx_hsquestionnaire/' . $certificate->getImage();
		if (file_exists($file)) {
			$resolution = $this->settings['certificate']['imageResolution'] * (-1);
			$pdfObject->Image($file, 0, 0, $resolution);
		}

			// add the name and description to pdf
		if ($user->getFirstName() != '' && $user->getLastName() != '') {
			$textToAdd = $user->getFirstName() . ' ' . $user->getLastName();
		}

		$pdfObject->SetFont('Helvetica', 'B', 26);
		$pdfObject->Text($certificate->getPostNameX(), $certificate->getPostNameY(), utf8_decode($textToAdd));

		date_default_timezone_set('Europe/Berlin');

		$thisDate = strftime('%d.%m.%G', time());
		$pdfObject->SetFont('Helvetica', 'B', 18);
		$textToAdd = $certificate->getCity() . ', ' . $thisDate;
		$pdfObject->Text($certificate->getPostCityX(), $certificate->getPostCityY(), utf8_decode($textToAdd));

		/**
		 * creat the pdf file using the current certificate name and the id of the current fe_user
		 */
		$docname = str_replace(' ', '_', strtolower($questionnaire->getTitle()));
		$docname = str_replace('\'', '', $docname);

		if ($user->getFirstName() != '' && $user->getLastName() != '') {
			$docname .= '_' . $user->getUid() . '_' . $user->getFirstName() . '_' . $user->getLastName() . '.pdf';
		}

		$filename = $this->settings['certificate']['tempFolder'] . $docname;
		$pdfObject->Output($filename, 'F');

		$msgText = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_pdf.message', $this->extensionName);
		$msgText = str_replace('{certFristName}', utf8_decode($user->getFirstName()), $msgText);
		$msgText = str_replace('{certLastName}', utf8_decode($user->getLastName()), $msgText);
		$msgText = str_replace('{certTitle}', $certificate->getTitle(), $msgText);

		$mailObj = t3lib_div::makeInstance(
			'Tx_HsQuestionnaire_Export_Email',
			$user->getEmail(),
			$this->settings['certificate']['email']['from'],
			Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_pdf.subject', $this->extensionName),
			$msgText,
			$docname,
			$filename
		);
		$mailObj->send();

		unlink($filename);

		$this->redirect('list', 'Questionnaire', $this->extensionName, array('passedShowDownload' => FALSE, 'result' => $result));
	}

	/**
	 * Creates a new pdf for current questionnaire for download
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Result $result
	 * @return void
	 */
	public function downloadAction(Tx_HsQuestionnaire_Domain_Model_Result $result) {
		$user = $this->feuserRepository->findByUid($result->getFeuser());
		$questionnaire = $this->questionnaireRepository->findByUid($result->getQuestionnaire());
		$certificate = $questionnaire->getCertificate();

		/**
		 * create a new object of type QuestionnairePdf
		 */
		$pdfObject = t3lib_div::makeInstance('Tx_HsQuestionnaire_Pdf_QuestionnairePdf','P', 'mm', 'A4');
		$pdfObject->AddPage();

			// insert the image to pdf
		$file = 'uploads/tx_hsquestionnaire/' . $certificate->getImage();
		if (file_exists($file)) {
			$resolution = $this->settings['certificate']['imageResolution'] * (-1);
			$pdfObject->Image($file, 0, 0, $resolution);
		}

			// add the name and description to pdf
		if ($user->getFirstName() != '' && $user->getLastName() != '') {
			$textToAdd = $user->getFirstName() . ' ' . $user->getLastName();
		}

		$pdfObject->SetFont('Helvetica', 'B', 26);
		$pdfObject->Text($certificate->getPostNameX(), $certificate->getPostNameY(), utf8_decode($textToAdd));

		date_default_timezone_set('Europe/Berlin');

		$thisDate = strftime('%d.%m.%G', time());
		$pdfObject->SetFont('Helvetica', 'B', 18);
		$textToAdd = $certificate->getCity() . ', ' . $thisDate;
		$pdfObject->Text($certificate->getPostCityX(), $certificate->getPostCityY(), utf8_decode($textToAdd));

		/**
		 * create the pdf file using the current certificate name and the id of the current fe_user
		 */
		$docname = str_replace(' ', '_', strtolower($questionnaire->getTitle()));
		$docname = str_replace('\'', '', $docname);
		if ($user->getFirstName() != '' && $user->getLastName() != '') {
			$docname .= '_' . $user->getUid() . '_' . $user->getFirstName() . '_' . $user->getLastName() . '.pdf';
		}

		$filename = $this->settings['certificate']['tempFolder'] . $docname;
		header('Content-type: application/pdf');
		$pdfObject->Output($docname, 'D');
		exit();
	}

}

?>