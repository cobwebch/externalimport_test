<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

/*
 * Orders are used to test MM relations with additional fields (quantity in this case)
 */
return array(
	'ctrl' => array(
		'title' => 'Orders',
		'label' => 'order_id',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'default_sortby' => 'ORDER BY order_id',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_order.png',
		'external' => array(
			0 => array(
				'connector' => 'csv',
				'parameters' => array(
					'filename' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Orders.csv',
					'delimiter' => "\t",
					'text_qualifier' => '',
					'encoding' => 'utf8',
					'skip_rows' => 1
				),
				'data' => 'array',
				'referenceUid' => 'order_id',
				'additionalFields' => 'qty',
				'priority' => 5300,
				'description' => 'List of orders'
			)
		)
	),
	'interface' => array(
		'showRecordFieldList' => 'order_id,client_id,order_date,products'
	),
	'columns' => array(
		'order_id' => array(
			'exclude' => 0,
			'label' => 'Order ID',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'required,trim',
			),
			'external' => array(
				0 => array(
					'field' => 'order',
					'trim' => TRUE
				)
			)
		),
		'order_date' => array(
			'exclude' => 0,
			'label' => 'Order date',
			'config' => array(
				'type' => 'input',
				'size' => '20',
				'eval' => 'required,datetime',
			),
			'external' => array(
				0 => array(
					'field' => 'date',
					'userFunc' => array(
						'class' => 'EXT:external_import/samples/class.tx_externalimport_transformations.php:tx_externalimport_transformations',
						'method' => 'parseDate',
						'params' => array(
							'enforceTimeZone' => TRUE
						)
					)
				)
			)
		),
		'client_id' => array(
			'exclude' => 0,
			'label' => 'Client',
			'config' => array(
				'type' => 'input',
				'size' => '30',
				'eval' => 'required,trim',
			),
			'external' => array(
				0 => array(
					'field' => 'customer',
					'trim' => TRUE
				)
			)
		),
		/*
		 * Relations between orders and products are stored in a MM table.
		 * During import the quantity is stored in an extra field of that table.
		 * However this cannot be viewed in the TYPO3 BE.
		 * The proper structure for TYPO3 would be to use an IRRE field for products
		 * where the quantity could be entered in a normal field. However this
		 * doesn't work with external_import in its current state, as it would
		 * imply creating nested records during import (orders and order-product
		 * relations). This is currently not possible.
		 * Anyway, this structure is useful for testing a number of features related to MM tables.
		 */
		'products' => array(
			'exclude' => 0,
			'label' => 'Products',
			'config' => array(
				'type' => 'select',
				'foreign_table' => 'tx_externalimporttest_product',
				'foreign_table_where' => 'ORDER BY name',
				'MM' => 'tx_externalimporttest_order_items_mm',
				'MM_match_fields' => array(
					'tablenames' => 'tx_externalimporttest_product',
					'fieldname' => 'products'
				),
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
							'quantity' => 'qty'
						)
					)
				)
			)
		)
	),
	'types' => array(
		'0' => array('showitem' => 'order_id,client_id,order_date,products')
	),
);
