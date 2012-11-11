<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Questionnairefe',
	'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:pluginname_data'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Questionnairefelink',
	'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:pluginname_link'
);

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Questionnairefestats',
	'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:pluginname_statistic'
);

if (TYPO3_MODE === 'BE') {

	/**
	 * Registers a Backend Module
	 */
	Tx_Extbase_Utility_Extension::registerModule(
		$_EXTKEY,
		'web',	 // Make module a submodule of 'web'
		'questionnaire',	// Submodule key
		'',						// Position
		array(
			'Invite' => 'list, new, newgroup, create, delete','Excel' => 'list, certificate, group, stat, send','Questionnaire' => 'list, show, new, create, edit, update, delete, statistic','Question' => 'list, show, new, create, edit, update, delete','Answer' => 'list, new, create','Result' => 'new, create, edit, update','Status' => 'list, new, create','Depency' => 'list, new, create, edit, update, delete','Certificate' => 'list, new, create','Pdf' => 'create, download',
		),
		array(
			'access' => 'user,group',
			'icon'   => 'EXT:' . $_EXTKEY . '/ext_icon.gif',
			'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_questionnaire.xml',
		)
	);

}

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Easy Questionnaire');

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_question', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_question.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_question');
			$TCA['tx_hsquestionnaire_domain_model_question'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_question',
					'label' => 'title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Question.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_question.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_answer', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_answer.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_answer');
			$TCA['tx_hsquestionnaire_domain_model_answer'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_answer',
					'label' => 'title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Answer.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_answer.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_questionnaire', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_questionnaire.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_questionnaire');
			$TCA['tx_hsquestionnaire_domain_model_questionnaire'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_questionnaire',
					'label' => 'title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Questionnaire.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_questionnaire.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_result', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_result.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_result');
			$TCA['tx_hsquestionnaire_domain_model_result'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_result',
					'label' => 'ip',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Result.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_result.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_status', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_status.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_status');
			$TCA['tx_hsquestionnaire_domain_model_status'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_status',
					'label' => 'is_aborted',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Status.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_status.gif'
				),
			);

$tmp_hs_questionnaire_columns = array(

);

t3lib_extMgm::addTCAcolumns('fe_users',$tmp_hs_questionnaire_columns);

$TCA['fe_users']['columns'][$TCA['fe_users']['ctrl']['type']]['config']['items'][] = array('LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:fe_users.tx_extbase_type.Tx_HsQuestionnaire_Feuser','Tx_HsQuestionnaire_Feuser');

$TCA['fe_users']['types']['Tx_HsQuestionnaire_Feuser']['showitem'] = $TCA['fe_users']['types']['1']['showitem'];
$TCA['fe_users']['types']['Tx_HsQuestionnaire_Feuser']['showitem'] .= ',--div--;LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_feuser,';
$TCA['fe_users']['types']['Tx_HsQuestionnaire_Feuser']['showitem'] .= '';

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_depency', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_depency.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_depency');
			$TCA['tx_hsquestionnaire_domain_model_depency'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_depency',
					'label' => 'question',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Depency.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_depency.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_invite', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_invite.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_invite');
			$TCA['tx_hsquestionnaire_domain_model_invite'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_invite',
					'label' => 'inviteon',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Invite.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_invite.gif'
				),
			);

			t3lib_extMgm::addLLrefForTCAdescr('tx_hsquestionnaire_domain_model_certificate', 'EXT:hs_questionnaire/Resources/Private/Language/locallang_csh_tx_hsquestionnaire_domain_model_certificate.xml');
			t3lib_extMgm::allowTableOnStandardPages('tx_hsquestionnaire_domain_model_certificate');
			$TCA['tx_hsquestionnaire_domain_model_certificate'] = array(
				'ctrl' => array(
					'title'	=> 'LLL:EXT:hs_questionnaire/Resources/Private/Language/locallang_db.xml:tx_hsquestionnaire_domain_model_certificate',
					'label' => 'title',
					'tstamp' => 'tstamp',
					'crdate' => 'crdate',
					'cruser_id' => 'cruser_id',
					'dividers2tabs' => TRUE,
					'versioningWS' => 2,
					'versioning_followPages' => TRUE,
					'origUid' => 't3_origuid',
					'languageField' => 'sys_language_uid',
					'transOrigPointerField' => 'l10n_parent',
					'transOrigDiffSourceField' => 'l10n_diffsource',
					'delete' => 'deleted',
					'enablecolumns' => array(
						'disabled' => 'hidden',
						'starttime' => 'starttime',
						'endtime' => 'endtime',
					),
					'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Certificate.php',
					'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_hsquestionnaire_domain_model_certificate.gif'
				),
			);

	$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
	$pluginSignature = 'hsquestionnaire_questionnairefelink';
	$TCA['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,recursive';

	// Flexform
	$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
	t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:'.$_EXTKEY.'/Configuration/Flexform/flexform.xml');

?>