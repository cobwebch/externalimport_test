<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/*
 * Orders are used to test MM relations with additional fields (quantity in this case)
 */
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
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Orders.csv',
                                        'delimiter' => "\t",
                                        'text_qualifier' => '',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'order_id',
                                'priority' => 5300,
                                'description' => 'List of orders'
                        ]
                ],
                'additionalFields' => [
                        0 => [
                                'quantity' => [
                                        'field' => 'qty'
                                ]
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'order_id,client_id,order_date,products'
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
                                                        'userFunc' => [
                                                                'class' => \Cobweb\ExternalImport\Transformation\DateTimeTransformation::class,
                                                                'method' => 'parseDate',
                                                                'params' => [
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
                /*
                 * Relations between orders and products are stored in a MM table.
                 * During import the quantity is stored in an extra field of that table.
                 * However this cannot be viewed in the TYPO3 BE.
                 * The proper structure for TYPO3 would be to use an IRRE field for products
                 * where the quantity could be entered in a normal field. However this
                 * doesn't work with external_import in its current state, as it would
                 * imply creating nested records during import (orders and order-product
                 * relations). This is currently not possible.
                 * Anyway, this structure is useful for testing a number of features related to MM tables.
                 */
                'products' => [
                        'exclude' => 0,
                        'label' => 'Products',
                        'config' => [
                                'type' => 'select',
                                'foreign_table' => 'tx_externalimporttest_product',
                                'foreign_table_where' => 'ORDER BY name',
                                'MM' => 'tx_externalimporttest_order_items_mm',
                                'MM_match_fields' => [
                                        'tablenames' => 'tx_externalimporttest_product',
                                        'fieldname' => 'products'
                                ],
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
                                                        'quantity' => 'quantity'
                                                ]
                                        ]
                                ]
                        ]
                ]
        ],
        'types' => [
                '0' => ['showitem' => 'order_id,client_id,order_date,products']
        ],
];
