<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Questionnairefe',
	array(
		'Questionnaire' => 'list, show, new, create, edit, update, delete, statistic',
		'Question' => 'list, show, new, create, edit, update, delete',
		'Answer' => 'list',
		'Result' => 'new, create, edit, update',
		'Status' => 'list, new, create',
		'Depency' => 'list, new, create, edit, update, delete',
		'Invite' => 'new, newgroup, create, delete',
		'Pdf' => 'create, download',
		'Excel' => 'list, certificate, group, stat, send',
	),
	// non-cacheable actions
	array(
		'Questionnaire' => 'create, update, delete, show',
		'Question' => 'create, update, delete',
		'Result' => 'create, update',
		'Status' => 'create',
		'Depency' => 'create, update, delete',
		'Invite' => 'create',
		'Pdf' => 'create, download',
		'Excel' => 'list, certificate, group, stat, send',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Questionnairefelink',
	array(
		'Questionnaire' => 'link',
	),
	// non-cacheable actions
	array(
		'Questionnaire' => 'link',
	)
);

Tx_Extbase_Utility_Extension::configurePlugin(
	$_EXTKEY,
	'Questionnairefestats',
	array(
		'Questionnaire' => 'statistic',
	)
);

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['scheduler']['tasks']['Tx_HsQuestionnaire_Scheduler_QuestionnaireScheduler'] = array(
	'extension' => $_EXTKEY,
	'title' => 'HS Questionnaire Reporting Scheduler',
	'description' => 'Automatic creation of reports.'
);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['extbase']['extensions']['HsQuestionnaire']['modules']['cli']['controllers'] = array(
	'Excel' => array('actions' => array('send'))
);

?>