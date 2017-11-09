<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/*
 * Bundles are used to test MM relations.
 * They also use an additional field in the MM relation to test sorting.
 */
return [
        'ctrl' => [
                'title' => 'Bundles',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_bundle.png',
                'external' => [
                        0 => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Bundles.csv',
                                        'delimiter' => ';',
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'bundle_code',
                                'additionalFields' => 'position',
                                'priority' => 5200,
                                'description' => 'List of bundles'
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'bundle_code,name'
        ],
        'columns' => [
                'bundle_code' => [
                        'exclude' => 0,
                        'label' => 'Code',
                        'config' => [
                                'type' => 'input',
                                'size' => '10'
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'code',
                                        'transformations' => [
                                                10 => [
                                                        'trim' => true
                                                ]
                                        ]
                                ]
                        ]
                ],
                'name' => [
                        'exclude' => 0,
                        'label' => 'Name',
                        'config' => [
                                'type' => 'input',
                                'size' => '30',
                                'eval' => 'required,trim',
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'name',
                                        'transformations' => [
                                                10 => [
                                                        'trim' => true
                                                ]
                                        ]
                                ]
                        ]
                ],
                'products' => [
                        'exclude' => 0,
                        'label' => 'Products',
                        'config' => [
                                'type' => 'select',
                                'foreign_table' => 'tx_externalimporttest_product',
                                'foreign_table_where' => 'ORDER BY name',
                                'MM' => 'tx_externalimporttest_bundle_product_mm',
                                'size' => 10,
                                'minitems' => 1,
                                'maxitems' => 9990
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'product',
                                        'MM' => [
                                                'mapping' => [
                                                        'table' => 'tx_externalimporttest_product',
                                                        'reference_field' => 'sku'
                                                ],
                                                'sorting' => 'position'
                                        ]
                                ]
                        ]
                ]
        ],
        'types' => [
                '0' => ['showitem' => 'name,code,products']
        ],
];
