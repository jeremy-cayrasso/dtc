<?php
// Automatic database array generation for DTC
// Generation date: 2005-07(Jul)-21 Thursday 00:20
$dtc_database = array(
"version" => "1.0.0",
"tables" => array(
	"admin" => array(
		"vars" => array(
			"adm_login" => "varchar(64) NOT NULL ",
			"adm_pass" => "varchar(16) NOT NULL ",
			"path" => "varchar(128) NOT NULL default '/web/disk4' ",
			"max_email" => "int(12) NOT NULL default '3' ",
			"max_ftp" => "int(12) NOT NULL default '3' ",
			"max_ssh" => "int(12) NOT NULL default '3' ",
			"quota" => "int(11) NOT NULL default '50' ",
			"bandwidth_per_month_mb" => "int(11) NOT NULL default '0' ",
			"id_client" => "int(4) NOT NULL default '0' ",
			"expire" => "date NOT NULL default '0000-00-00' ",
			"prod_id" => "int(11) NOT NULL default '0' ",
			"pass_next_req" => "varchar(128) NOT NULL default '0' ",
			"pass_expire" => "int(12) NOT NULL default '0' ",
			"allow_add_domain" => "enum('yes','no','check') NOT NULL default 'check' ",
			"nbrdb" => "int(9) NOT NULL default '1' ",
			"resseller_flag" => "enum('yes','no') NOT NULL default 'no' ",
			"ssh_login_flag" => "enum('yes','no') NOT NULL default 'no'",
			"ftp_login_flag" => "enum('yes','no') NOT NULL default 'yes'",
			"pkg_install_flag" => "enum('yes','no') NOT NULL default 'yes'",
			"ob_head" => "varchar(64) NOT NULL ",
			"ob_tail" => "varchar(64) NOT NULL ",
			"ob_next" => "varchar(64) NOT NULL ",
			"last_used_lang" => "varchar(32) NOT NULL default 'en_US.UTF-8'",
			"max_ssh" => "int(12) NOT NULL default '3' "
			),
		"primary" => "(adm_login)",
		"keys" => array(
			"adm_login" => "(adm_login)"
			),
		"index" => array(
			"adm_login_2" => "(adm_login)",
			"path" => "(path)",
			"id_clientindex" => "(id_client)"
			)
		),
	"backup" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"server_addr" => "varchar(128) NOT NULL ",
			"server_login" => "varchar(128) NOT NULL ",
			"server_pass" => "varchar(128) NOT NULL ",
			"type" => "enum('grant_access','mail_backup','dns_backup','backup_ftp_to','trigger_changes','trigger_mx_changes') NOT NULL default 'grant_access' ",
			"status" => "enum('pending','done') NOT NULL default 'pending' "
			),
		"primary" => "(id)",
		"keys" => array(
			"id_2" => "(id)",
			"id" => "(id)"
			)
		),
	"clients" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"is_company" => "enum('yes','no') NOT NULL default 'no' ",
			"company_name" => "varchar(64) NULL ",
			"vat_num" => "varchar(128) NOT NULL default '' ",
			"familyname" => "varchar(64) NOT NULL ",
			"christname" => "varchar(64) NOT NULL ",
			"addr1" => "varchar(100) NOT NULL ",
			"addr2" => "varchar(100) NULL ",
			"addr3" => "varchar(100) NULL ",
			"city" => "varchar(64) NOT NULL ",
			"zipcode" => "varchar(32) NOT NULL default '0' ",
			"state" => "varchar(32) NULL ",
			"country" => "char(2) NOT NULL ",
			"phone" => "varchar(20) NOT NULL default '0' ",
			"fax" => "varchar(20) NULL ",
			"email" => "varchar(255) NOT NULL ",
			"special_note" => "blob NULL ",
			"dollar" => "decimal(9,2) NOT NULL default '0.00' ",
			"disk_quota_mb" => "int(9) NOT NULL default '0' ",
			"bw_quota_per_month_gb" => "int(9) NOT NULL default '0' ",
			"expire" => "date NOT NULL default '0000-00-00' ",
			"active" => "enum('yes','no') NOT NULL default 'yes'"
			),
		"primary" => "(id)",
		"keys" => array(
			"id" => "(id)"
			)
		),
	"commande" => array(
		"vars" => array(
			"id" => "mediumint(9) NOT NULL auto_increment",
			"id_client" => "varchar(100) NOT NULL default '0' ",
			"domain_name" => "varchar(255) NOT NULL ",
			"quantity" => "varchar(10) NOT NULL ",
			"price" => "varchar(255) NOT NULL ",
			"paiement_method" => "enum('cb','cheque','wire','other','free') NOT NULL default 'cb' ",
			"date" => "date NOT NULL default '0000-00-00' ",
			"expir" => "date NOT NULL default '0000-00-00' ",
			"valid" => "varchar(16) NOT NULL default 'yes' ",
			"product_id" => "int(9) NOT NULL default '0' ",
			"payment_id" => "int(11) NOT NULL default '0' ",
			"price_devise" => "enum('EUR','USD') NOT NULL default 'EUR' "
			),
		"primary" => "(id)",
		"keys" => array(
			"id" => "(id)"
			),
		"index" => array(
			"id_2" => "(id)"
			)
		),
	"completedorders" => array(
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"id_client" => "int(12) NOT NULL default '0'",
			"domain_name" => "varchar(255) NOT NULL default ''",
			"quantity" => "int(12) NOT NULL default '0'",
			"date" => "date NOT NULL default '0000-00-00'",
			"product_id" => "int(12) NOT NULL default '0'",
			"payment_id" => "int(12) NOT NULL default '0'",
			"download_pass" => "varchar(64) NOT NULL default 'none'",
			"country_code" => "varchar(4) NOT NULL default 'US'",
			"last_expiry_date" => "date NOT NULL"
			),
		"primary" => "(id)"
		),
	"config" => array(
		"vars" => array(
			"db_version" => "int(11) NOT NULL default '10002' ",
			"unicrow" => "int(11) NOT NULL default '1' ",
			"demo_version" => "enum('yes','no') NOT NULL default 'no' ",
			"main_site_ip" => "varchar(16) NOT NULL default '127.0.0.1' ",
			"site_addrs" => "varchar(255) NOT NULL default '127.0.0.1|192.168.0.1' ",
			"use_multiple_ip" => "enum('yes','no') NOT NULL default 'yes' ",
			"use_cname_for_subdomains" => "enum('yes','no') NOT NULL default 'no' ",
			"addr_mail_server" => "varchar(255) NOT NULL default 'mx.example.com' ",
			"webmaster_email_addr" => "varchar(255) NOT NULL default 'postmaster@example.com' ",
			"addr_primary_dns" => "varchar(255) NOT NULL default 'ns1.example.com' ",
			"addr_secondary_dns" => "varchar(255) NOT NULL default 'ns2.example.com' ",
			"ip_slavezone_dns_server" => "varchar(16) NOT NULL default '192.168.0.3' ",
			"ip_allowed_dns_transfer" => "varchar(255) NOT NULL default '192.168.0.1' ",
			"default_zones_ttl" => "int(11) NOT NULL default '7200'",
			"domainkey_publickey_filepath" => "varchar(255) NULL default '/var/lib/dkfilter/public.key' ",
			"main_domain" => "varchar(128) NOT NULL default 'gplhost.com' ",
			"404_subdomain" => "varchar(128) NOT NULL default '404' ",
			"administrative_site" => "varchar(255) NOT NULL default 'dtc.example.com' ",
			"administrative_ssl_port" => "varchar(16) NOT NULL default '443'",
			"site_root_host_path" => "varchar(255) NOT NULL default '/var/www' ",
			"generated_file_path" => "varchar(255) NOT NULL default '/usr/share/dtc/etc' ",
			"dtcshared_path" => "varchar(255) NOT NULL default '/usr/share/dtc/shared' ",
			"dtcadmin_path" => "varchar(255) NOT NULL default '/usr/share/dtc/admin' ",
			"dtcclient_path" => "varchar(255) NOT NULL default '/usr/share/dtc/client' ",
			"dtcdoc_path" => "varchar(255) NOT NULL default '/usr/share/dtc/doc' ",
			"dtcemail_path" => "varchar(255) NOT NULL default '/usr/share/dtc/email' ",
			"htpasswd_path" => "varchar(255) NOT NULL default '/usr/sbin/htpasswd' ",
			"qmail_newu_path" => "varchar(255) NOT NULL default '/var/qmail/bin/qmail-newu'",
			"qmail_rcpthost_path" => "varchar(255) NOT NULL default 'rcpthosts' ",
			"qmail_virtualdomains_path" => "varchar(255) NOT NULL default 'virtualdomains' ",
			"qmail_assign_path" => "varchar(255) NOT NULL default 'assign' ",
			"qmail_poppasswd_path" => "varchar(255) NOT NULL default 'poppasswd' ",
			"apache_vhost_path" => "varchar(255) NOT NULL default 'vhosts.conf' ",
			"php_library_path" => "varchar(255) NOT NULL default '/usr/lib/php:/tmp:/var/lib/dtc/etc/dtc404' ",
			"php_additional_library_path" => "varchar(255) NOT NULL default '/usr/local/lib/php/phplib/' ",
			"named_path" => "varchar(255) NOT NULL default 'named.conf' ",
			"named_slavefile_path" => "varchar(255) NOT NULL default 'named.slavezones.conf' ",
			"named_slavezonefiles_path" => "varchar(255) NOT NULL default 'slave_zones' ",
			"named_zonefiles_path" => "varchar(255) NOT NULL default 'zones' ",
			"autogen_default_subdomains" => "enum('yes','no') NOT NULL default 'yes'",
			"autogen_subdomain_list" => "varchar(255) NOT NULL default 'pop|imap|mail|smtp|ftp'",
			"autogen_webmail_alias" => "enum('yes','no') NOT NULL default 'yes'",
			"autogen_webmail_type" => "enum('squirrelmail','roundcube') NOT NULL default 'squirrelmail'",
			"backup_script_path" => "varchar(255) NOT NULL default 'backup.bash' ",
			"bakcup_path" => "varchar(255) NOT NULL default '/mnt/backup' ",
			"webalizer_stats_script_path" => "varchar(255) NOT NULL default 'webalizer.bash' ",
			"use_javascript" => "enum('yes','no') NOT NULL default 'yes' ",
			"use_mail_alias_group" => "enum('yes','no') NOT NULL default 'yes'",
			"use_ssl" => "enum('yes','no') NOT NULL default 'no' ",
			"use_nated_vhost" => "enum('yes','no') NOT NULL default 'no' ",
			"nated_vhost_ip" => "varchar(16) NOT NULL default '192.168.0.2' ",
			"addr_backup_mail_server" => "varchar(255) NOT NULL ",
			"skin" => "varchar(128) NOT NULL default 'green' ",
			"mta_type" => "enum('qmail','postfix') NOT NULL default 'qmail' ",
			"domain_based_ftp_logins" => "enum('yes','no') NOT NULL default 'yes' ",
			"domain_based_ssh_logins" => "enum('yes','no') NOT NULL default 'yes' ",
			"chroot_path" => "varchar(255) NOT NULL default '/var/www/chroot' ",
			"hide_password" => "enum('yes','no') NOT NULL default 'no' ",
			"session_expir_minute" => "int(9) NOT NULL default '10' ",
			"dns_type" => "enum('bind','djb') NOT NULL default 'bind' ",
			"srs_user" => "varchar(128) NOT NULL ",
			"srs_live_key" => "varchar(255) NOT NULL ",
			"srs_test_key" => "varchar(255) NOT NULL ",
			"srs_enviro" => "enum('LIVE','TEST') NOT NULL default 'TEST' ",
			"srs_crypt" => "enum('DES','BLOWFISH') NOT NULL default 'DES' ",
			"use_registrar_api" => "enum('yes','no') NOT NULL default 'no'",
			"ftp_backup_host" => "varchar(255) NOT NULL default ''",
			"ftp_backup_login" => "varchar(255) NOT NULL default ''",
			"ftp_backup_pass" => "varchar(255) NOT NULL default ''",
			"ftp_backup_frequency" => "enum('day','week','month') NOT NULL default 'week'",
			"ftp_backup_activate" => "enum('yes','no') NOT NULL default 'no'",
			"ftp_backup_dest_folder" => "varchar(255) NOT NULL default '/'",
			"vps_renewal_before" => "varchar (64) NOT NULL default '5|10'",
			"vps_renewal_after" => "varchar (64) NOT NULL default '3|7'",
			"vps_renewal_lastwarning" => "varchar (64) NOT NULL default '12'",
			"vps_renewal_shutdown" => "varchar (64) NOT NULL default '15'",
			"shared_renewal_before" => "varchar (64) NOT NULL default '40|20|7'",
			"shared_renewal_after" => "varchar (64) NOT NULL default '15|7'",
			"shared_renewal_lastwarning" => "varchar (64) NOT NULL default '25'",
			"shared_renewal_shutdown" => "varchar (64) NOT NULL default '28'",
			"webalizer_country_graph" => "enum('yes','no') NOT NULL default 'no'",
			"apache_version" => "varchar (16) NOT NULL default '1'",
			"dtc_system_uid" => "varchar (16) NOT NULL default '65534'",
			"dtc_system_username" => "varchar (64) NOT NULL default 'dtc'",
			"dtc_system_gid" => "varchar (16) NOT NULL default '65534'",
			"dtc_system_groupname" => "varchar (64) NOT NULL default 'nogroup'",
			"selling_conditions_url" => "varchar (255) NOT NULL default 'none'",
			"user_mysql_prepend_admin_name" => "enum('yes','no') NOT NULL default 'no'",
			"user_mysql_type" => "enum('localhost','distant') NOT NULL default 'localhost'",
			"user_mysql_host" => "varchar (255) NOT NULL default 'localhost'",
			"user_mysql_root_login" => "varchar (255) NOT NULL default 'none'",
			"user_mysql_root_pass" => "varchar (255) NOT NULL default 'none'",
			"user_mysql_client" => "varchar (255) NOT NULL default '%'",
			"recipient_delimiter" => "varchar(4) NOT NULL default '\+'",
			"default_company_invoicing" => "int (12) NOT NULL default '0' ",
			"this_server_country_code" => "varchar (4) NOT NULL default 'US' ",
			"use_cyrus" => "enum('yes','no') NOT NULL default 'no' ",
			"use_amavis" => "enum('yes','no') NOT NULL default 'yes'",
			"use_clamav" => "enum('yes','no') NOT NULL default 'yes'",
			"use_advanced_lists_tunables" => "enum('yes','no') NOT NULL default 'no'",
			"use_webalizer" => "enum('yes','no') NOT NULL default 'yes'",
			"use_awstats" => "enum('yes','no') NOT NULL default 'no'",
			"use_visitors" => "enum('yes','no') NOT NULL default 'no'",
			"message_subject_header" => "varchar (255) NOT NULL default '[DTC]'",
			"apache_directoryindex" => "varchar (255) NOT NULL default 'index.php index.cgi index.pl index.htm index.html index.php4'",
			"named_soa_refresh" => "varchar (16) NOT NULL default '2H'",
			"named_soa_retry" => "varchar (16) NOT NULL default '60M'",
			"named_soa_expire" => "varchar (16) NOT NULL default '1W'",
			"named_soa_default_ttl" => "varchar (16) NOT NULL default '24H'",
			"provide_own_domain_hosts" => "enum('yes','no') NOT NULL default 'no'",
			"nagios_host" => "varchar(255) NOT NULL default ''",
			"nagios_username" => "varchar(255) NOT NULL default ''",
			"nagios_config_file_path" => "varchar(255) NOT NULL default ''",
			"nagios_restart_command" => "varchar(255) NOT NULL default 'sudo /etc/init.d/nagios2 restart'",
			"affiliate_return_domain" => "varchar(255) NOT NULL default 'www.example.com'",
			"support_ticket_email" => "varchar(255) NOT NULL default 'support'",
			"support_ticket_domain" => "varchar(255) NOT NULL default 'default'",
			"all_customers_list_email" => "varchar(255) NOT NULL default 'support'",
			"all_customers_list_domain" => "varchar(255) NOT NULL default 'default'"

			),
		"keys" => array(
			"unicrow" => "(unicrow)"
			)
		),
	"cron_job" => array(
		"vars" => array(
			"unicrow" => "int(11) NOT NULL default '1' ",
			"last_cronjob" => "timestamp(14) NULL ",
			"qmail_newu" => "enum('yes','no') NOT NULL default 'no' ",
			"restart_qmail" => "enum('yes','no') NOT NULL default 'no' ",
			"reload_named" => "enum('yes','no') NOT NULL default 'no' ",
			"restart_apache" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_vhosts" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_named" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_reverse" => "enum('yes','no') NOT NULL default 'no'",
			"gen_fetchmail" => "enum('yes','no') NOT NULL default 'no'",
			"gen_qmail" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_webalizer" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_backup" => "enum('yes','no') NOT NULL default 'no' ",
			"gen_ssh" => "enum('yes','no') NOT NULL default 'no' ",
			"lock_flag" => "enum('inprogress','finished') NOT NULL default 'finished' "
			),
		"keys" => array(
			"unicrow" => "(unicrow)"
			)
		),
	"dedicated" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"owner" => "varchar(64) NOT NULL ",
			"server_hostname" => "varchar(255) NOT NULL ",
			"start_date" => "date NOT NULL default '0000-00-00' ",
			"expire_date" => "date NOT NULL default '0000-00-00' ",
			"hddsize" => "int(9) NOT NULL default '1' ",
			"ramsize" => "int(9) NOT NULL default '48' ",
			"bandwidth_per_month_gb" => "int(9) NOT NULL default '10'",
			"product_id" => "int(9) NOT NULL default '0' ",
			"operatingsystem" => "varchar(64) NOT NULL default 'debian' ",
			"country_code" => "varchar(4) NOT NULL default 'US' "
			),
		"primary" => "(id)",
		"keys" => array(
			"server_hostname" => "(server_hostname)"
			)
		),
	"dedicated_ip" => array(
		"vars" => array (
			"id" => "int(11) NOT NULL auto_increment",
			"dedicated_server_hostname" => "varchar(255) NOT NULL default ''",
			"ip_addr" => "varchar(16) NOT NULL default ''",
			"available" => "enum('yes','no') NOT NULL default 'yes'",
			"rdns_addr" => "varchar(255) NOT NULL default 'gplhost.com'",
			"rdns_regen" => "enum('yes','no') NOT NULL default 'yes'",
			"ip_pool_id" => "int(11) NOT NULL default '0'"
			),
		"primary" => "(id)",
		"unique" => array(
				"ip_addr" => "(ip_addr)"
                        )
		),
	"domain" => array(
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"name" => "varchar(64) NOT NULL ",
			"safe_mode" => "enum('yes','no') default 'yes' ",
			"sbox_protect" => "enum('yes','no') default 'yes' ",
			"owner" => "varchar(64) NOT NULL ",
			"default_subdomain" => "varchar(64) NULL default 'www' ",
			"default_sub_server_alias" => "enum('yes','no') default 'yes'",
			"generate_flag" => "enum('yes','no') NOT NULL default 'yes' ",
			"quota" => "bigint(20) NOT NULL default '50' ",
			"max_email" => "int(11) NOT NULL default '9' ",
			"max_lists" => "int(11) NOT NULL default '3' ",
			"max_ftp" => "int(11) NOT NULL default '3' ",
			"max_ssh" => "int(11) NOT NULL default '3' ",
			"max_subdomain" => "int(11) NOT NULL default '5' ",
			"ip_addr" => "varchar(16) NOT NULL default '127.0.0.1' ",
			"backup_ip_addr" => "varchar(16) NULL ",
			"primary_dns" => "varchar(255) NOT NULL default 'default' ",
			"other_dns" => "varchar(255) NOT NULL default 'default' ",
			"primary_mx" => "varchar(255) NOT NULL default 'default' ",
			"other_mx" => "varchar(255) NOT NULL default 'default' ",
			"whois" => "enum('here','away','linked') NOT NULL default 'away' ",
			"hosting" => "enum('here','away') NOT NULL default 'here' ",
			"du_stat" => "bigint(20) NOT NULL default '0' ",
			"gen_unresolved_domain_alias" => "enum('yes','no') NOT NULL default 'no' ",
			"txt_root_entry" => "varchar(128) NOT NULL default 'GPLHost:>_ Opensource hosting worldwide' ",
			"txt_root_entry2" => "varchar(128) NOT NULL default 'This domain is hosted using Domain Technologie Control http://www.gplhost.com/software-dtc.html' ",
			"catchall_email" => "varchar(128) NOT NULL ",
			"domain_parking" => "varchar(255) NOT NULL default 'no-parking' ",
			"domain_parking_type" => "enum('redirect','same_docroot','serveralias') NOT NULL default 'redirect'",
			"registrar_password" => "varchar(255) NOT NULL ",
			"ttl" => "int NULL default '7200' ",
			"stats_login" => "varchar(32) NOT NULL default ''",
  			"stats_pass" => "varchar(16) NOT NULL default ''",
  			"stats_subdomain" => " enum('yes','no') NOT NULL default 'no'",
  			"wildcard_dns" => "enum('yes','no') NOT NULL default 'no'"
			),
		"primary" => "(id)",
		"keys" => array(
			"name" => "(name)"
			),
		"index" => array(
			"owner_index" => "(owner)"
			)
		),
	"email_accounting" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"domain_name" => "varchar(128) NOT NULL ",
			"smtp_trafic" => "int(14) unsigned NOT NULL default '0' ",
			"imap_trafic" => "int(14) unsigned NOT NULL default '0' ",
			"pop_trafic" => "int(14) unsigned NOT NULL default '0' ",
			"month" => "int(2) NOT NULL default '0' ",
			"year" => "int(4) NOT NULL default '0' "
			),
		"keys" => array(
			"domain_name" => "(domain_name,month,year)",
			"id" => "(id)"
			),
		"index" => array(
			"overall_index" => "(domain_name,month,year)"
			)
		),
	"fetchmail" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"domain_user" => "varchar(64) NOT NULL ",
			"domain_name" => "varchar(128) NOT NULL ",
			"pop3_email" => "varchar(64) NOT NULL ",
			"pop3_server" => "varchar(128) NOT NULL ",
			"pop3_login" => "varchar(128) NOT NULL ",
			"pop3_pass" => "varchar(128) NOT NULL ",
			"checkit" => "enum('yes','no') NOT NULL default 'yes' ",
			"autodel" => "enum('0','1','2','3','7','14','21') NOT NULL default '7' ",
			"mailbox_type" => "enum('POP3','IMAP4','MSN','HOTMAIL','YAHOO','GMAIL') NOT NULL default 'POP3' "
			),
		"primary" => "(id)",
		"keys" => array(
			"domain_user" => "(domain_user,domain_name,pop3_server,pop3_login)",
			"pop3_email" => "(pop3_email)"
			)
		),
	"ftp_access" => array(
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"login" => "varchar(50) NOT NULL ",
			"uid" => "int(5) NOT NULL default '65534' ",
			"gid" => "int(5) NOT NULL default '65534' ",
			"password" => "varchar(50) NOT NULL default 'passwd' ",
			"homedir" => "varchar(255) NOT NULL ",
			"count" => "int(11) NULL default '0' ",
			"fhost" => "varchar(50) NULL ",
			"faddr" => "varchar(15) NULL ",
			"ftime" => "timestamp(14) NULL ",
			"fcdir" => "varchar(150) NULL ",
			"fstor" => "int(11) NULL default '0' ",
			"fretr" => "int(11) NULL default '0' ",
			"bstor" => "int(11) NULL default '0' ",
			"bretr" => "int(11) NULL default '0' ",
			"creation" => "datetime NULL ",
			"ts" => "timestamp(14) NULL default '00000000000000' ",
			"frate" => "int(11) NULL default '5' ",
			"fcred" => "int(2) NULL default '15' ",
			"brate" => "int(11) NULL default '5' ",
			"bcred" => "int(2) NULL default '1' ",
			"flogs" => "int(11) NULL default '0' ",
			"size" => "int(11) NOT NULL default '0' ",
			"shell" => "varchar(64) NOT NULL default '/bin/bash' ",
			"hostname" => "varchar(64) NOT NULL default 'anotherlight.com' ",
			"vhostip" => "varchar(16) NOT NULL default '0.0.0.0' ",
			"login_count" => "int(11) NOT NULL default '0' ",
			"last_login" => "datetime NOT NULL default '0000-00-00 00:00:00' ",
			"dl_bytes" => "int(14) NOT NULL default '0' ",
			"ul_bytes" => "int(14) NOT NULL default '0' ",
			"dl_count" => "int(14) NOT NULL default '0' ",
			"ul_count" => "int(14) NOT NULL default '0' "
			),
		"keys" => array(
			"login" => "(login)"
			),
		"primary" => "(id)",
		"index" => array(
			"hostname" => "(hostname)"
			)
		),
	"ssh_access" => array(
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"login" => "varchar(50) NOT NULL ",
			"uid" => "int(5) NOT NULL default '65534' ",
			"gid" => "int(5) NOT NULL default '65534' ",
			"crypt" => "varchar(50) NOT NULL default '' ",
			"password" => "varchar(50) NOT NULL default 'passwd' ",
			"homedir" => "varchar(255) NOT NULL ",
			"count" => "int(11) NULL default '0' ",
			"fhost" => "varchar(50) NULL ",
			"faddr" => "varchar(15) NULL ",
			"ftime" => "timestamp(14) NULL ",
			"fcdir" => "varchar(150) NULL ",
			"fstor" => "int(11) NULL default '0' ",
			"fretr" => "int(11) NULL default '0' ",
			"bstor" => "int(11) NULL default '0' ",
			"bretr" => "int(11) NULL default '0' ",
			"creation" => "datetime NULL ",
			"ts" => "timestamp(14) NULL default '00000000000000' ",
			"frate" => "int(11) NULL default '5' ",
			"fcred" => "int(2) NULL default '15' ",
			"brate" => "int(11) NULL default '5' ",
			"bcred" => "int(2) NULL default '1' ",
			"flogs" => "int(11) NULL default '0' ",
			"size" => "int(11) NOT NULL default '0' ",
			"shell" => "varchar(64) NOT NULL default '/bin/dtc-chroot-shell' ",
			"hostname" => "varchar(64) NOT NULL default 'anotherlight.com' ",
			"vhostip" => "varchar(16) NOT NULL default '0.0.0.0' ",
			"login_count" => "int(11) NOT NULL default '0' ",
			"last_login" => "datetime NOT NULL default '0000-00-00 00:00:00' ",
			"dl_bytes" => "int(14) NOT NULL default '0' ",
			"ul_bytes" => "int(14) NOT NULL default '0' ",
			"dl_count" => "int(14) NOT NULL default '0' ",
			"ul_count" => "int(14) NOT NULL default '0' "
			),
		"keys" => array(
			"login" => "(login)"
			),
		"primary" => "(id)",
		"index" => array(
			"hostname" => "(hostname)"
			)
		),
	"ssh_groups" => array(
		"vars" => array(
			"group_id" => "int(11) NOT NULL auto_increment",
			"group_name" => "varchar(30) NOT NULL default ''",
			"status" => "char(1) default 'A'",
			"group_password" => "varchar(64) NOT NULL default 'x'",
			"gid" => "int(11) NOT NULL default '0'"
			),
		"primary" => "(group_id)",
		"keys" => array(
			"group_name_gid" => "(group_name,gid)",
			"group_gid" => "(gid)"
			),
		"index" => array(
			"gid" => "(gid)"
			)
		),
	"ssh_user_group" => array(
		"vars" => array(
			"user_id" => "int(11) NOT NULL default '0'",
			"group_id" => "int(11) NOT NULL default '0'"
			)
		),
	"ftp_accounting" => array(
		"vars" => array(
			"id" => "int(14) NOT NULL auto_increment",
			"sub_domain" => "varchar(50) NOT NULL ",
			"transfer" => "int(14) unsigned NOT NULL default '0' ",
			"last_run" => "int(14) NOT NULL default '0' ",
			"month" => "int(4) NOT NULL default '0' ",
			"year" => "int(4) NOT NULL default '0' ",
			"hits" => "int(14) NOT NULL default '0' "
			),
		"primary" => "(id)",
		"keys" => array(
			"sub_domain" => "(sub_domain,month,year)"
			)
		),
	"ftp_logs" => array(
		"vars" => array(
			"username" => "tinytext NULL ",
			"filename" => "text NULL ",
			"size" => "bigint(20) NULL ",
			"host" => "tinytext NULL ",
			"ip" => "tinytext NULL ",
			"command" => "tinytext NULL ",
			"command_time" => "tinytext NULL ",
			"local_time" => "datetime NULL ",
			"success" => "char(1) NULL ",
			"ui" => "bigint(20) NOT NULL auto_increment"
			),
		"primary" => "(ui)"
		),
	"groups" => array(
		"vars" => array(
			"gid" => "int(11) NOT NULL default '65534' ",
			"groupname" => "varchar(255) NOT NULL default 'nogroup' ",
			"members" => "varchar(255) NOT NULL default 'zigo' "
			),
		),
	"handle" => array(
		"vars" => array(
			"id" => "int(16) NOT NULL auto_increment",
			"name" => "varchar(32) NOT NULL ",
			"owner" => "varchar(64) NOT NULL ",
			"company" => "varchar(64) NULL ",
			"firstname" => "varchar(64) NOT NULL ",
			"lastname" => "varchar(64) NOT NULL ",
			"addr1" => "varchar(100) NOT NULL ",
			"addr2" => "varchar(100) NULL ",
			"addr3" => "varchar(100) NULL ",
			"city" => "varchar(64) NOT NULL ",
			"state" => "varchar(32) NULL ",
			"country" => "char(2) NOT NULL ",
			"zipcode" => "varchar(32) NOT NULL ",
			"phone_num" => "varchar(20) NOT NULL ",
			"fax_num" => "varchar(20) NULL ",
			"email" => "varchar(255) NOT NULL "
			),
		"primary" => "(id)",
		"keys" => array(
			"name" => "(name,owner)"
			)
		),
	"http_accounting" => array(
		"vars" => array(
			"id" => "int(14) NOT NULL auto_increment",
			"vhost" => "varchar(50) NOT NULL ",
			"bytes_sent" => "bigint(14) unsigned NOT NULL default '0' ",
			"bytes_receive" => "bigint(14) unsigned NOT NULL default '0' ",
			"count_hosts" => "int(12) NOT NULL default '0' ",
			"count_visits" => "int(12) NOT NULL default '0' ",
			"count_status_200" => "int(12) NOT NULL default '0' ",
			"count_status_404" => "int(12) NOT NULL default '0' ",
			"count_impressions" => "int(18) NOT NULL default '0' ",
			"last_run" => "int(14) NOT NULL default '0' ",
			"month" => "int(4) NOT NULL default '0' ",
			"year" => "int(4) NOT NULL default '0' ",
			"domain" => "varchar(50) NOT NULL "
			),
		"primary" => "(id)",
                "unique" => array(
                	"vhost" => "(vhost,month,year,domain)"
			)
		),
	"ip_pool" => array (
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"location" => "varchar(255) NOT NULL default ''",
			"ip_addr" => "varchar(16) NOT NULL default ''",
			"netmask" => "varchar(16) NOT NULL default ''",
			"gateway" => "varchar(16) NOT NULL default ''",
			"broadcast" => "varchar(16) NOT NULL default ''",
			"dns" => "varchar(16) NOT NULL default ''",
			"zone_type" => "enum('support_ticket','ip_per_ip','ip_per_ip_cidr','one_zonefile') default 'one_zonefile'",
			"custom_part" => "text NOT NULL"
			),
		"primary" => "(id)",
		"unique" => array(
			"ip_addr" => "(ip_addr)"
			)
		),
	"ip_port_service" => array(
                "vars" => array(
                        "id" => "int(11) NOT NULL auto_increment",
                        "ip" => "varchar(16) NOT NULL ",
                        "port" => "varchar(16) NOT NULL ",
                        "service" => "varchar(64) NOT NULL "
                        ),
                "primary" => "(id)"
                ),
	"mailinglist" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"domain" => "varchar(128) NOT NULL ",
			"name" => "varchar(32) NOT NULL ",
			"owner" => "varchar(255) NOT NULL ",
			"spammode" => "enum('yes', 'no') NOT NULL default 'no'",
			"webarchive" => "enum('yes','no') NOT NULL default 'no'"
			),
		"primary" => "(id)"
		),
	"nameservers" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"owner" => "varchar(64) NOT NULL ",
			"domain_name" => "varchar(128) NOT NULL ",
			"subdomain" => "varchar(128) NOT NULL ",
			"ip" => "varchar(16) NOT NULL "
			),
		"primary" => "(id)",
		"keys" => array(
			"domain_name" => "(domain_name,subdomain)"
			)
		),
	"nas" => array(
		"vars" => array(
			"id" => "int(10) NOT NULL auto_increment",
			"nasname" => "varchar(128) NOT NULL ",
			"shortname" => "varchar(32) NULL ",
			"type" => "varchar(30) NULL default 'other' ",
			"ports" => "int(5) NULL ",
			"secret" => "varchar(60) NOT NULL default 'secret' ",
			"community" => "varchar(50) NULL ",
			"description" => "varchar(200) NULL default 'RADIUS Client' "
			),
		"primary" => "(id)",
		"index" => array(
			"nasname" => "(nasname)"
			)
		),
	"new_admin" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"reqadm_login" => "varchar(64) NOT NULL ",
			"reqadm_pass" => "varchar(16) NOT NULL ",
			"domain_name" => "varchar(64) NOT NULL ",
			"family_name" => "varchar(64) NOT NULL ",
			"first_name" => "varchar(64) NOT NULL ",
			"comp_name" => "varchar(64) NOT NULL ",
			"iscomp" => "enum('yes','no') NOT NULL default 'yes' ",
			"vat_num" => "varchar(128) NOT NULL default '' ",
			"email" => "varchar(255) NOT NULL ",
			"phone" => "varchar(20) NOT NULL ",
			"fax" => "varchar(20) NOT NULL ",
			"addr1" => "varchar(100) NOT NULL ",
			"addr2" => "varchar(100) NOT NULL ",
			"addr3" => "varchar(100) NOT NULL ",
			"zipcode" => "varchar(32) NOT NULL ",
			"city" => "varchar(64) NOT NULL ",
			"state" => "varchar(32) NOT NULL ",
			"country" => "char(2) NOT NULL ",
			"paiement_id" => "int(9) NOT NULL default '0' ",
			"product_id" => "int(9) NOT NULL default '0' ",
			"custom_notes" => "text NOT NULL",
			"vps_location" => "varchar(255) NOT NULL default ''",
			"vps_os" => "varchar(255) NOT NULL default ''",
			"shopper_ip" => "varchar(16) NOT NULL default ''",
			"date" => "date NOT NULL default '0000-00-00'",
			"time" => "time NOT NULL default '00:00:00'",
			"maxmind_output" => "text NOT NULL",
			"last_used_lang" => "varchar(32) NOT NULL default 'en_US.UTF-8'",
			"add_service" => "enum('yes','no') NOT NULL default 'no'"
			),
		"primary" => "(id)"
		),
	"paiement" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"id_client" => "int(11) NOT NULL default '0' ",
			"id_command" => "int(11) NOT NULL default '0' ",
			"label" => "varchar(255) NOT NULL default '0' ",
			"currency" => "enum('EUR','USD') NOT NULL default 'USD' ",
			"refund_amount" => "decimal(9,2) NOT NULL default '0.00' ",
			"paiement_cost" => "decimal(9,2) NOT NULL default '0.00' ",
			"paiement_total" => "decimal(9,2) NOT NULL default '0.00' ",
			"paiement_type" => "enum('online','cheque','wire','other','free') NOT NULL default 'online' ",
			"secpay_site" => "enum('none','paypal','worldpay','enets') NOT NULL default 'none' ",
			"secpay_custom_id" => "int(11) NOT NULL default '0' ",
			"shopper_ip" => "varchar(16) NOT NULL default '0.0.0.0' ",
			"date" => "date NOT NULL default '0000-00-00' ",
			"valid" => "enum('yes','no','pending') NOT NULL default 'no' ",
			"pending_reason" => "varchar(128) NOT NULL default ''",
			"time" => "time NOT NULL default '00:00:00' ",
			"valid_date" => "date NOT NULL default '0000-00-00' ",
			"valid_time" => "time NOT NULL default '00:00:00' ",
			"new_account" => "enum('yes','no') NOT NULL default 'no' ",
			"product_id" => "int(11) NOT NULL default '0'",
			"vat_rate" => "decimal(9,2) NOT NULL default '0.00'",
			"vat_total" => "decimal(9,2) NOT NULL default '0'",
			"hash_check_key" => "varchar(255) NOT NULL default '0'",
			),
		"primary" => "(id)",
		"keys" => array(
			"id" => "(id)"
			)
		),
	"pending_queries" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"adm_login" => "varchar(64) NOT NULL ",
			"domain_name" => "varchar(128) NOT NULL ",
			"date" => "varchar(16) NOT NULL default '0000-00-00 00:00' "
			),
		"primary" => "(id)"
		),
	"pending_renewal" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"adm_login" => "varchar(64) NOT NULL ",
			"renew_date" => "date NOT NULL default '0000-00-00' ",
			"renew_time" => "time NOT NULL default '00:00:00' ",
			"product_id" => "int(11) NOT NULL default '0' ",
			"renew_id" => "int(11) NOT NULL default '0' ",
			"heb_type" => "enum('shared','ssl','vps','server','ssl_renew') NOT NULL default 'shared' ",
			"pay_id" => "int(11) NOT NULL default '0' ",
			"country_code" => "varchar(4) NOT NULL default 'US' "
			),
		"primary" => "(id)"
		),
	"pop_access" => array(
		"vars" => array(
			"autoinc" => "int(12) NOT NULL auto_increment",
			"id" => "varchar(32) NOT NULL ",
			"uid" => "int(11) NOT NULL default '65534' ",
			"gid" => "int(11) NOT NULL default '65534' ",
			"home" => "varchar(255) NOT NULL ",
			"shell" => "varchar(255) NOT NULL ",
			"mbox_host" => "varchar(120) NOT NULL ",
			"crypt" => "varchar(255) NOT NULL ",
			"passwd" => "varchar(255) NOT NULL ",
			"active" => "int(11) NOT NULL default '1' ",
			"start_date" => "date NOT NULL default '0000-00-00' ",
			"expire_date" => "date NOT NULL default '0000-00-00' ",
			"quota_size" => "int(11) NOT NULL default '0' ",
			"quota_files" => "int(11) NOT NULL default '0' ",
			"quota_couriermaildrop" => "varchar(255) NOT NULL default '500000000S,1000C' ",
			"type" => "varchar(20) NOT NULL default 'default' ",
			"memo" => "text NULL ",
			"du" => "bigint(20) NOT NULL default '0' ",
			"another_perso" => "varchar(5) NOT NULL default 'no' ",
			"redirect1" => "varchar(255) NULL ",
			"redirect2" => "varchar(255) NULL ",
			"localdeliver" => "varchar(10) NOT NULL default 'yes' ",
			"pop3_transfered_bytes" => "int(14) NOT NULL default '0' ",
			"pop3_login_count" => "int(9) NOT NULL default '0' ",
			"last_login" => "int(14) NOT NULL default '0' ",
			"imap_login_count" => "int(9) NOT NULL default '0' ",
			"imap_transfered_bytes" => "int(14) NOT NULL default '0' ",
			"iwall_protect" => "enum('yes','no') NOT NULL default 'no' ",
			"bounce_msg" => "text NOT NULL ",
			"spf_protect" => "enum('yes','no') NOT NULL default 'no' ",
			"clamav_protect" => "enum('yes','no') NOT NULL default 'no' ",
			"pass_next_req" => "varchar(128) NOT NULL ",
			"pass_expire" => "int(12) NOT NULL default '0' ",
			"fullemail" => "varchar(255) NOT NULL default 'none' ",
			"spam_mailbox_enable" => "enum('yes','no') NOT NULL default 'no' ",
			"spam_mailbox" => "varchar(255) NOT NULL default 'SPAM' ",
			"vacation_flag" => "enum('yes','no') default 'no' ",
			"vacation_text" => "text NOT NULL "
			),
		"primary" => "(autoinc)",
		"unique" => array(
			"id" => "(id,mbox_host)"
			)
		),
	"product" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"price_dollar" => "varchar(9) NOT NULL ",
			"price_euro" => "varchar(9) NOT NULL ",
			"setup_fee" => "decimal(15,2) NOT NULL default '0.00'",
			"name" => "varchar(255) NOT NULL ",
			"quota_disk" => "int(9) NOT NULL default '0' ",
			"memory_size" => "int(9) NOT NULL default '48' ",
			"nbr_email" => "int(9) NOT NULL default '0' ",
			"nbr_database" => "int(9) NOT NULL default '0' ",
			"bandwidth" => "int(15) NOT NULL default '0' ",
			"period" => "varchar(12) NOT NULL default '0001-00-00' ",
			"allow_add_domain" => "enum('yes','no','check') NOT NULL default 'no' ",
			"heb_type" => "enum('shared','ssl','vps','server') NOT NULL default 'shared' ",
			"renew_prod_id" => "int(11) NOT NULL default '0'",
			"affiliate_kickback" => "varchar(9) NOT NULL default ''",
			"private" => "enum('yes','no') NOT NULL default 'no'"
			),
		"primary" => "(id)",
		"keys" => array(
			"id" => "(id)"
			)
		),
	"radacct" => array(
		"vars" => array(
			"RadAcctId" => "bigint(21) NOT NULL auto_increment",
			"AcctSessionId" => "varchar(32) NOT NULL ",
			"AcctUniqueId" => "varchar(32) NOT NULL ",
			"UserName" => "varchar(64) NOT NULL ",
			"Realm" => "varchar(64) NULL ",
			"NASIPAddress" => "varchar(15) NOT NULL ",
			"NASPortId" => "int(12) NULL ",
			"NASPortType" => "varchar(32) NULL ",
			"AcctStartTime" => "datetime NOT NULL default '0000-00-00 00:00:00' ",
			"AcctStopTime" => "datetime NOT NULL default '0000-00-00 00:00:00' ",
			"AcctSessionTime" => "int(12) NULL ",
			"AcctAuthentic" => "varchar(32) NULL ",
			"ConnectInfo_start" => "varchar(32) NULL ",
			"ConnectInfo_stop" => "varchar(32) NULL ",
			"AcctInputOctets" => "bigint(12) NULL ",
			"AcctOutputOctets" => "bigint(12) NULL ",
			"CalledStationId" => "varchar(50) NOT NULL ",
			"CallingStationId" => "varchar(50) NOT NULL ",
			"AcctTerminateCause" => "varchar(32) NOT NULL ",
			"ServiceType" => "varchar(32) NULL ",
			"FramedProtocol" => "varchar(32) NULL ",
			"FramedIPAddress" => "varchar(15) NOT NULL ",
			"AcctStartDelay" => "int(12) NULL ",
			"AcctStopDelay" => "int(12) NULL "
			),
		"primary" => "(RadAcctId)",
		"index" => array(
			"UserName" => "(UserName)",
			"FramedIPAddress" => "(FramedIPAddress)",
			"AcctSessionId" => "(AcctSessionId)",
			"AcctUniqueId" => "(AcctUniqueId)",
			"AcctStartTime" => "(AcctStartTime)",
			"AcctStopTime" => "(AcctStopTime)",
			"NASIPAddress" => "(NASIPAddress)"
			)
		),
	"radcheck" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"UserName" => "varchar(64) NOT NULL ",
			"Attribute" => "varchar(32) NOT NULL ",
			"op" => "char(2) NOT NULL default '==' ",
			"Value" => "varchar(253) NOT NULL "
			),
		"primary" => "(id)",
		"index" => array(
			"UserName" => "(UserName)"
			)
		),
	"radgroupcheck" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"GroupName" => "varchar(64) NOT NULL ",
			"Attribute" => "varchar(32) NOT NULL ",
			"op" => "char(2) NOT NULL default '==' ",
			"Value" => "varchar(253) NOT NULL "
			),
		"primary" => "(id)",
		"index" => array(
			"GroupName" => "(GroupName)"
			)
		),
	"radgroupreply" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"GroupName" => "varchar(64) NOT NULL ",
			"Attribute" => "varchar(32) NOT NULL ",
			"op" => "char(2) NOT NULL default '=' ",
			"Value" => "varchar(253) NOT NULL ",
			"prio" => "int(10) unsigned NOT NULL default '0' "
			),
		"primary" => "(id)",
		"index" => array(
			"GroupName" => "(GroupName)"
			)
		),
	"radpostauth" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"user" => "varchar(64) NOT NULL ",
			"pass" => "varchar(64) NOT NULL ",
			"reply" => "varchar(32) NOT NULL ",
			"date" => "timestamp(14) NULL "
			),
		"primary" => "(id)"
		),
	"radreply" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"UserName" => "varchar(64) NOT NULL ",
			"Attribute" => "varchar(32) NOT NULL ",
			"op" => "char(2) NOT NULL default '=' ",
			"Value" => "varchar(253) NOT NULL "
			),
		"primary" => "(id)",
		"index" => array(
			"UserName" => "(UserName)"
			)
		),
	"scheduled_updates" => array(
		"vars" => array(
			"backup_id" => "int(9) NOT NULL default '0' ",
			"timestamp" => "int(12) NOT NULL default '0' "
			),
		),
	"secpayconf" => array(
		"vars" => array(
			"unicrow" => "int(2) NOT NULL default '0' ",
			"currency_symbol" => "varchar(16) NOT NULL default '$'",
			"currency_letters" => "varchar(16) NOT NULL default 'USD'",

			"use_paypal" => "enum('yes','no') NOT NULL default 'no' ",
			"paypal_rate" => "float(6,2) NOT NULL default '0.00' ",
			"paypal_flat" => "float(6,2) NOT NULL default '0.00' ",
			"paypal_autovalidate" => "enum('yes','no') NOT NULL default 'yes' ",
			"paypal_email" => "varchar(128) NOT NULL default 'palpay@gplhost.com' ",
			"paypal_sandbox" => "enum('yes','no') NOT NULL default 'no' ",
			"paypal_sandbox_email" => "varchar(255) NOT NULL ",
			"paypal_validate_with" => "enum('total','mc_gross') NOT NULL default 'total'",
			"use_paypal_recurring" => "enum('yes','no') NOT NULL default 'no' ",

			"use_moneybookers" => "enum('yes','no') NOT NULL default 'no'",
			"moneybookers_rate" => "float(6,2) NOT NULL default '0.00'",
			"moneybookers_flat" => "float(6,2) NOT NULL default '0.00'",
			"moneybookers_autovalidate" => "enum('yes','no') NOT NULL default 'yes'",
			"moneybookers_email" => "varchar(128) NOT NULL default 'palpay@gplhost.com'",
			"moneybookers_sandbox" => "enum('yes','no') NOT NULL default 'no'",
			"moneybookers_sandbox_email" => "varchar(128) NOT NULL default ''",
			"moneybookers_validate_with" => "enum('total','mc_gross') NOT NULL default 'total'",
			"moneybookers_secret_word" => "varchar(128) NOT NULL default ''",

			"use_enets" => "enum('yes','no') NOT NULL default 'no'",
			"use_enets_test" => "enum('yes','no') NOT NULL default 'yes'",
			"enets_mid_id" => "varchar(255) NOT NULL default ''",
			"enets_test_mid_id" => "varchar(255) NOT NULL default ''",
			"enets_rate" => "float(6,2) NOT NULL default '0.00'",
			"use_maxmind" => "enum('yes','no') NOT NULL default 'no'",

			"maxmind_login" => "varchar(255) NOT NULL default ''",
			"maxmind_license_key" => "varchar(255) NOT NULL default ''",

			"use_webmoney" => "enum('yes','no') NOT NULL default 'no'",
			"webmoney_license_key" => "varchar(255) NOT NULL default ''",
			"webmoney_wmz" => "varchar(255) NOT NULL default ''",

			"accept_cheques" => "enum('yes','no') NOT NULL default 'no'",
			"cheques_flat_fees" => "float(6,2) NOT NULL default '0.00' ",
			"cheques_to_label" => "varchar(255) NOT NULL default ''",
			"cheques_send_address" => "text NOT NULL default ''",

			"accept_wiretransfers" => "enum('yes','no') NOT NULL default 'no'",
			"wiretransfers_flat_fees" => "float(6,2) NOT NULL default '0.00' ",
			"wiretransfers_bank_details" => "text NOT NULL default ''"
			),
		"keys" => array(
			"unicrow" => "(unicrow)"
			)
		),
	"smtp_logs" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"newmsg_id" => "bigint(20) NULL ",
			"bounce_qp" => "int(11) NULL ",
			"bytes" => "int(11) NOT NULL default '0' ",
			"sender_user" => "varchar(128) NOT NULL ",
			"sender_domain" => "varchar(128) NOT NULL ",
			"delivery_id" => "bigint(20) NULL ",
			"delivery_user" => "varchar(128) NOT NULL ",
			"delivery_domain" => "varchar(128) NOT NULL ",
			"delivery_success" => "enum('yes','no') NOT NULL default 'no' ",
			"time_stamp" => "int(14) NULL ",
			"msg_id_text" => "varchar(128) NOT NULL ",
			"delivery_id_text" => "varchar(128) NOT NULL "
			),
		"primary" => "(id)",
		"unique" => array(
			"delivery_id_text" => "(delivery_id_text)"
			),
		"keys" => array(
			"bounce_qp" => "(bounce_qp)",
			"newmsg_id" => "(newmsg_id)"
			)
		),
	"subdomain" => array(
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"safe_mode" => "enum ('yes','no') default 'yes' ",
			"sbox_protect" => "enum('yes','no') default 'yes' ",
			"domain_name" => "varchar(64) NOT NULL ",
			"subdomain_name" => "varchar(64) NOT NULL ",
			"path" => "varchar(64) NOT NULL ",
			"webalizer_generate" => "varchar(8) NOT NULL default 'no' ",
			"ip" => "varchar(255) NOT NULL default 'default' ",
			"register_globals" => "enum('yes','no') NOT NULL default 'no' ",
			"login" => "varchar(16) NULL ",
			"pass" => "varchar(64) NULL ",
			"w3_alias" => "enum('yes','no') NOT NULL default 'no' ",
			"associated_txt_record" => "varchar(128) NOT NULL ",
			"generate_vhost" => "enum('yes','no') NOT NULL default 'yes' ",
			"nameserver_for" => "varchar(64) NULL ",
			"srv_record" => "varchar(64) NULL ",
			"ttl" => "int(11) NULL default '7200' ",
			"ssl_ip" => "varchar(16) NOT NULL default 'none'",
			"add_default_charset" => "varchar(32) NOT NULL default 'dtc-wont-add'",
			"customize_vhost" => "text NOT NULL"
			),
		"primary" => "(id)",
		"keys" => array(
			"unic_subdomain" => "(domain_name,subdomain_name)",
			"login" => "(login)"
			),
		"index" => array(
			"domain_name_index" => "(domain_name)"
			)
		),
	"ssl_ips" => array (
		"vars" => array(
			"id" => "int(12) NOT NULL auto_increment",
			"ip_addr" => "varchar(16) NOT NULL default ''",
			"port" => "varchar(5) NOT NULL default ''",
			"adm_login" => "varchar(64) NOT NULL default ''",
			"available" => "enum('yes','no') NOT NULL default 'yes'",
			"expire" => "date NOT NULL default '0000-00-00'",
			),
		"primary" => "(id)",
		"keys" => array(
			"p_addr" => "(ip_addr)"
			),
		),
	"tik_admins" => array (
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"pseudo" => "varchar(64) NOT NULL default ''",
			"realname" => "varchar(64) NOT NULL default ''",
			"email" => "varchar(128) NOT NULL default ''",
			"available" => "enum('yes','no') NOT NULL default 'yes'",
			"tikadm_pass" => "varchar(255) NOT NULL default ''",
			"pass_next_req" => "varchar(128) NOT NULL default '0'",
			"pass_expire" => "int(12) NOT NULL default '0'"
			),
		"primary" => "(id)",
		"keys" => array(
			"pseudo" => "(pseudo)"
			)
		),
	"tik_queries" => array (
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"adm_login" => "varchar(64) NOT NULL default ''",
			"date" => "date NOT NULL default '0000-00-00'",
			"time" => "time NOT NULL default '00:00:00'",
			"in_reply_of_id" => "int(11) NOT NULL default '0'",
			"got_reply" => "enum('yes','no') NOT NULL default 'no'",
			"reply_id" => "int(11) NOT NULL default '0'",
			"admin_or_user" => "enum('admin','user') NOT NULL default 'user'",
			"subject" => "varchar(255) NOT NULL default ''",
			"text" => "text",
			"cat_id" => "int(11) NOT NULL default '0'",
			"initial_ticket" => "enum('yes','no') NOT NULL default 'yes'",
			"server_hostname" => "varchar(64) NOT NULL default ''",
			"request_close" => "enum('yes','no') NOT NULL default 'no'",
			"customer_email" => "varchar(255) NOT NULL default ''",
			"closed" => "enum('yes','no') NOT NULL default 'no'",
			"hash" => "varchar(32) NOT NULL default ''",
			"admin_name" => "varchar(256) NOT NULL default 'dtc'"
			),
		"primary" => "(id)",
		"index" => array(
			"in_reply" => "(in_reply_of_id)",
			"reply_id" => "(reply_id)",
			"got_reply2" => "(got_reply)"
			)
		),
	"usergroup" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"UserName" => "varchar(64) NOT NULL ",
			"GroupName" => "varchar(64) NOT NULL "
			),
		"primary" => "(id)",
		"index" => array(
			"UserName" => "(UserName)"
			)
		),
	"vps" => array(
		"vars" => array(
			"id" => "int(11) unsigned NOT NULL auto_increment",
			"owner" => "varchar(64) NOT NULL default ''",
			"vps_server_hostname" => "varchar(255) NOT NULL default ''",
			"vps_xen_name" => "varchar(64) NOT NULL default ''",
			"start_date" => "date NOT NULL default '0000-00-00'",
			"expire_date" => "date NOT NULL default '0000-00-00'",
			"hddsize" => "int(9) NOT NULL default '1'",
			"ramsize" => "int(9) NOT NULL default '48'",
			"bandwidth_per_month_gb" => "int(9) NOT NULL default '1'",
			"product_id" => "int(9) NOT NULL default '0'",
			"operatingsystem" => "varchar(64) NOT NULL default 'debian'",
			"installed" => "enum('yes','no') NOT NULL default 'no'",
			"bsdkernel" => "enum('normal','install') NOT NULL default 'normal'",
			"vncpassword" => "varchar(64) NOT NULL default 'none'",
			"howtoboot" => "varchar(256) NOT NULL default 'hdd'",
			"monitoring_email" => "varchar(255) NOT NULL default ''",
			"monitor_ping" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_ssh" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_http" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_smtp" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_pop3" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_imap4" => "enum('yes','no') NOT NULL default 'no'",
			"monitor_ftp" => "enum('yes','no') NOT NULL default 'no'"
			),
		"unique" => array(
			"vps_server_hostname" => "(vps_server_hostname,vps_xen_name)"
			),
		"index" => array(
			"ownerindex" => "(owner)"
			)
		),
	"vps_ip" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"vps_server_hostname" => "varchar(255) NOT NULL default ''",
			"vps_xen_name" => "varchar(64) NOT NULL default ''",
			"ip_addr" => "varchar(16) NOT NULL default ''",
			"rdns_addr" => "varchar(255) NOT NULL default 'gplhost.com'",
			"rdns_regen" => "enum('yes','no') NOT NULL default 'yes'",
			"ip_pool_id" => "int(11) NOT NULL default '0'",
			"available" => "enum('yes','no') NOT NULL default 'yes'"
			),
		"unique" => array(
			"ip_addr" => "(ip_addr)"
			),
		"primary" => "(id)",
		),
        "vps_server" => array(
                "vars" => array(
                        "id" => "int(11) NOT NULL auto_increment",
			"dom0_ips" => "varchar(255) NOT NULL default ''",
                        "hostname" => "varchar(255) NOT NULL ",
                        "location" => "varchar(64) NOT NULL ",
                        "soap_login" => "varchar(64) NOT NULL ",
                        "soap_pass" => "varchar(64) NOT NULL ",
			"lvmenable" => "enum('yes','no') NOT NULL default 'yes' ",
			"country_code" => "varchar(4) NOT NULL default 'US' "
                        ),
                "primary" => "(id)"
                ),
	"whitelist" => array(
		"vars" => array(
			"id" => "int(9) NOT NULL auto_increment",
			"pop_user" => "varchar(32) NOT NULL ",
			"mbox_host" => "varchar(128) NOT NULL ",
			"mail_from_user" => "varchar(128) NULL ",
			"mail_from_domain" => "varchar(128) NULL ",
			"mail_to" => "varchar(128) NULL "
			),
		"primary" => "(id)",
		"keys" => array(
			"pop_user" => "(pop_user,mbox_host,mail_to)",
			"unicbox" => "(pop_user,mail_from_user,mail_from_domain,mbox_host)"
			)
		),
	"affiliate_payments" => array(
		"vars" => array(
			"id" => "int(11) NOT NULL auto_increment",
			"adm_login" => "varchar(64) NOT NULL ",
			"order_id" => "int(11) NOT NULL ",
			"kickback" => "decimal(10,5) NOT NULL ",
			"date_paid" => "date NULL "
			),
		"primary" => "(id)",
		"keys" => array(
			"id" => "(id)"
			)
		),
	"whois" => array(
		"vars" => array(
			"domain_name" => "varchar(128) NOT NULL ",
			"owner_id" => "int(16) NOT NULL default '0' ",
			"admin_id" => "int(16) NOT NULL default '0' ",
			"billing_id" => "int(16) NOT NULL default '0' ",
			"creation_date" => "date NOT NULL default '0000-00-00' ",
			"modification_date" => "date NOT NULL default '0000-00-00' ",
			"expiration_date" => "date NOT NULL default '0000-00-00' ",
			"registrar" => "enum('tucows','namebay') NOT NULL default 'tucows' ",
			"ns1" => "varchar(64) NOT NULL default 'ns1.gplhost.com' ",
			"ns2" => "varchar(64) NOT NULL default 'ns2.gplhost.com' ",
			"ns3" => "varchar(64) NULL ",
			"ns4" => "varchar(64) NULL ",
			"ns5" => "varchar(64) NULL ",
			"ns6" => "varchar(64) NULL "
			),
		"primary" => "(domain_name)"
		)
	)
);
?>
