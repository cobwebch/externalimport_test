<?php

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

// Import of categories
$GLOBALS['TCA']['sys_category']['external']['general']['product_categories'] = [
        'connector' => 'csv',
        'parameters' => [
                'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Categories.csv',
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
                                'referenceField' => 'external_key'
                        ]
                ]
        ]
];

// Erroneous configuration for testing column configuration validator
$GLOBALS['TCA']['sys_category']['external']['general']['column_configuration_errors'] = $GLOBALS['TCA']['sys_category']['external']['general']['product_categories'];
$GLOBALS['TCA']['sys_category']['external']['general']['column_configuration_errors']['description'] = 'Configuration with errors for testing the column configuration validator';
$GLOBALS['TCA']['sys_category']['columns']['title']['external']['column_configuration_errors'] = [];
$GLOBALS['TCA']['sys_category']['columns']['parent']['external']['column_configuration_errors'] = [
        'field' => 2,
        'transformations' => [
                10 => [
                        'value' => 42
                ]
        ]
];
$GLOBALS['TCA']['sys_category']['columns']['hidden']['external']['column_configuration_errors'] = [
        'field' => 3,
        'children' => [
                'columns' => [
                        'foo' => [
                                'map' => 4
                        ]
                ],
                'controlColumnsForUpdate' => 'bar'
        ]
];
