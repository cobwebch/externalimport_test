<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/**
 * Import of categories for testing import of categorized products.
 */
$newColumn = [
        'external_key' => [
                'label' => 'External key',
                'config' => [
                        'type' => 'input'
                ],
                'external' => [
                        'product_categories' => [
                                'field' => 0
                        ]
                ]
        ]
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_category', $newColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('sys_category', 'external_key');

$GLOBALS['TCA']['sys_category']['ctrl']['external']['product_categories'] = [
        'connector' => 'csv',
        'parameters' => [
                'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Categories.csv',
                'delimiter' => ';',
                'text_qualifier' => '',
                'encoding' => 'utf8'
        ],
        'data' => 'array',
        'referenceUid' => 'external_key',
        'priority' => 5050,
        'description' => 'Product categories'
];
$GLOBALS['TCA']['sys_category']['columns']['title']['external']['product_categories'] = [
        'field' => 1
];
$GLOBALS['TCA']['sys_category']['columns']['parent']['external']['product_categories'] = [
        'field' => 2,
        'transformations' => [
                10 => [
                        'mapping' => [
                                'table' => 'sys_category',
                                'reference_field' => 'external_key'
                        ]
                ]
        ]
];
