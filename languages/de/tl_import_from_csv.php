<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 * @package import_from_csv
 * @link    http://www.contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

// legends
$GLOBALS['TL_LANG']['tl_import_from_csv']['manual'] = 'Anleitung/Hilfe';
$GLOBALS['TL_LANG']['tl_import_from_csv']['settings'] = 'Einstellungen';

// fields
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_table'] = array('Datentabelle für Import auswählen', 'Wählen Sie eine Tabelle, in welche die Daten importiert werden sollen, aus.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['import_mode'] = array('Import-Modus', 'Entscheiden Sie, ob die Tabelle vor dem Import gelöscht werden soll oder die Daten an die bestehenden Einträge angehängt werden sollen.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_enclosure'] = array('Felder eingeschlossen von', 'Zeichen, von welchem die Felder in der csv-Datei eingeschlossen sind. Normalerweise ein doppeltes Anführungszeichen: => "');
$GLOBALS['TL_LANG']['tl_import_from_csv']['field_separator'] = array('Felder getrennt von', 'Zeichen, mit dem die Felder in der csv-Datei voneinander getrennt sind. Normalerweise ein Semikolon: => ;');
$GLOBALS['TL_LANG']['tl_import_from_csv']['selected_fields'] = array('Felder für Importvorgang auswählen.');
$GLOBALS['TL_LANG']['tl_import_from_csv']['fileSRC'] = array('csv-Datei auswählen');

//references
$GLOBALS['TL_LANG']['tl_import_from_csv']['truncate_table'] = array('Tabelle vor dem Import löschen');
$GLOBALS['TL_LANG']['tl_import_from_csv']['append_entries'] = array('Datensätze nur anhängen');