CREATE TABLE tx_smbegehungsliste_domain_model_rundgang (
	kurztext text NOT NULL DEFAULT '',
	ort varchar(255) NOT NULL DEFAULT '',
	images int(11) unsigned NOT NULL DEFAULT '0',
	problems int(11) unsigned NOT NULL DEFAULT '0',
	verantwortlicher int(11) unsigned DEFAULT '0',
	teilnehmer int(11) unsigned NOT NULL DEFAULT '0',
	schwerpunkt int(11) unsigned DEFAULT '0'
);

CREATE TABLE fe_users (
	tx_extbase_type varchar(255) DEFAULT '' NOT NULL
);

CREATE TABLE tx_smbegehungsliste_domain_model_problem (
	rundgang int(11) unsigned DEFAULT '0' NOT NULL,
	text varchar(255) NOT NULL DEFAULT '',
	status int(11) DEFAULT '0' NOT NULL,
	images int(11) unsigned NOT NULL DEFAULT '0',
	termin int(11) NOT NULL DEFAULT '0',
	feuser int(11) unsigned DEFAULT '0',
	logs int(11) unsigned NOT NULL DEFAULT '0',
	massnahme int(11) unsigned DEFAULT '0',
	bereich int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_smbegehungsliste_domain_model_log (
	problem int(11) unsigned DEFAULT '0' NOT NULL,
	text varchar(255) NOT NULL DEFAULT '',
	type varchar(255) NOT NULL DEFAULT '',
	feuser int(11) unsigned DEFAULT '0'
);

CREATE TABLE tx_smbegehungsliste_domain_model_schwerpunkt (
	name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_smbegehungsliste_domain_model_massnahme (
	name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_smbegehungsliste_domain_model_bereich (
	name varchar(255) NOT NULL DEFAULT ''
);

CREATE TABLE tx_smbegehungsliste_rundgang_teilnehmer_feuser_mm (
	uid_local int(11) unsigned DEFAULT '0' NOT NULL,
	uid_foreign int(11) unsigned DEFAULT '0' NOT NULL,
	sorting int(11) unsigned DEFAULT '0' NOT NULL,
	sorting_foreign int(11) unsigned DEFAULT '0' NOT NULL,

	PRIMARY KEY (uid_local,uid_foreign),
	KEY uid_local (uid_local),
	KEY uid_foreign (uid_foreign)
);
