<?php

return [
    'ctrl' => [
        'title' => 'Products in stores',
        'label' => 'store',
        'label_alt' => 'product',
        'label_alt_force' => true,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-order'
        ],
        'security' => [
            'ignorePageTypeRestriction' => true,
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'store, product, stock']
    ],
    'columns' => [
        'store' => [
            'label' => 'Store',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_externalimporttest_store',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1
            ]
        ],
        'product' => [
            'label' => 'Product',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_externalimporttest_product',
                'size' => 1,
                'minitems' => 1,
                'maxitems' => 1
            ]
        ],
        'stock' => [
            'label' => 'Stock',
            'config' => [
                'type' => 'number',
                'size' => 10
            ]
        ]
    ]
];