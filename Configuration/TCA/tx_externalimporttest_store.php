<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/*
 * Stores are used to test MM relations with opposite fields.
 */
return [
        'ctrl' => [
                'title' => 'Stores',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'typeicon_classes' => [
                        'default' => 'tx_externalimporttest-store'
                ],
                'external' => [
                        0 => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Stores.csv',
                                        'delimiter' => ';',
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'store_code',
                                'additionalFields' => 'qty',
                                'priority' => 5400,
                                'description' => 'List of stores'
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'store_code,name'
        ],
        'columns' => [
                'store_code' => [
                        'exclude' => 0,
                        'label' => 'Code',
                        'config' => [
                                'type' => 'input',
                                'size' => 10
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
                                'size' => 30,
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
                                'MM' => 'tx_externalimporttest_store_product_mm',
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
                                                        'referenceField' => 'sku'
                                                ],
                                                'additionalFields' => [
                                                        'stock' => 'qty'
                                                ]
                                        ]
                                ]
                        ]
                ]
        ],
        'types' => [
                '0' => ['showitem' => 'name,code,products']
        ],
];
