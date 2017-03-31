<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/**
 * Import of categories for testing import of categorized products.
 */
$newColumn = array(
	'external_key' => array(
		'label' => 'External key',
		'config' => array(
			'type' => 'input'
		),
		'external' => array(
			'product_categories' => array(
				'field' => 0
			)
		)
	)
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $newColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'external_key');

$GLOBALS['TCA']['sys_category']['ctrl']['external']['product_categories'] = array(
	'connector' => 'csv',
	'parameters' => array(
		'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Categories.csv',
		'delimiter' => ';',
		'text_qualifier' => '',
		'encoding' => 'utf8'
	),
	'data' => 'array',
	'referenceUid' => 'external_key',
	'priority' => 5050,
	'description' => 'Product categories'
);
$GLOBALS['TCA']['sys_category']['columns']['title']['external']['product_categories'] = array(
	'field' => 1
);
$GLOBALS['TCA']['sys_category']['columns']['parent']['external']['product_categories'] = array(
	'field' => 2,
    'mapping' => array(
            'table' => 'sys_category',
            'reference_field' => 'external_key'
    )
);
