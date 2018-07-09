<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return [
        'ctrl' => [
                'title' => 'Products',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_product.png',
                'external' => [
                        'base' => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductsSILLYMARKER.xml',
                                        'encoding' => 'utf8'
                                ],
                                'group' => 'Products',
                                'data' => 'xml',
                                'nodetype' => 'products',
                                'referenceUid' => 'sku',
                                'priority' => 5100,
                                'customSteps' => [
                                        [
                                                'class' => \Cobweb\ExternalimportTest\Step\EnhanceDataStep::class,
                                                'position' => 'after:' . \Cobweb\ExternalImport\Step\ValidateDataStep::class
                                        ]
                                ],
                                // NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
                                'disabledOperations' => 'delete',
                                'description' => 'Products catalogue'
                        ],
                        'more' => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/MoreProducts.xml',
                                        'encoding' => 'utf8'
                                ],
                                'group' => 'Products',
                                'data' => 'xml',
                                'nodetype' => 'products',
                                'referenceUid' => 'sku',
                                'priority' => 5110,
                                'useColumnIndex' => 'base',
                                // NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
                                'disabledOperations' => 'delete',
                                'description' => 'Alternate products catalogue'
                        ],
                        'stable' => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/StableProducts.xml',
                                        'encoding' => 'utf8'
                                ],
                                'group' => 'Products',
                                'data' => 'xml',
                                'nodetype' => 'products',
                                'referenceUid' => 'sku',
                                'priority' => 5120,
                                'useColumnIndex' => 'base',
                                // NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
                                'disabledOperations' => 'update,delete',
                                'description' => 'Stable products catalogue (no update)'
                        ],
                        // Tests import with MM_opposite_field property
                        'products_for_stores' => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductsForStores.csv',
                                        'delimiter' => "\t",
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'sku',
                                'additionalFields' => 'qty',
                                'priority' => 5410,
                                'disabledOperations' => 'insert,delete',
                                'description' => 'List of products for stores'
                        ],
                        // Configuration with errors, for testing the control configuration validator
                        'control_configuration_errors' => [
                                'connector' => 'foo',
                                'data' => 'bar',
                                'dataHandler' => \Cobweb\ExternalImport\Importer::class,
                                'pid' => 0,
                                'useColumnIndex' => 'baz',
                                'description' => 'Configuration with errors for testing the control configuration validator'
                        ],
                        'updated_products' => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/UpdatedProducts.csv',
                                        'delimiter' => ';',
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'sku',
                                'priority' => 5810,
                                'disabledOperations' => 'insert,delete',
                                'description' => 'Update of products (moving to pages)'
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'sku,name'
        ],
        'columns' => [
                'sku' => [
                        'exclude' => 0,
                        'label' => 'SKU',
                        'config' => [
                                'type' => 'input',
                                'size' => 10
                        ],
                        'external' => [
                                'base' => [
                                        'xpath' => './self::*[@type="current"]/item',
                                        'attribute' => 'sku'
                                ],
                                'products_for_stores' => [
                                        'field' => 'product'
                                ],
                                'updated_products' => [
                                        'field' => 'product_sku'
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
                                'base' => [
                                        'xpath' => './self::*[@type="current"]/item',
                                ],
                        ]
                ],
                'tags' => [
                        'exclude' => 0,
                        'label' => 'Tags',
                        'config' => [
                                'type' => 'select',
                                'size' => 5,
                                'foreign_table' => 'tx_externalimporttest_tag',
                                'foreign_table_where' => 'ORDER BY name',
                                'minitems' => 0,
                                'maxitems' => 9999
                        ],
                        'external' => [
                                'base' => [
                                        'xpath' => './self::*[@type="current"]/tags',
                                        'transformations' => [
                                                10 => [
                                                        'mapping' => [
                                                                'table' => 'tx_externalimporttest_tag',
                                                                'referenceField' => 'code',
                                                                'multipleValuesSeparator' => ','
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ],
                'attributes' => [
                        'exclude' => 0,
                        'label' => 'Attributes',
                        'config' => [
                                'type' => 'text',
                                'rows' => 5,
                                'cols' => 40
                        ],
                        'external' => [
                                'base' => [
                                        'xpath' => './self::*[@type="current"]/attributes',
                                        'xmlValue' => true,
                                        'transformations' => [
                                                10 => [
                                                        'userFunc' => [
                                                                'class' => \Cobweb\ExternalimportTest\UserFunction\Transformation::class,
                                                                'method' => 'processAttributes'
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ],
                'stores' => [
                        'exclude' => 0,
                        'label' => 'Stores',
                        'config' => [
                                'type' => 'select',
                                'foreign_table' => 'tx_externalimporttest_store',
                                'foreign_table_where' => 'ORDER BY name',
                                'MM' => 'tx_externalimporttest_store_product_mm',
                                'MM_opposite_field' => 'products',
                                'size' => 10,
                                'minitems' => 0,
                                'maxitems' => 9999
                        ],
                        'external' => [
                                'products_for_stores' => [
                                        'field' => 'store',
                                        'MM' => [
                                                'mapping' => [
                                                        'table' => 'tx_externalimporttest_store',
                                                        'referenceField' => 'store_code'
                                                ],
                                                'additionalFields' => [
                                                        'stock' => 'qty'
                                                ]
                                        ]
                                ]
                        ]
                ],
                'pid' => [
                        'config' => [
                                'type' => 'passthrough'
                        ],
                        'external' => [
                                'updated_products' => [
                                        'field' => 'page_sku',
                                        'transformations' => [
                                                10 => [
                                                        'mapping' => [
                                                                'table' => 'pages',
                                                                'referenceField' => 'product_sku'
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ]
        ],
        'types' => [
                '0' => ['showitem' => 'name,sku,tags,attributes,stores']
        ],
];
