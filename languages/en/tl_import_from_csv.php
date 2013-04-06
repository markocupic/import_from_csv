<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Import_from_csv
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @author Marko Cupic <m.cupic@gmx.ch>
 */


// fields
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_table'] = array('Import data into this table', 'Choose a table for the import');
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_mode'] = array('Import mode', 'Choose if the table will be truncated before importing the data from csv.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_enclosure'] = array('Field enclosure', 'Mit welchem Zeichen sind die Feldinhalte umschlossen? Normalerweise: "');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_separator'] = array('Field separator', 'Mit welchem Zeichen sind die Felder in der Csv-Datei voneinander getrennt? Normalerweise ist das ein Semikolon: => ;');
$GLOBALS['TL_LANG']['tl_import_from_csv']['selected_fields'] = array('Select the fields for the import');
$GLOBALS['TL_LANG']['tl_import_from_csv']['fileSRC'] = array('Select a csv-file for the import');

//references
$GLOBALS['TL_LANG']['tl_import_from_csv']['truncate_table'] = array('truncate table before the import process');
$GLOBALS['TL_LANG']['tl_import_from_csv']['append_entries'] = array('only append data into a given table');