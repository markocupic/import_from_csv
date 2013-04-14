 
CREATE TABLE `tl_import_from_csv` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tstamp` int(10) unsigned NOT NULL default '0',
  `import_table` varchar(255) NOT NULL default '',
  `field_separator` varchar(255) NOT NULL default '',
  `field_enclosure` varchar(255) NOT NULL default '',
  `import_mode` varchar(255) NOT NULL default '',
  `selected_fields` varchar(1024) NOT NULL default '',
  `fileSRC` blob NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

 
             
             
             
              
          