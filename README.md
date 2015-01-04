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


