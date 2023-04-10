<?php

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'tx_externalimporttest-product' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Product.svg',
    ],
    'tx_externalimporttest-bundle' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Bundle.svg',
    ],
    'tx_externalimporttest-invoice' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Invoice.svg',
    ],
    'tx_externalimporttest-order' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Order.svg',
    ],
    'tx_externalimporttest-orderitem' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/OrderItem.svg',
    ],
    'tx_externalimporttest-store' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Store.svg',
    ],
    'tx_externalimporttest-tag' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Tag.svg',
    ],
    'tx_externalimporttest-designer' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:externalimport_test/Resources/Public/Icons/Designer.svg',
    ],
];
