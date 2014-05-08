<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

return array(
	'ctrl' => array(
		'title' => 'Test table for XML import',
		'label' => 'value',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY value',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_xmlimport.png',
		'external' => array(
			0 => array(
				'connector' => 'feed',
				'parameters' => array(
					'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/XmlImport.xml',
					'encoding' => 'utf8'
				),
				'data' => 'xml',
				'nodetype' => 'node',
				'reference_uid' => 'external_index',
				'priority' => 5000,
				'description' => 'Import test XML'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'external_index,value'
	),
	'columns' => array(
		'external_index' => array(
			'exclude' => 0,
			'label' => 'External ID',
			'config' => array(
				'type' => 'input',
				'size' => '10',
				'eval' => 'int',
			),
			'external' => array(
				0 => array(
					'xpath' => './self::*[@type="relevant"]/item',
					'attribute' => 'index'
				)
			)
		),
		'value' => array(
			'exclude' => 0,
			'label' => 'Value',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
			'external' => array(
				0 => array(
					'xpath' => './self::*[@type="relevant"]/item',
				)
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'external_index,value')
	),
);
