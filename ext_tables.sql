#
# Table structure for table 'tx_externalimporttut_teams'
#
CREATE TABLE tx_externalimporttest_xmlimport (
	uid int(11) NOT NULL auto_increment,
	pid int(11) DEFAULT '0' NOT NULL,
	tstamp int(11) DEFAULT '0' NOT NULL,
	crdate int(11) DEFAULT '0' NOT NULL,
	cruser_id int(11) DEFAULT '0' NOT NULL,
	external_index int(11) DEFAULT '0' NOT NULL,
	value varchar(255) DEFAULT '' NOT NULL,

	PRIMARY KEY (uid),
	KEY parent (pid)
);
