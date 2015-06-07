<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

return array(
	'ctrl' => array(
		'title' => 'Products',
		'label' => 'name',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY name',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_product.png',
		'external' => array(
			'base' => array(
				'connector' => 'feed',
				'parameters' => array(
					'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductsSILLYMARKER.xml',
					'encoding' => 'utf8'
				),
				'data' => 'xml',
				'nodetype' => 'products',
				'reference_uid' => 'sku',
				'priority' => 5100,
				// NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
				'disabledOperations' => 'delete',
				'description' => 'Products catalogue'
			),
			'more' => array(
				'connector' => 'feed',
				'parameters' => array(
					'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/MoreProducts.xml',
					'encoding' => 'utf8'
				),
				'data' => 'xml',
				'nodetype' => 'products',
				'reference_uid' => 'sku',
				'priority' => 5110,
				'useColumnIndex' => 'base',
				// NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
				'disabledOperations' => 'delete',
				'description' => 'Alternate products catalogue'
			),
			'stable' => array(
				'connector' => 'feed',
				'parameters' => array(
					'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/StableProducts.xml',
					'encoding' => 'utf8'
				),
				'data' => 'xml',
				'nodetype' => 'products',
				'reference_uid' => 'sku',
				'priority' => 5120,
				'useColumnIndex' => 'base',
				// NOTE: this would not make sense in a real-life configuration. A separate pid would be used.
				'disabledOperations' => 'update,delete',
				'description' => 'Stable products catalogue (no update)'
			),
			// Tests import with MM_opposite_field property
			'products_for_stores' => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/ProductsForStores.csv',
					'delimiter' => "\t",
					'text_qualifier' => '',
					'encoding' => 'utf8',
					'skip_rows' => 1
				),
				'data' => 'array',
				'reference_uid' => 'sku',
				'additional_fields' => 'qty',
				'priority' => 5410,
				'disabledOperations' => 'insert,delete',
				'description' => 'List of products for stores'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'sku,name'
	),
	'columns' => array(
		'sku' => array(
			'exclude' => 0,
			'label' => 'SKU',
			'config' => array(
				'type' => 'input',
				'size' => '10'
			),
			'external' => array(
				'base' => array(
					'xpath' => './self::*[@type="current"]/item',
					'attribute' => 'sku'
				),
				'products_for_stores' => array(
					'field' => 'product'
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
				'base' => array(
					'xpath' => './self::*[@type="current"]/item',
				)
			)
		),
		'tags' => array(
			'exclude' => 0,
			'label' => 'Tags',
			'config' => array(
				'type' => 'select',
				'size' => '5',
				'foreign_table' => 'tx_externalimporttest_tag',
				'foreign_table_where' => 'ORDER BY name',
				'minitems' => 0,
				'maxitems' => 9999
			),
			'external' => array(
				'base' => array(
					'xpath' => './self::*[@type="current"]/tags',
					'mapping' => array(
						'table' => 'tx_externalimporttest_tag',
						'reference_field' => 'code',
						'multipleValuesSeparator' => ','
					)
				)
			)
		),
		'attributes' => array(
			'exclude' => 0,
			'label' => 'Attributes',
			'config' => array(
				'type' => 'text',
				'rows' => 5,
				'cols' => 40
			),
			'external' => array(
				'base' => array(
					'xpath' => './self::*[@type="current"]/attributes',
					'xmlValue' => TRUE,
					'userFunc' => array(
						'class' => 'Cobweb\ExternalimportTest\UserFunction\Transformation',
						'method' => 'processAttributes'
					)
				)
			)
		),
		'stores' => array(
			'exclude' => 0,
			'label' => 'Stores',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_externalimporttest_store',
				'foreign_table_where' => 'ORDER BY name',
				'MM' => 'tx_externalimporttest_store_product_mm',
				'MM_opposite_field' => 'products',
				'size' => 10,
				'minitems' => 1,
				'maxitems' => 9990
			),
			'external' => array(
				'products_for_stores' => array(
					'field' => 'store',
					'MM' => array(
						'mapping' => array(
							'table' => 'tx_externalimporttest_store',
							'reference_field' => 'store_code'
						),
						'additional_fields' => array(
							'stock' => 'qty'
						)
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'name,sku,tags,attributes,stores')
	),
);
