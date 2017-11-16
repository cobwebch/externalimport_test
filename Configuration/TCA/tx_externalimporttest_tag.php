<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

return [
        'ctrl' => [
                'title' => 'Tags',
                'label' => 'name',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY name',
                'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_tag.png',
                'external' => [
                        0 => [
                                'connector' => 'csv',
                                'parameters' => [
                                        'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Tags.txt',
                                        'delimiter' => ';',
                                        'text_qualifier' => '"',
                                        'encoding' => 'utf8',
                                        'skip_rows' => 1
                                ],
                                'data' => 'array',
                                'referenceUid' => 'code',
                                'priority' => 5000,
                                'description' => 'List of tags'
                        ],
                        'api' => [
                                'data' => 'array',
                                'referenceUid' => 'code',
                                'description' => 'Tags defined via the import API'
                        ]
                ]
        ],
        'interface' => [
                'showRecordFieldList' => 'code,name'
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
