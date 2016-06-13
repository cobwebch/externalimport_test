<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

return array(
	'ctrl' => array(
		'title' => 'Tags',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_tag.png',
		'external' => array(
			0 => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Tags.txt',
					'delimiter' => ';',
					'text_qualifier' => '"',
					'encoding' => 'utf8',
					'skip_rows' => 1
				),
				'data' => 'array',
				'referenceUid' => 'code',
				'priority' => 5000,
				'description' => 'List of tags'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'code,name'
	),
	'columns' => array(
		'code' => array(
			'exclude' => 0,
			'label' => 'Code',
			'config' => array(
				'type' => 'input',
				'size' => '10'
			),
			'external' => array(
				0 => array(
					'field' => 'Code'
				)
			)
		),
		'name' => array(
			'exclude' => 0,
			'label' => 'Name',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
			'external' => array(
				0 => array(
					'field' => 'Name',
					'trim' => TRUE
				)
			)
		),
	),
	'types' => array(
		'0' => array('showitem' => 'name,code')
	),
);
