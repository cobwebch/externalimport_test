<?php

// Invoices are used to test XML import with namespaces
return [
    'ctrl' => [
        'title' => 'Invoices',
        'label' => 'invoice_id',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY invoice_id',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-invoice'
        ],
    ],
    'external' => [
        'general' => [
            0 => [
                'connector' => 'feed',
                'parameters' => [
                    'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Invoices.xml',
                    'encoding' => 'utf8'
                ],
                'data' => 'xml',
                'referenceUid' => 'invoice_id',
                'nodetype' => 'InvoiceLine',
                'namespaces' => [
                    'cac' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2',
                    'cbc' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2'
                ],
                'priority' => 5500,
                'description' => 'List of invoices'
            ]
        ]
    ],
    'columns' => [
        'invoice_id' => [
            'exclude' => 0,
            'label' => 'Invoice ID',
            'config' => [
                'type' => 'input',
                'size' => 20,
                'eval' => 'trim',
                'required' => true,
            ],
            'external' => [
                0 => [
                    'fieldNS' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2',
                    'field' => 'ID',
                    'transformations' => [
                        10 => [
                            'trim' => true
                        ]
                    ]
                ]
            ]
        ],
        'order_id' => [
            'exclude' => 0,
            'label' => 'Order ID',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_externalimporttest_order',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1
            ],
            'external' => [
                0 => [
                    'xpath' => 'cac:OrderReference/cbc:ID',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tx_externalimporttest_order',
                                'referenceField' => 'order_id'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'amount' => [
            'exclude' => 0,
            'label' => 'Amount',
            'config' => [
                'type' => 'number',
                'size' => 20,
                'format' => 'decimal',
                'required' => true,
            ],
            'external' => [
                0 => [
                    'fieldNS' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2',
                    'field' => 'LineExtensionAmount'
                ]
            ]
        ],
        'currency' => [
            'exclude' => 0,
            'label' => 'Currency',
            'config' => [
                'type' => 'input',
                'size' => 5,
                'eval' => 'trim',
                'required' => true,
            ],
            'external' => [
                0 => [
                    'xpath' => 'cbc:LineExtensionAmount',
                    'attribute' => 'currencyID',
                    'transformations' => [
                        10 => [
                            'trim' => true
                        ]
                    ]
                ]
            ]
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'invoice_id, order_id, amount, currency']
    ],
];
