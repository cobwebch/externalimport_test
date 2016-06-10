<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

// Register hooks
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['external_import']['processParameters'][] = 'Cobweb\\ExternalimportTest\\Hook\\Hooks';
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['external_import']['preprocessRawRecordset'][] = 'Cobweb\\ExternalimportTest\\Service\\TagsPreprocessor';
