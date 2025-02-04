<?php

// Stores are used to test MM relations with opposite fields.
use Cobweb\ExternalimportTest\UserFunction\Transformation;

return [
    'ctrl' => [
        'title' => 'Stores',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY name',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-store'
        ]
    ],
    'external' => [
        'general' => [
            0 => [
                'connector' => 'csv',
                'parameters' => [
                    'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Stores.csv',
                    'delimiter' => ';',
                    'text_qualifier' => '',
                    'encoding' => 'utf8',
                    'skip_rows' => 1
                ],
                'groups' => [
                    'Products',
                    'Stores',
                ],
                'data' => 'array',
                'referenceUid' => 'store_code',
                'columnsOrder' => 'name, store_code',
                'priority' => 5400,
                'description' => 'List of stores'
            ]
        ],
        'additionalFields' => [
            0 => [
                'quantity' => [
                    'field' => 'qty'
                ],
                'status' => [
                    'field' => 'status',
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => Transformation::class,
                                'method' => 'checkStoreStatus'
                            ]
                        ]
                    ]
                ]
            ]
        ]
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
                        ],
                        20 => [
                            'isEmpty' => [
                                'expression' => 'store_code === ""',
                                'invalidate' => true
                            ]
                        ],
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
                'eval' => 'trim',
                'required' => true,
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
                'type' => 'inline',
                'foreign_table' => 'tx_externalimporttest_store_product',
                'foreign_field' => 'store'
            ],
            'external' => [
                0 => [
                    'field' => 'product',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tx_externalimporttest_product',
                                'referenceField' => 'sku'
                            ]
                        ]
                    ],
                    'children' => [
                        'table' => 'tx_externalimporttest_store_product',
                        'columns' => [
                            'store' => [
                                'field' => '__parent.id__'
                            ],
                            'product' => [
                                'field' => 'products'
                            ],
                            'stock' => [
                                'field' => 'quantity'
                            ]
                        ],
                        'controlColumnsForUpdate' => 'store, product',
                        'controlColumnsForDelete' => 'store'
                    ]
                ]
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => 'name, code, products']
    ],
];
