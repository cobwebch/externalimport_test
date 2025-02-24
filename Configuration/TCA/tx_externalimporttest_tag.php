<?php

use Cobweb\ExternalImport\Step\HandleDataStep;
use Cobweb\ExternalimportTest\Step\TagsPreprocessorStep;

return [
    'ctrl' => [
        'title' => 'Tags',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'default_sortby' => 'ORDER BY name',
        'typeicon_classes' => [
            'default' => 'tx_externalimporttest-tag',
        ],
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
                    'skip_rows' => 1,
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'customSteps' => [
                    [
                        'class' => TagsPreprocessorStep::class,
                        'position' => 'after:' . HandleDataStep::class,
                    ],
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
                    'skip_rows' => 1,
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'useColumnIndex' => 0,
                'priority' => 5900,
                'disabledOperations' => 'insert,update',
                'description' => 'Delete existing tags outside of imported tags',
            ],
            'api' => [
                'groups' => [
                    'Products',
                    'Tags',
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'disabledOperations' => 'delete',
                'description' => 'Tags defined via the import API',
            ],
            'api-comments' => [
                'groups' => [
                    'Products',
                    'Tags',
                ],
                'data' => 'array',
                'referenceUid' => 'code',
                'disabledOperations' => 'delete',
                'description' => 'Comments for tags defined via the import API (for testing group in rections)',
            ],
        ],
    ],
    'columns' => [
        'code' => [
            'exclude' => 0,
            'label' => 'Code',
            'config' => [
                'type' => 'input',
                'size' => 10,
            ],
            'external' => [
                0 => [
                    'field' => 'Code',
                ],
                'api' => [
                    'field' => 'code',
                ],
                'api-comments' => [
                    'field' => 'code',
                ],
            ],
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
                    'field' => 'Name',
                    'transformations' => [
                        10 => [
                            'trim' => true
                        ],
                    ],
                ],
                'api' => [
                    'field' => 'name'
                ],
            ],
        ],
        'comments' => [
            'exclude' => 0,
            'label' => 'Comments',
            'config' => [
                'type' => 'text',
            ],
            'external' => [
                'api-comments' => [
                    'field' => 'comments',
                ],
            ],
        ],
    ],
    'types' => [
        '0' => [
            'showitem' => 'name, comments, code',
        ],
    ],
];
