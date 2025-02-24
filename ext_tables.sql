#
# Table structure for products
#
CREATE TABLE tx_externalimporttest_product (
	sku varchar(255) default '' not null,
	name varchar(255) default '' not null,
	path_segment varchar(2048) default '' not null,
	tags varchar(255) default '' not null,
	attributes text,
	stores int(11) default 0 not null,
	categories int(11) default 0 not null,
	pictures int(11) default 0 not null,
	designers int(11) default 0 not null,
	created int(11) default 0 not null
);

#
# Table structure for tags
#
CREATE TABLE tx_externalimporttest_tag (
	code varchar(20) default '' not null,
	name varchar(255) default '' not null,
    comments text
);

#
# Table structure for designers
#
CREATE TABLE tx_externalimporttest_designer (
	name varchar(255) default '' not null,
	code varchar(20) default '' not null,
	products int(11) default 0 not null,
	picture int(11) default 0 not null
);

CREATE TABLE tx_externalimporttest_product_designer_mm (
	uid_local int(11) default 0 not null,
	uid_foreign int(11) default 0 not null,
	sorting int(11) default 0 not null,
	sorting_foreign int(11) default 0 not null
);

#
# Table structure for orders
#
CREATE TABLE tx_externalimporttest_order (
	order_date int(11) default 0 not null,
	products int(11) default 0 not null,
	client_id varchar(255) default '' not null,
	order_id varchar(255) default '' not null
);

#
# Table structure for order details
#
CREATE TABLE tx_externalimporttest_order_items (
	uid_local int(11) default 0 not null,
	uid_foreign int(11) default 0 not null,
	sorting_foreign int(11) default 0 not null,
	quantity int(11) default 0 not null,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for bundles
#
CREATE TABLE tx_externalimporttest_bundle (
	name varchar(255) default '' not null,
	products int(11) default 0 not null,
	bundle_code char(10) default '' not null,
	maker varchar(255) default '' not null,
	notes varchar(255) DEFAULT NULL
);

#
# Table structure for order bundle items
#
CREATE TABLE tx_externalimporttest_bundle_product_mm (
	uid_local int(11) default 0 not null,
	uid_foreign int(11) default 0 not null,
	sorting int(11) default 0 not null,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for stores
#
CREATE TABLE tx_externalimporttest_store (
	name varchar(255) default '' not null,
	store_code char(10) default '' not null,
	products int(11) default 0 not null
);

#
# Table structure for store stocks
#
CREATE TABLE tx_externalimporttest_store_product (
	store int(11) default 0 not null,
	product int(11) default 0 not null,
	stock int(11) default 0 not null
);

#
# Table structure for invoices
#
CREATE TABLE tx_externalimporttest_invoice (
	invoice_id varchar(255) default '' not null,
	order_id int(11) default 0 not null,
	amount double(11,2) default 0.0 not null,
	currency char(3) default 'USD' not null
);

#
# Extend pages table for product-to-pages import
#
CREATE TABLE pages (
	product_sku varchar(255) default '' not null
);

#
# Extend sys_category table for product categories import
#
CREATE TABLE sys_category (
	external_key varchar(255) default '' not null
);
