<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'External Import Test Data',
    'description' => 'Test data and scenarios for the External Import extension.',
    'category' => 'example',
    'author' => 'Francois Suter (Idéative)',
    'author_email' => 'typo3@ideative.ch',
    'state' => 'alpha',
    'author_company' => '',
    'version' => '0.15.0',
    'constraints' =>
        [
            'depends' =>
                [
                    'external_import' => '8.0.0-0.0.0',
                    'svconnector_feed' => '5.0.0-0.0.0',
                    'svconnector_csv' => '5.0.0-0.0.0',
                    'svconnector_json' => '5.0.0-0.0.0',
                    'typo3' => '12.4.0-13.4.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
