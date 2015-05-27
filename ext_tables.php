<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
	$_EXTKEY,
	'tx_externalimporttest_product'
);

$GLOBALS['TCA']['tx_externalimporttest_product']['columns']['categories']['external']['base'] = array(
	'xpath' => './self::*[@type="current"]/category',
	'mapping' => array(
		'table' => 'sys_category',
		'reference_field' => 'external_key'
	)
);