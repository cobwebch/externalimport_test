<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_externalimporttest_product');

// Register sprite icons for new tables
/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
$iconRegistry->registerIcon(
        'tx_externalimporttest-product',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Product.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-bundle',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Bundle.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-invoice',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Invoice.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-order',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Order.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-store',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Store.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-tag',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Tag.svg'
        ]
);
$iconRegistry->registerIcon(
        'tx_externalimporttest-designer',
        \TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
        [
                'source' => 'EXT:externalimport_test/Resources/Public/Icons/Designer.svg'
        ]
);
