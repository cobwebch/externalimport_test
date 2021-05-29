<?php
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
                'typeicon_classes' => [
                        'default' => 'tx_externalimporttest-bundle'
                ]
        ],
        'external' => [
                'general' => [
                        0 => [
                                'connector' => 'json',
                                'parameters' => [
                                        'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Bundles.json'
                                ],
                                'data' => 'array',
                                'referenceUid' => 'bundle_code',
                                'priority' => 5200,
                                'description' => 'List of bundles'
                        ]
                ],
                'additionalFields' => [
                        0 => [
                                'position' => [
                                        'field' => 'position',
                                        'transformations' => [
                                                10 => [
                                                        'userFunction' => [
                                                                'class' => \Cobweb\ExternalimportTest\UserFunction\Transformation::class,
                                                                'method' => 'stripPositionMarker'
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ]
        ],
        'columns' => [
                'bundle_code' => [
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
                'maker' => [
                        'exclude' => 0,
                        'label' => 'Maker',
                        'config' => [
                                'type' => 'input',
                                'size' => 30,
                                'eval' => 'required,trim',
                        ],
                        'external' => [
                                0 => [
                                        'arrayPath' => 'maker/name',
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
                                'renderType' => 'selectMultipleSideBySide',
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
                                        'multipleRows' => true,
                                        'multipleSorting' => 'position',
                                        'transformations' => [
                                                10 => [
                                                        'mapping' => [
                                                                'table' => 'tx_externalimporttest_product',
                                                                'referenceField' => 'sku'
                                                        ]
                                                ]
                                        ]
                                ]
                        ]
                ]
        ],
        'types' => [
                '0' => ['showitem' => 'name,code,maker,products']
        ],
];
