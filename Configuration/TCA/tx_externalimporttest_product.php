<?php

use Cobweb\ExternalImport\Importer;
use Cobweb\ExternalImport\Step\TransformDataStep;
use Cobweb\ExternalImport\Step\ValidateDataStep;
use Cobweb\ExternalImport\Transformation\DateTimeTransformation;
use Cobweb\ExternalImport\Transformation\ImageTransformation;
use Cobweb\ExternalimportTest\Step\EnhanceDataStep;
use Cobweb\ExternalimportTest\UserFunction\Transformation;

return [
    'ctrl' => [
        'title' => 'Products',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY name',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-product',
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'external' => [
        'general' => [
            'base' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/ProductsSILLYMARKER.xml',
                    'encoding' => 'utf8',
                ],
                'groups' => [
                    'Products',
                ],
                'data' => 'xml',
                'nodetype' => 'products',
                'referenceUid' => 'sku',
                'priority' => 5100,
                'customSteps' => [
                    [
                        'class' => EnhanceDataStep::class,
                        'position' => 'after:' . ValidateDataStep::class,
                        'parameters' => [
                            'tag' => ' (base)',
                        ],
                    ],
                ],
                // NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
                'disabledOperations' => 'delete',
                'description' => 'Products catalogue',
            ],
            'more' => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/MoreProducts.xml',
                    'encoding' => 'utf8'
                ],
                'groups' => [
                    'Products',
                ],
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
                'groups' => [
                    'Products',
                ],
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
            // Configuration with errors, for testing the general configuration validator
            'general_configuration_errors' => [
                'connector' => 'foo',
                'data' => 'bar',
                'dataHandler' => Importer::class,
                'pid' => 0,
                'useColumnIndex' => 'baz',
                'customSteps' => [
                    [
                        'class' => EnhanceDataStep::class,
                        'position' => 'next:' . TransformDataStep::class
                    ]
                ],
                'description' => 'Configuration with errors for testing the general configuration validator'
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
                'eval' => 'trim',
                'required' => true,
            ],
            'external' => [
                'base' => [
                    'xpath' => './self::*[@type="current"]/item',
                ],
                // Overrides the "base" index configuration, which is normally reused because of the "useColumnIndex"
                // property in the general configuration
                'stable' => [
                    'xpath' => './self::*[@type="current"]/item',
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => Transformation::class,
                                'method' => 'caseTransformation',
                                'parameters' => [
                                    'transformation' => 'upper'
                                ]
                            ]
                        ]
                    ]
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
        'created' => [
            'exclude' => false,
            'label' => 'Date of creation',
            'config' => [
                'type' => 'datetime'
            ],
            'external' => [
                'base' => [
                    'xpath' => './self::*[@type="current"]/date',
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => DateTimeTransformation::class,
                                'method' => 'parseDate',
                                'parameters' => [
                                    'enforceTimeZone' => true
                                ]
                            ]
                        ]
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
                'cols' => 40,
                'nullable' => true,
            ],
            'external' => [
                'base' => [
                    'xpath' => './self::*[@type="current"]/attributes',
                    'xmlValue' => true,
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => Transformation::class,
                                'method' => 'processAttributes',
                            ],
                        ],
                        20 => [
                            'isEmpty' => [
                                'default' => null,
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'pictures' => [
            'exclude' => 0,
            'label' => 'Pictures',
            'config' => [
                'type' => 'file',
                'allowed' => 'common-image-types',
            ],
            'external' => [
                'base' => [
                    'xpath' => 'pictures/picture',
                    'substructureFields' => [
                        'pictures' => [
                            'field' => 'file'
                        ],
                        'picture_title' => [
                            'field' => 'title'
                        ],
                        'picture_order' => [
                            'field' => 'sorting'
                        ],
                    ],
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => ImageTransformation::class,
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
                        ],
                        'sorting' => [
                            'source' => 'picture_order',
                            'target' => 'sorting_foreign'
                        ],
                        'controlColumnsForUpdate' => 'uid_local, uid_foreign, tablenames, fieldname',
                        'controlColumnsForDelete' => 'uid_foreign, tablenames, fieldname'
                    ]
                ]
            ]
        ],
        'stores' => [
            'exclude' => false,
            'label' => 'Stores',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_externalimporttest_store_product',
                'foreign_field' => 'product'
            ],
            'external' => [
                'products_for_stores' => [
                    'field' => 'store',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tx_externalimporttest_store',
                                'referenceField' => 'store_code'
                            ]
                        ]
                    ],
                    'children' => [
                        'table' => 'tx_externalimporttest_store_product',
                        'columns' => [
                            'store' => [
                                'field' => 'stores'
                            ],
                            'product' => [
                                'field' => '__parent.id__'
                            ],
                            'stock' => [
                                'field' => 'qty'
                            ]
                        ],
                        'controlColumnsForUpdate' => 'product, store',
                        'controlColumnsForDelete' => 'product'
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
        ],
        'designers' => [
            'exclude' => 0,
            'label' => 'Designers',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_externalimporttest_designer',
                'MM' => 'tx_externalimporttest_product_designer_mm',
            ],
        ],
        'categories' => [
            'exclude' => 0,
            'label' => 'Designers',
            'config' => [
                'type' => 'category',
            ],
            'external' => [
                'base' => [
                    'xpath' => './self::*[@type="current"]/category',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'sys_category',
                                'referenceField' => 'external_key',
                                'default' => '',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'name, path_segment, created, sku, tags, attributes, pictures, stores, designers, categories']
    ],
];
