<?php

// Orders are used to test IRRE relations and arrayPath properties
return [
    'ctrl' => [
        'title' => 'Orders',
        'label' => 'order_id',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY order_id',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-order'
        ],
    ],
    'external' => [
        'general' => [
            0 => [
                'connector' => 'json',
                'parameters' => [
                    'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath(
                            'externalimport_test'
                        ) . 'Resources/Private/ImportData/Test/Orders.json'
                ],
                'data' => 'array',
                'arrayPath' => 'data/orders/*{status === \'valid\'}/list',
                'referenceUid' => 'order_id',
                'priority' => 5300,
                'description' => 'List of orders'
            ]
        ]
    ],
    'columns' => [
        'order_id' => [
            'exclude' => 0,
            'label' => 'Order ID',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'required,trim',
            ],
            'external' => [
                0 => [
                    'field' => 'order',
                    'transformations' => [
                        10 => [
                            'trim' => true
                        ]
                    ]
                ]
            ]
        ],
        'order_date' => [
            'exclude' => 0,
            'label' => 'Order date',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'required,datetime',
            ],
            'external' => [
                0 => [
                    'field' => 'date',
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => \Cobweb\ExternalImport\Transformation\DateTimeTransformation::class,
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
        'client_id' => [
            'exclude' => 0,
            'label' => 'Client',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'required,trim',
            ],
            'external' => [
                0 => [
                    'field' => 'customer',
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
                'foreign_table' => 'tx_externalimporttest_order_items',
                'foreign_selector' => 'uid_foreign',
                'foreign_label' => 'uid_foreign',
                'foreign_field' => 'uid_local',
                'foreign_sortby' => 'sorting_foreign',
                'minitems' => 1,
                'maxitems' => 9999,
                'appearance' => [
                    'useSortable' => true
                ]
            ],
            'external' => [
                0 => [
                    'field' => 'products',
                    'substructureFields' => [
                        'products' => [
                            'field' => 'product'
                        ],
                        'quantity' => [
                            'field' => 'qty'
                        ]
                    ],
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tx_externalimporttest_product',
                                'referenceField' => 'sku'
                            ],
                        ]
                    ],
                    'children' => [
                        'table' => 'tx_externalimporttest_order_items',
                        'columns' => [
                            'uid_local' => [
                                'field' => '__parent.id__'
                            ],
                            'uid_foreign' => [
                                'field' => 'products'
                            ],
                            'quantity' => [
                                'field' => 'quantity'
                            ]
                        ],
                        'controlColumnsForUpdate' => 'uid_local, uid_foreign',
                        'controlColumnsForDelete' => 'uid_local'
                    ]
                ]
            ]
        ]
    ],
    'types' => [
        '0' => [
            'showitem' => 'order_id, client_id, order_date, products'
        ]
    ],
];
