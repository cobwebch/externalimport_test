<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

/*
 * Invoices are used to test XML import with namespaces
 */
return array(
        'ctrl' => array(
                'title' => 'Invoices',
                'label' => 'invoice_id',
                'tstamp' => 'tstamp',
                'crdate' => 'crdate',
                'cruser_id' => 'cruser_id',
                'default_sortby' => 'ORDER BY invoice_id',
                'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('externalimport_test') . 'Resources/Public/Images/tx_externalimporttest_invoice.png',
                'external' => array(
                        0 => array(
                                'connector' => 'feed',
                                'parameters' => array(
                                        'uri' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('externalimport_test') . 'Resources/Private/ImportData/Test/Invoices.xml',
                                        'encoding' => 'utf8'
                                ),
                                'data' => 'xml',
                                'referenceUid' => 'invoice_id',
                                'nodetype' => 'InvoiceLine',
                                'namespaces' => array(
                                        'cac' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2',
                                        'cbc' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2'
                                ),
                                'priority' => 5500,
                                'description' => 'List of invoices'
                        )
                )
        ),
        'interface' => array(
                'showRecordFieldList' => 'invoice_id, order_id, amount, currency'
        ),
        'columns' => array(
                'invoice_id' => array(
                        'exclude' => 0,
                        'label' => 'Invoice ID',
                        'config' => array(
                                'type' => 'input',
                                'size' => '20',
                                'eval' => 'required,trim',
                        ),
                        'external' => array(
                                0 => array(
                                        'fieldNS' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2',
                                        'field' => 'ID',
                                        'trim' => true
                                )
                        )
                ),
                'order_id' => array(
                        'exclude' => 0,
                        'label' => 'Order ID',
                        'config' => array(
                                'type' => 'select',
                                'foreign_table' => 'tx_externalimporttest_order',
                                'size' => 1,
                                'minitems' => 1,
                                'maxitems' => 1
                        ),
                        'external' => array(
                                0 => array(
                                        'xpath' => 'cac:OrderReference/cbc:ID',
                                        'mapping' => array(
                                                'table' => 'tx_externalimporttest_order',
                                                'reference_field' => 'order_id'
                                        )
                                )
                        )
                ),
                'amount' => array(
                        'exclude' => 0,
                        'label' => 'Amount',
                        'config' => array(
                                'type' => 'input',
                                'size' => '20',
                                'eval' => 'required,double2',
                        ),
                        'external' => array(
                                0 => array(
                                        'fieldNS' => 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2',
                                        'field' => 'LineExtensionAmount'
                                )
                        )
                ),
                'currency' => array(
                        'exclude' => 0,
                        'label' => 'Currency',
                        'config' => array(
                                'type' => 'input',
                                'size' => '5',
                                'eval' => 'required,trim',
                        ),
                        'external' => array(
                                0 => array(
                                        'xpath' => 'cbc:LineExtensionAmount',
                                        'attribute' => 'currencyID',
                                        'trim' => true
                                )
                        )
                ),
        ),
        'types' => array(
                '0' => array('showitem' => 'invoice_id, order_id, amount, currency')
        ),
);
