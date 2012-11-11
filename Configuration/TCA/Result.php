<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_hsquestionnaire_domain_model_result'] = array(
	'ctrl' => $TCA['tx_hsquestionnaire_domain_model_result']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, ip, score, finished, status, feuser, questionnaire',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, ip, score, finished, status, feuser, questionnaire,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
	),
	'palettes' => array(
		'1' => array('showitem' => ''),
	),
	'columns' => array(
		'sys_language_uid' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				),
			),
		),
		'l10n_parent' => array(
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config' => array(
				'type' => 'select',
				'items' => array(
					array('', 0),
				),
				'foreign_table' => 'tx_hsquestionnaire_domain_model_result',
				'foreign_table_where' => 'AND tx_hsquestionnaire_domain_model_result.pid=###CURRENT_PID### AND tx_hsquestionnaire_domain_model_result.sys_language_uid IN (-1,0)',
			),
		),
		'l10n_diffsource' => array(
			'config' => array(
				'type' => 'passthrough',
			),
		),
		't3ver_label' => array(
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.versionLabel',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'max' => 255,
			)
		),
		'hidden' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config' => array(
				'type' => 'check',
			),
		),
		'starttime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.starttime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'endtime' => array(
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xml:LGL.endtime',
			'config' => array(
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => array(
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				),
			),
		),
		'ip' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.ip',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'score' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.score',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'finished' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.finished',
			'config' => array(
				'type' => 'input',
				'size' => 10,
				'eval' => 'datetime,required',
				'checkbox' => 1,
				'default' => time()
			),
		),
		'status' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.status',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hsquestionnaire_domain_model_status',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'feuser' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.feuser',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'questionnaire' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.questionnaire',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_hsquestionnaire_domain_model_questionnaire',
				'minitems' => 0,
				'maxitems' => 1,
			),
		),
		'resultdata' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result.resultset',
			'config' => array(
				'type' => 'text',
				'cols' => 40,
				'rows' => 5,
				'eval' => 'required'
			),
		),
	),
);

?>