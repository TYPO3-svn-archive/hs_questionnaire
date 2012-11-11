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
 * Questionnaire scheduler
 *
 * @package hs_questionnaire
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_HsQuestionnaire_Scheduler_QuestionnaireScheduler extends tx_scheduler_Task {

	public function execute() {
		$configuration = array(
			'pluginName' => 'cli',
			'extensionName' => 'HsQuestionnaire',
			'controller' => 'Excel',
			'action' => 'send',
			'switchableControllerActions' => array(
				'Excel' => array(
					'actions' => 'send',
				),
			),
			'settings' => ' =< plugin.hs_questionnaire.settings',
			'persistence' => ' =< plugin.hs_questionnaire.persistence',
			'view' => '< plugin.hs_questionnaire.view',
			'_LOCAL_LANG' => '< plugin.hs_questionnaire._LOCAL_LANG'
		);
		$_SERVER['REQUEST_METHOD'] = 'GET';

		/** @var Tx_Extbase_Core_Bootstrap $bootstrap  */
		$bootstrap = t3lib_div::makeInstance('Tx_Extbase_Core_Bootstrap');
		$output = $bootstrap->run('', $configuration);

		return TRUE;
	}
}

?>