<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'External Import Test Data',
    'description' => 'Test data and scenarios for the External Import extension.',
    'category' => 'example',
    'author' => 'Francois Suter (Idéative)',
    'author_email' => 'typo3@cobweb.ch',
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
    'version' => '0.11.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'external_import' => '6.0.0-0.0.0',
                    'svconnector_feed' => '3.0.0-0.0.0',
                    'svconnector_csv' => '3.0.0-0.0.0',
                    'svconnector_json' => '3.0.0-0.0.0',
                    'typo3' => '10.4.0-11.5.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
