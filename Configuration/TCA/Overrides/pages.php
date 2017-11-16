<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/**
 * Import of product into pages is used to test the creation of pages,
 * in particular the reverse order that must be applied.
 *
 * For deleting already imported pages: DELETE FROM pages WHERE product_sku > ''
 */
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
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('pages', $newColumn);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('pages', 'product_sku');

$GLOBALS['TCA']['pages']['ctrl']['external']['product_pages'] = [
        'connector' => 'csv',
        'parameters' => [
                'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductPages.csv',
                'delimiter' => ';',
                'text_qualifier' => '',
                'encoding' => 'utf8',
                'skip_rows' => 1
        ],
        'data' => 'array',
        'referenceUid' => 'product_sku',
        'priority' => 5800,
        'description' => 'Product pages'
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