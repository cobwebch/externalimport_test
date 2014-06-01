<?php

// Register pre-processor with desired hook
$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['external_import']['preprocessRawRecordset'][] = 'Cobweb\\ExternalimportTest\\Service\\TagsPreprocessor';
