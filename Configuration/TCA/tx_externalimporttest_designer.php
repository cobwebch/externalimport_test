<?php

use Cobweb\ExternalImport\Transformation\ImageTransformation;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

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
        'products' => [
            'exclude' => 0,
            'label' => 'Products',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_externalimporttest_product',
                'MM' => 'tx_externalimporttest_product_designer_mm',
                'MM_opposite_field' => 'designers'
            ],
            'external' => [
                0 => [
                    'xpath' => './ancestor::products/item',
                    'attribute' => 'sku',
                    'transformations' => [
                        10 => [
                            'mapping' => [
                                'table' => 'tx_externalimporttest_product',
                                'referenceField' => 'sku'
                            ]
                        ]
                    ]
                ]
            ]
        ],
        'picture' => [
            'exclude' => 0,
            'label' => 'Picture',
            'config' => ExtensionManagementUtility::getFileFieldTCAConfig('picture'),
            'external' => [
                0 => [
                    'field' => 'photo',
                    'transformations' => [
                        10 => [
                            'userFunction' => [
                                'class' => ImageTransformation::class,
                                'method' => 'saveImageFromBase64',
                                'parameters' => [
                                    'storage' => '1:imported_images',
                                    'nameField' => 'name',
                                    'defaultExtension' => 'jpg'
                                ]
                            ]
                        ]
                    ],
                    'children' => [
                        'table' => 'sys_file_reference',
                        'columns' => [
                            'uid_local' => [
                                'field' => 'picture'
                            ],
                            'uid_foreign' => [
                                'field' => '__parent.id__'
                            ],
                            'title' => [
                                'field' => 'name'
                            ],
                            'tablenames' => [
                                'value' => 'tx_externalimporttest_designer'
                            ],
                            'fieldname' => [
                                'value' => 'picture'
                            ],
                        ],
                        'controlColumnsForUpdate' => 'uid_local, uid_foreign, tablenames, fieldname',
                        'controlColumnsForDelete' => 'uid_foreign, tablenames, fieldname',
                    ]
                ]
            ]
        ]
    ],
    'types' => [
        '0' => ['showitem' => 'name,code,products,picture']
    ],
];
