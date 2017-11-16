<?php
if (!defined ('TYPO3_MODE')) 	{
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::makeCategorizable(
        'externalimport_test',
        'tx_externalimporttest_product'
);

$GLOBALS['TCA']['tx_externalimporttest_product']['columns']['categories']['external']['base'] = [
        'xpath' => './self::*[@type="current"]/category',
        'transformations' => [
                10 => [
                        'mapping' => [
                                'table' => 'sys_category',
                                'referenceField' => 'external_key',
                                'default' => ''
                        ]
                ]
        ]
];