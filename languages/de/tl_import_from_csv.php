<?php

/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2013 Leo Feyer
 * @package Import_from_csv
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @author Marko Cupic <m.cupic@gmx.ch>
 */
 
// fields
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_table'] = array('Datentabelle für Import auswählen', 'Wählen Sie eine Tabelle, in welche die Daten importiert werden sollen, aus.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_mode'] = array('Import-Modus', 'Entscheiden Sie, ob die Tabelle vor dem Import gelöscht werden soll oder die Daten an die bestehenden Eiträge angehängt werden sollen.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_enclosure'] = array('Felder eingeschlossen von', 'Mit welchem Zeichen sind die Felder eingeschlossen? Normalerweise ein doppeltes Anführungszeichen: => "');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_separator'] = array('Felder getrennt von', 'Mit welchem Zeichen sind die Felder in der csv-Datei voneinander getrennt? Normalerweise ein Semikolon: => ;');
$GLOBALS['TL_LANG']['tl_import_from_csv']['selected_fields'] = array('Felder für Importvorgang auswählen.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['fileSRC'] = array('csv-Datei auswählen');

//references
$GLOBALS['TL_LANG']['tl_import_from_csv']['truncate_table'] = array('Tabelle vor dem Import löschen');
$GLOBALS['TL_LANG']['tl_import_from_csv']['append_entries'] = array('Datensätze nur anhängen');