#
# Table structure for products
#
CREATE TABLE tx_externalimporttest_product (
	sku varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	path_segment varchar(2048) DEFAULT '' NOT NULL,
	tags varchar(255) DEFAULT '' NOT NULL,
	attributes text,
	stores int(11) DEFAULT '0' NOT NULL,
	categories int(11) DEFAULT '0' NOT NULL,
	pictures int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for tags
#
CREATE TABLE tx_externalimporttest_tag (
	code varchar(20) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for designers
#
CREATE TABLE tx_externalimporttest_designer (
	name varchar(255) DEFAULT '' NOT NULL,
	code varchar(20) DEFAULT '' NOT NULL
);

#
# Table structure for orders
#
CREATE TABLE tx_externalimporttest_order (
	order_date int(11) DEFAULT '0' NOT NULL,
	products int(11) DEFAULT '0' NOT NULL,
	client_id varchar(255) DEFAULT '' NOT NULL,
	order_id varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for order details
#
CREATE TABLE tx_externalimporttest_order_items (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	sorting_foreign int(11) DEFAULT '0' NOT NULL,
	quantity int(11) DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for bundles
#
CREATE TABLE tx_externalimporttest_bundle (
	name varchar(255) DEFAULT '' NOT NULL,
	products int(11) DEFAULT '0' NOT NULL,
	bundle_code char(10) DEFAULT '' NOT NULL,
	maker varchar(255) DEFAULT '' NOT NULL
);

#
# Table structure for order bundle items
#
CREATE TABLE tx_externalimporttest_bundle_product_mm (
	uid_local int(11) DEFAULT '0' NOT NULL,
	uid_foreign int(11) DEFAULT '0' NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for stores
#
CREATE TABLE tx_externalimporttest_store (
	name varchar(255) DEFAULT '' NOT NULL,
	store_code char(10) DEFAULT '' NOT NULL,
	products int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for store stocks
#
CREATE TABLE tx_externalimporttest_store_product (
	store int(11) DEFAULT '0' NOT NULL,
	product int(11) DEFAULT '0' NOT NULL,
	stock int(11) DEFAULT '0' NOT NULL
);

#
# Table structure for invoices
#
CREATE TABLE tx_externalimporttest_invoice (
	invoice_id varchar(255) DEFAULT '' NOT NULL,
	order_id int(11) DEFAULT '0' NOT NULL,
	amount double(11,2) DEFAULT '0.0' NOT NULL,
	currency char(3) DEFAULT 'USD' NOT NULL
);

#
# Extend pages table for product-to-pages import
#
CREATE TABLE pages (
	product_sku varchar(255) DEFAULT '' NOT NULL
);

#
# Extend sys_category table for product categories import
#
CREATE TABLE sys_category (
	external_key varchar(255) DEFAULT '' NOT NULL
);
