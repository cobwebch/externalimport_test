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
                    'svconnector_feed' => '6.0.0-0.0.0',
                    'svconnector_csv' => '6.0.0-0.0.0',
                    'svconnector_json' => '6.0.0-0.0.0',
                    'typo3' => '13.4.0-14.3.99',
                ],
            'conflicts' =>
                [
                ],
            'suggests' =>
                [
                ],
        ],
];
