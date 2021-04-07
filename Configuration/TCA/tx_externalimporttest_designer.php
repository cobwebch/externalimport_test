<?php
return [
        'ctrl' => [
                'title' => 'Designers',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'typeicon_classes' => [
                        'default' => 'tx_externalimporttest-designer'
                ]
        ],
        'external' => [
                'general' => [
                        0 => [
                                'connector' => 'feed',
                                'parameters' => [
                                        'uri' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Products.xml',
                                        'encoding' => 'utf8'
                                ],
                                'data' => 'xml',
                                'nodepath' => '//products/designers/designer',
                                'referenceUid' => 'code',
                                'priority' => 5080,
                                'description' => 'Product designers'
                        ]
                ]
        ],
        'columns' => [
                'code' => [
                        'exclude' => 0,
                        'label' => 'Code',
                        'config' => [
                                'type' => 'input',
                                'size' => 10
                        ],
                        'external' => [
                                0 => [
                                        'field' => 'code'
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
        ],
        'types' => [
                '0' => ['showitem' => 'name,code']
        ],
];
