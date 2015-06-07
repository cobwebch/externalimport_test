<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/*
 * Bundles are used to test MM relations.
 * They also use an additional field in the MM relation to test sorting.
 */
return array(
	'ctrl' => array(
		'title' => 'Bundles',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_bundle.png',
		'external' => array(
			0 => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Bundles.csv',
					'delimiter' => ';',
					'text_qualifier' => '',
					'encoding' => 'utf8',
					'skip_rows' => 1
				),
				'data' => 'array',
				'reference_uid' => 'bundle_code',
				'additional_fields' => 'position',
				'priority' => 5200,
				'description' => 'List of bundles'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'bundle_code,name'
	),
	'columns' => array(
		'bundle_code' => array(
			'exclude' => 0,
			'label' => 'Code',
			'config' => array(
				'type' => 'input',
				'size' => '10'
			),
			'external' => array(
				0 => array(
					'field' => 'code',
					'trim' => TRUE
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
					'field' => 'name',
					'trim' => TRUE
				)
			)
		),
		'products' => array(
			'exclude' => 0,
			'label' => 'Products',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_externalimporttest_product',
				'foreign_table_where' => 'ORDER BY name',
				'MM' => 'tx_externalimporttest_bundle_product_mm',
				'size' => 10,
				'minitems' => 1,
				'maxitems' => 9990
			),
			'external' => array(
				0 => array(
					'field' => 'product',
					'MM' => array(
						'mapping' => array(
							'table' => 'tx_externalimporttest_product',
							'reference_field' => 'sku'
						),
						'sorting' => 'position'
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'name,code,products')
	),
);
