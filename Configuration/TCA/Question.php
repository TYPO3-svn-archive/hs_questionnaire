<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_hsquestionnaire_domain_model_question'] = array(
	'ctrl' => $TCA['tx_hsquestionnaire_domain_model_question']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, type, title, question_text, points, max_answer_count, images, is_random_order, is_required, is_passed_required, show_if_dependencies, dependon, answers',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, type, title, question_text, points, max_answer_count, images, is_random_order, is_required, is_passed_required, show_if_dependencies, dependon, answers,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_hsquestionnaire_domain_model_question',
				'foreign_table_where' => 'AND tx_hsquestionnaire_domain_model_question.pid=###CURRENT_PID### AND tx_hsquestionnaire_domain_model_question.sys_language_uid IN (-1,0)',
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
		'title' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'question_text' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.question_text',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'points' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.points',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'default' => 10,
				'eval' => 'int,required'
			),
		),
		'max_answer_count' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.max_answer_count',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'default' => 1,
				'eval' => 'int'
			),
		),
		'images' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.images',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_hsquestionnaire',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext'],
				'disallowed' => '',
			),
		),
		'is_random_order' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.is_random_order',
			'config' => array(
				'type' => 'check',
				'default' => 1
			),
		),
		'is_required' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.is_required',
			'config' => array(
				'type' => 'check',
				'default' => 1
			),
		),
		'is_passed_required' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.is_passed_required',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'show_if_dependencies' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.show_if_dependencies',
			'config' => array(
				'type' => 'check',
				'default' => 0
			),
		),
		'type' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.type',
			'config' => array(
				'type' => 'select',
				'size' => 1,
				'eval' => 'int',
				'items' => array(
					array('LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.single', '1'),
					array('LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.multiple', '2'),
					array('LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.open', '3'),
				),
			),
		),
		'dependon' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.dependon',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hsquestionnaire_domain_model_depency',
				'minitems' => 0,
				'maxitems' => 1,
				'appearance' => array(
					'collapse' => 0,
					'levelLinksPosition' => 'top',
					'showSynchronizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showAllLocalizationLink' => 1
				),
			),
		),
		'answers' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question.answers',
			'config' => array(
				'type' => 'inline',
				'foreign_table' => 'tx_hsquestionnaire_domain_model_answer',
				'MM' => 'tx_hsquestionnaire_question_answer_mm',
				'size' => 10,
				'autoSizeMax' => 30,
				'maxitems' => 9999,
				'multiple' => 0,
				'wizards' => array(
					'_PADDING' => 1,
					'_VERTICAL' => 1,
					'edit' => array(
						'type' => 'popup',
						'title' => 'Edit',
						'script' => 'wizard_edit.php',
						'icon' => 'edit2.gif',
						'popup_onlyOpenIfSelected' => 1,
						'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
						),
					'add' => Array(
						'type' => 'script',
						'title' => 'Create new',
						'icon' => 'add.gif',
						'params' => array(
							'table' => 'tx_hsquestionnaire_domain_model_answer',
							'pid' => '###CURRENT_PID###',
							'setValue' => 'prepend'
							),
						'script' => 'wizard_add.php',
					),
				),
			),
		),
	),
);

?>