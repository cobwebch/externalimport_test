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
                'typeicon_classes' => [
                        'default' => 'tx_externalimporttest-product'
                ]
        ],
        'external' => [
                'general' => [
                        'base' => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/ProductsSILLYMARKER.xml',
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
                                                'position' => 'after:' . \Cobweb\ExternalImport\Step\ValidateDataStep::class,
                                                'parameters' => [
                                                        'tag' => ' (base)'
                                                ]
                                        ]
                                ],
                                // NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
                                'disabledOperations' => 'delete',
                                'description' => 'Products catalogue'
                        ],
                        'more' => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/MoreProducts.xml',
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
                                        'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/StableProducts.xml',
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
                                        'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/ProductsForStores.csv',
                                        'delimiter' => "\t",
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'sku',
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
                                'customSteps' => [
                                        [
                                                'class' => \Cobweb\ExternalImport\Step\HandleDataStep::class,
                                                'position' => 'next:' . \Cobweb\ExternalImport\Step\TransformDataStep::class
                                        ]
                                ],
                                'description' => 'Configuration with errors for testing the control configuration validator'
                        ],
                        'updated_products' => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/UpdatedProducts.csv',
                                        'delimiter' => ';',
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'sku',
                                'priority' => 5810,
                                'disabledOperations' => 'insert,delete',
                                'updateSlugs' => true,
                                'description' => 'Update of products (moving to pages, update slug)'
                        ]
                ],
                'additionalFields' => [
                        'products_for_stores' => [
                                'qty' => [
                                        'field' => 'qty'
                                ]
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'sku,name'
        ],
        'columns' => [
                'sku' => [
                        'exclude' => false,
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
                        'exclude' => false,
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
                                'updated_products' => [
                                        'field' => 'name'
                                ]
                        ]
                ],
                'path_segment' => [
                        'exclude' => false,
                        'label' => 'Speaking URL',
                        'config' => [
                                'type' => 'slug',
                                'eval' => 'uniqueInSite',
                                'fallbackCharacter' => '-',
                                'generatorOptions' => [
                                        'fields' => [
                                                'name'
                                        ]
                                ]
                        ]
                ],
                'tags' => [
                        'exclude' => false,
                        'label' => 'Tags',
                        'config' => [
                                'type' => 'select',
                                'renderType' => 'selectMultipleSideBySide',
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
                        'exclude' => false,
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
                                                        'userFunction' => [
                                                                'class' => \Cobweb\ExternalimportTest\UserFunction\Transformation::class,
                                                                'method' => 'processAttributes'
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ],
                'pictures' => [
                        'exclude' => 0,
                        'label' => 'Pictures',
                        'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                                'pictures',
                                [],
                                $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
                        ),
                        'external' => [
                                'base' => [
                                        'xpath' => 'pictures/picture',
                                        'substructureFields' => [
                                                'pictures' => [
                                                        'field' => 'file'
                                                ],
                                                'picture_title' => [
                                                        'field' => 'title'
                                                ]
                                        ],
                                        'transformations' => [
                                                10 => [
                                                        'userFunction' => [
                                                                'class' => \Cobweb\ExternalImport\Transformation\ImageTransformation::class,
                                                                'method' => 'saveImageFromUri',
                                                                'parameters' => [
                                                                        'storage' => '1:imported_images',
                                                                        'nameField' => 'picture_title',
                                                                        'defaultExtension' => 'jpg'
                                                                ]
                                                        ]
                                                ]
                                        ],
                                        'children' => [
                                                'table' => 'sys_file_reference',
                                                'columns' => [
                                                        'uid_local' => [
                                                                'field' => 'pictures'
                                                        ],
                                                        'uid_foreign' => [
                                                                'field' => '__parent.id__'
                                                        ],
                                                        'title' => [
                                                                'field' => 'picture_title'
                                                        ],
                                                        'tablenames' => [
                                                                'value' => 'tx_externalimporttest_product'
                                                        ],
                                                        'fieldname' => [
                                                                'value' => 'pictures'
                                                        ],
                                                        'table_local' => [
                                                                'value' => 'sys_file'
                                                        ]
                                                ],
                                                'controlColumnsForUpdate' => 'uid_local, uid_foreign, tablenames, fieldname, table_local',
                                                'controlColumnsForDelete' => 'uid_foreign, tablenames, fieldname, table_local'
                                        ]
                                ]
                        ]
                ],
                'stores' => [
                        'exclude' => false,
                        'label' => 'Stores',
                        'config' => [
                                'type' => 'select',
                                'renderType' => 'selectMultipleSideBySide',
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
                '0' => ['showitem' => 'name, path_segment, sku, tags, attributes, pictures, stores']
        ],
];
