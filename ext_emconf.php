<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'External Import Test Data',
    'description' => 'Test data and scenarios for the External Import extension.',
    'category' => 'example',
    'author' => 'Francois Suter (Idéative)',
    'author_email' => 'typo3@ideative.ch',
    'shy' => '',
    'priority' => '',
    'module' => '',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => 0,
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 1,
    'lockType' => '',
    'author_company' => '',
    'version' => '0.14.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'external_import' => '7.2.0-0.0.0',
                    'svconnector_feed' => '4.0.0-0.0.0',
                    'svconnector_csv' => '4.0.0-0.0.0',
                    'svconnector_json' => '4.0.0-0.0.0',
                    'typo3' => '11.5.0-12.4.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
