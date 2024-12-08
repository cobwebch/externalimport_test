<?php

return [
    'ctrl' => [
        'title' => 'Order items',
        'label' => 'uid_local',
        'crdate' => 'crdate',
        'tstamp' => 'tstamp',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-orderitem'
        ],
    ],
    'columns' => [
        'uid_local' => [
            'exclude' => 0,
            'label' => 'Order',
            'config' => [
                'type' => 'number',
                'size' => 10
            ]
        ],
        'uid_foreign' => [
            'exclude' => 0,
            'label' => 'Product',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_externalimporttest_product',
                'foreign_table_where' => 'ORDER BY tx_externalimporttest_product.name',
                'maxitems' => 1
            ]
        ],
        'quantity' => [
            'exclude' => 0,
            'label' => 'Quantity',
            'config' => [
                'type' => 'number'
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => 'uid_foreign, quantity']
    ]
];
