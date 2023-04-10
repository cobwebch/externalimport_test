<?php

$GLOBALS['TCA']['tx_externalimporttest_product']['columns']['categories']['external']['base'] = [
    'xpath' => './self::*[@type="current"]/category',
    'transformations' => [
        10 => [
            'mapping' => [
                'table' => 'sys_category',
                'referenceField' => 'external_key',
                'default' => ''
            ]
        ]
    ]
];