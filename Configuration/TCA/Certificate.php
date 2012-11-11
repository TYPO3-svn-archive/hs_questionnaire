<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_hsquestionnaire_domain_model_certificate'] = array(
	'ctrl' => $TCA['tx_hsquestionnaire_domain_model_certificate']['ctrl'],
	'interface' => array(
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, city, image, post_name_x, post_name_y, post_city_x, post_city_y',
	),
	'types' => array(
		'1' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, city, image, post_name_x, post_name_y, post_city_x, post_city_y,--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access,starttime, endtime'),
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
				'foreign_table' => 'tx_hsquestionnaire_domain_model_certificate',
				'foreign_table_where' => 'AND tx_hsquestionnaire_domain_model_certificate.pid=###CURRENT_PID### AND tx_hsquestionnaire_domain_model_certificate.sys_language_uid IN (-1,0)',
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
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.title',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'city' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.city',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			),
		),
		'image' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.image',
			'config' => array(
				'type' => 'group',
				'internal_type' => 'file',
				'uploadfolder' => 'uploads/tx_hsquestionnaire',
				'show_thumbs' => 1,
				'size' => 5,
				'allowed' => 'jpg',
				'disallowed' => '',
				'minItems' => '1',
				'maxItems' => '1',
			),
		),
		'post_name_x' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.post_name_x',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'post_name_y' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.post_name_y',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'post_city_x' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.post_city_x',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
		'post_city_y' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate.post_city_y',
			'config' => array(
				'type' => 'input',
				'size' => 4,
				'eval' => 'int,required'
			),
		),
	),
);

?>