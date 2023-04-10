<?php

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

// TODO: switch to $GLOBALS['TCA'][$table]['ctrl']['security']['ignorePageTypeRestriction'] when compat with v11 is dropped
ExtensionManagementUtility::allowTableOnStandardPages('tx_externalimporttest_product');
ExtensionManagementUtility::allowTableOnStandardPages('tx_externalimporttest_store_product');
