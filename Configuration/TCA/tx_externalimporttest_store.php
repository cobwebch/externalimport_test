<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/*
 * Stores are used to test MM relations with opposite fields.
 */
return array(
	'ctrl' => array(
		'title' => 'Stores',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_store.png',
		'external' => array(
			0 => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Stores.csv',
					'delimiter' => ';',
					'text_qualifier' => '',
					'encoding' => 'utf8',
					'skip_rows' => 1
				),
				'data' => 'array',
				'referenceUid' => 'store_code',
				'additionalFields' => 'qty',
				'priority' => 5400,
				'description' => 'List of stores'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'store_code,name'
	),
	'columns' => array(
		'store_code' => array(
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
				'MM' => 'tx_externalimporttest_store_product_mm',
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
						'additionalFields' => array(
							'stock' => 'qty'
						)
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'name,code,products')
	),
);
