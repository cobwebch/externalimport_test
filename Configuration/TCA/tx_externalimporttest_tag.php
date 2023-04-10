<?php

use Cobweb\ExternalImport\Step\HandleDataStep;
use Cobweb\ExternalimportTest\Step\TagsPreprocessorStep;

return [
    'ctrl' => [
        'title' => 'Tags',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'default_sortby' => 'ORDER BY name',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-tag'
        ]
    ],
    'external' => [
        'general' => [
            0 => [
                'connector' => 'csv',
                'parameters' => [
                    'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Tags.txt',
                    'delimiter' => ';',
                    'text_qualifier' => '"',
                    'encoding' => 'utf8',
                    'skip_rows' => 1
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'customSteps' => [
                    [
                        'class' => TagsPreprocessorStep::class,
                        'position' => 'after:' . HandleDataStep::class
                    ]
                ],
                'priority' => 5000,
                'description' => 'List of tags'
            ],
            'only-delete' => [
                'connector' => 'csv',
                'parameters' => [
                    'filename' => 'EXT:externalimport_test/Resources/Private/ImportData/Test/Tags.txt',
                    'delimiter' => ';',
                    'text_qualifier' => '"',
                    'encoding' => 'utf8',
                    'skip_rows' => 1
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'useColumnIndex' => 0,
                'priority' => 5900,
                'disabledOperations' => 'insert,update',
                'description' => 'Delete existing tags outside of imported tags'
            ],
            'api' => [
                'data' => 'array',
                'referenceUid' => 'code',
                'disabledOperations' => 'delete',
                'description' => 'Tags defined via the import API'
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
                    'field' => 'Code'
                ],
                'api' => [
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
                    'field' => 'Name',
                    'transformations' => [
                        10 => [
                            'trim' => true
                        ]
                    ]
                ],
                'api' => [
                    'field' => 'name'
                ]
            ]
        ],
    ],
    'types' => [
        '0' => ['showitem' => 'name,code']
    ],
];
