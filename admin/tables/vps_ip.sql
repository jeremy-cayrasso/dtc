CREATE TABLE IF NOT EXISTS vps_ip (
  `id` int(11) NOT NULL auto_increment,
  `vps_server_hostname` varchar(255) NOT NULL default '',
  `vps_xen_name` varchar(64) NOT NULL default '',
  `ip_addr` varchar(16) NOT NULL default '',
  `rdns_addr` varchar(255) NOT NULL default 'gplhost.com',
  `rdns_regen` enum('yes','no') NOT NULL default 'yes',
  `ip_pool_id` int(11) NOT NULL default '0',
  `available` enum('yes','no') NOT NULL default 'yes',
  PRIMARY KEY  (id),
  UNIQUE KEY ip_addr (ip_addr)
) TYPE=MyISAM;
