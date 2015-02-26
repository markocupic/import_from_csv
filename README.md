# Import from CSV

Backend Modul für Contao 3

Mit dem Modul lassen sich in einem Rutsch über eine csv-Datei massenhaft Datensätze importieren. Sehr praktisch, wenn z.B. sehr viele Benutzer oder Mitglieder generiert werden müssen.
Die csv-Datei wird am besten in einem Tabellenkalkulationsprogramm  (excel o.ä.) erstellt und dann als Kommaseparierte Datei (csv) abgespeichert.
Ein Beispiel für diese Datei findet sich im Verzeichnis import_from_csv/csv/example_csv.csv.

## Warnung!

Achtung! Das Modul bietet einen grossen Nutzen. Der Anwender sollte aber wissen, was er tut, da bei falscher Anwendung Datenbanktabellen "zerschossen" werden können und Contao danach nicht mehr funktionstüchtig ist.

## Einstellungen

### Datentabelle für Import auswählen (Pflichtfeld)

Wählen Sie die Tabelle, in die die Datensätze geschrieben werden sollen.

### Felder für Importvorgang auswählen  (Pflichtfeld)

In der Datenbanktabelle wird nur in die ausgewählten Felder geschrieben. Meistens macht es Sinn, hier alle Felder auszuwählen.

### Felder getrennt von (Pflichtfeld)

Geben Sie an, durch welches Zeichen in der csv-Datei die Feldinhalte voneinander getrennt sind.

### Felder eingeschlossen von (Pflichtfeld)

Kontrollieren Sie, ob in der csv-Datei die Feldinhalte noch zusätzlich von einem Zeichen eingeschlossen sind. Oft ist das das doppelte Anführungszeichen. => "

### Import Modus (Pflichtfeld)
Legen Sie fest, ob die Datensätze aus der csv-Datei in der Zieltabelle angehängt werden oder die Zieltabelle vorher geleert werden soll (alter table). Achtung! Gelöschte Datensätze lassen sich, wenn kein Backup vorhanden, nicht mehr wiederherstellen.

### Datei auswählen (Pflichtfeld)
Abschliessend wählen Sie die Datei aus, von der in die Datenbank geschrieben werden soll.
Tipp: Wenn Sie die Datei ausgewählt haben, klicken Sie voher auf "Speichern" und Sie kriegen eine Vorschau.

## Importmechanismus über Hook anpassen

Mit einem updatesicheren Hook lässt sich die Validierung umgehen oder anpassen. Erstellen Sie dafür folgende Ordner und Dateistruktur:

system/modules/my_import_from_csv_hook/
    config/
        config.php
        autoload.php
        autoload.ini
    classes/MyValidateImportFromCsv.php


In die config.php schreibt man folgendes:
```php
<?php

/**
 * HOOKS
 */
if (TL_MODE == 'BE' && \Input::get('do') == 'import_from_csv')
{
    $GLOBALS['TL_HOOKS']['importFromCsv'][] = array('MyValidateImportFromCsv', 'myValidate');
}

```

In die MyValidateImportFromCsv.php schreiben Sie folgendes. In die myValidate()-Methode scheiben Sie Ihren Validierungslogik. Die Methode erwartet 4 Parameter und gibt den modifizierten Feldinhalt als String zurück.

```php
<?php

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
 * @package import_from_csv
 * @author Marko Cupic 2014, extension sponsered by Rainer-Maria Fritsch - Fast-Doc UG, Berlin
 * @link https://github.com/markocupic/import_from_csv
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */

/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace MCupic;

/**
 * Class MyValidateImportFromCsv
 * Copyright: 2014 Marko Cupic Sponsor der Erweiterung: Fast-Doc UG, Berlin
 * @author Marko Cupic <m.cupic@gmx.ch>
 * @package import_from_csv
 */


class MyValidateImportFromCsv extends \System
{

    /**
     * @param $strTable
     * @param $arrDCA
     * @param $strFieldname
     * @param $strFieldContent
     * @param $arrAssoc
     * @param $objBackendModule
     * @return string
     */
    public function myValidate($strTable, $arrDCA, $strFieldname, $strFieldContent = '', $arrAssoc, $objBackendModule = null)
    {
        if ($strTable == 'tl_member')
        {
            if ($strFieldname == 'firstname')
            {
                $strFieldContent = 'Bruce';
            }
            if ($strFieldname == 'lastname')
            {
                $strFieldContent = 'Springsteen';
            }
        }
        return $strFieldContent;
    }
}

```

Damit Contao weiss, wo die Klasse zu finden ist, sollte zum Schluss im Backend für das neu erstellte Modul der Autoload-Creator gestartet werden. Dieser füllt die autoload-Dateien mit dem nötigen Code.
Et voilà!
Viel Spass!!!

