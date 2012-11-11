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
 * invite controllert
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html
 * GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Controller_InviteController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * inviteRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_InviteRepository
	 */
	protected $inviteRepository;

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
	 * fegroupRepository
	 *
	 * @var Tx_HsQuestionnaire_Domain_Repository_FegroupRepository
	 */
	protected $fegroupRepository;

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
	 * injectFegroupRepository
	 *
	 * @param Tx_HsQuestionnaire_Domain_Repository_FegroupRepository $fegroupRepository
	 * @return void
	 */
	public function injectFegroupRepository(Tx_HsQuestionnaire_Domain_Repository_FegroupRepository $fegroupRepository) {
		$this->fegroupRepository = $fegroupRepository;
	}

	/**
	 * Lists all invitations
	 *
	 * @return void
	 */
	public function listAction() {
		$invites = $this->inviteRepository->findAll();
		$this->view->assign('invites', $invites);
	}

	/**
	 * action new
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Invite $newInvite
	 * @dontvalidate $newInvite
	 * @return void
	 */
	public function newAction(Tx_HsQuestionnaire_Domain_Model_Invite $newInvite = NULL) {
		$this->view->assign('questionnaires', $this->questionnaireRepository->findAll());
		$this->view->assign('feusers', $this->feuserRepository->findAll());

		$invitecode = time() + rand(1, 99999);
		$this->view->assign('invitecode', $invitecode);

		$this->view->assign('newInvite', $newInvite);
	}

	/**
	 * action new group
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Invite $newInvite
	 * @dontvalidate $newInvite
	 * @return void
	 */
	public function newgroupAction(Tx_HsQuestionnaire_Domain_Model_Invite $newInvite = NULL) {
		$this->view->assign('questionnaires', $this->questionnaireRepository->findAll());
		$this->view->assign('fegroups', $this->fegroupRepository->findAll());

		$invitecode = time() + rand(1, 99999);
		$this->view->assign('invitecode', $invitecode);

		$this->view->assign('inviteon', date('d.m.Y', time()));

		$this->view->assign('newInvite', $newInvite);
	}

	/**
	 * action create
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Invitev $newInvite
	 * @return void
	 */
	public function createAction(Tx_HsQuestionnaire_Domain_Model_Invite $newInvite) {
		$questionnaire = $this->questionnaireRepository->findByUid($newInvite->getQuestionnaire());
		$certificate = $questionnaire->getCertificate()->getTitle();

		$subject = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_invite.subject', $this->extensionName);
		$subject .= ' ' . $certificate;

		$message = Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_invite.invitemail', $this->extensionName);
		$message .= ' ' . $certificate . '. ';
		$message .= Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_invite.invitecode', $this->extensionName) . ': ';
		$message .= $newInvite->getinvitecode();

		if ($newInvite->getFeuser() != 0 && $newInvite->getFegroup() == 0) {
			$this->inviteRepository->add($newInvite);

			$user = $this->feuserRepository->findByUid($newInvite->getFeuser());
			$email = t3lib_div::makeInstance(
				'Tx_HsQuestionnaire_Export_Email',
				$user->getEmail(),
				$this->settings['invite']['email']['from'],
				$subject,
				utf8_decode($message)
			);
			$email->send();
		} else {
			$users = $this->feuserRepository->findByUsergroup($newInvite->getFegroup());
			foreach ($users as $user) {
				if (isset($oldInvite)) {
					$newInvite->setFegroup($oldInvite->getFegroup());
					$newInvite->setInviteon($oldInvite->getInviteon());
					$newInvite->setQuestionnaire($oldInvite->getQuestionnaire());
					$newInvite->setinvitecode($oldInvite->getinvitecode());
				}

				$newInvite->setFeuser($user);
				$this->inviteRepository->add($newInvite);

				$email = t3lib_div::makeInstance(
					'Tx_HsQuestionnaire_Export_Email',
					$user->getEmail(),
					$this->settings['invite']['email']['from'],
					$subject,
					utf8_decode($message)
					);

				$email->send();

				$oldInvite = $newInvite;
				$newInvite = t3lib_div::makeInstance('Tx_HsQuestionnaire_Domain_Model_Invite');
			}
		}
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_invite.created', $this->extensionName), '', t3lib_Flashmessage::OK);
		$this->redirect('list');
	}

	/**
	 * delete action
	 *
	 * @param Tx_HsQuestionnaire_Domain_Model_Invite $invite
	 * @return void
	 */
	public function deleteAction(Tx_HsQuestionnaire_Domain_Model_Invite $invite) {
		$this->inviteRepository->remove($invite);
		$this->flashMessageContainer->add(Tx_Extbase_Utility_Localization::translate('tx_hsquestionnaire_domain_model_invite.deleted', $this->extensionName), '', t3lib_Flashmessage::OK);
		$this->redirect('list');
	}

}

?>