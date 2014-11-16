#
# Table structure for products
#
CREATE TABLE tx_externalimporttest_product (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	sku varchar(255) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	tags varchar(255) DEFAULT '' NOT NULL,
	attributes text,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for tags
#
CREATE TABLE tx_externalimporttest_tag (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	code varchar(20) DEFAULT '' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for orders
#
CREATE TABLE tx_externalimporttest_order (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	order_date int(11) DEFAULT '0' NOT NULL,
	products int(11) DEFAULT '0' NOT NULL,
	client_id varchar(255) DEFAULT '' NOT NULL,
	order_id varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for order details
#
CREATE TABLE tx_externalimporttest_order_product_mm (
	uid_local int(11) NOT NULL,
	uid_foreign int(11) NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,
	quantity int(11) NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);

#
# Table structure for bundles
#
CREATE TABLE tx_externalimporttest_bundle (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	name varchar(255) DEFAULT '' NOT NULL,
	products int(11) DEFAULT '0' NOT NULL,
	bundle_code char(10) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);

#
# Table structure for order bundle items
#
CREATE TABLE tx_externalimporttest_bundle_product_mm (
	uid_local int(11) NOT NULL,
	uid_foreign int(11) NOT NULL,
	sorting int(11) DEFAULT '0' NOT NULL,

	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
