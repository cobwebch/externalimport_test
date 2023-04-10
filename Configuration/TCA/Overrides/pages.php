<?php

/**
 * Import of product into pages is used to test the creation of pages,
 * in particular the reverse order that must be applied.
 *
 * For deleting already imported pages: DELETE FROM pages WHERE product_sku > ''
 */

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

$newColumn = [
    'product_sku' => [
        'label' => 'Product SKU',
        'config' => [
            'type' => 'input'
        ],
        'external' => [
            'product_pages' => [
                'field' => 'sku'
            ]
        ]
    ]
];
ExtensionManagementUtility::addTCAcolumns('pages', $newColumn);
ExtensionManagementUtility::addToAllTCAtypes('pages', 'product_sku');

$GLOBALS['TCA']['pages']['external']['general']['product_pages'] = [
    'connector' => 'csv',
    'parameters' => [
        'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/ProductPages.csv',
        'delimiter' => ';',
        'text_qualifier' => '',
        'encoding' => 'utf8',
        'skip_rows' => 1
    ],
    'data' => 'array',
    'referenceUid' => 'product_sku',
    'priority' => 5800,
    'description' => 'Product pages',
    'clearCache' => 'pages'
];
$GLOBALS['TCA']['pages']['columns']['title']['external']['product_pages'] = [
    'field' => 'name'
];
$GLOBALS['TCA']['pages']['columns']['pid']['external']['product_pages'] = [
    'field' => 'parent_sku',
    'transformations' => [
        10 => [
            'mapping' => [
                'table' => 'pages',
                'referenceField' => 'product_sku'
            ]
        ]
    ]
];