<?php
/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2013 Leo Feyer
 * @package Import_from_csv
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @author Marko Cupic <m.cupic@gmx.ch>
 */

$GLOBALS['TL_DCA']['tl_import_from_csv'] = array
(
       // Config
       'config' => array
       (
              'sql' => array(
                     'keys' => array(
                            'id' => 'primary',
                     )
              ),
              'dataContainer' => 'Table',
       ),
       // List
       'list' => array
       (
              'sorting' => array
              (
                     'fields' => array('tstamp DESC'),
              ),
              'label' => array
              (
                     'fields' => array('import_table'),
                     'format' => '%s'
              ),
              'global_operations' => array(//
              ),
              'operations' => array
              (
                     'edit' => array
                     (
                            'label' => &$GLOBALS['TL_LANG']['MSC']['edit'],
                            'href' => 'act=edit',
                            'icon' => 'edit.gif'
                     ),
                     'delete' => array
                     (
                            'label' => &$GLOBALS['TL_LANG']['MSC']['delete'],
                            'href' => 'act=delete',
                            'icon' => 'delete.gif',
                            'attributes' => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
                     ),
                     'show' => array
                     (
                            'label' => &$GLOBALS['TL_LANG']['MSC']['show'],
                            'href' => 'act=show',
                            'icon' => 'show.gif'
                     )
              )
       ),
       // Palettes
       'palettes' => array
       (
              'default' => '{import_from_csv},import_table,selected_fields,field_separator,field_enclosure,import_mode,fileSRC',
       ),
       // Fields
       'fields' => array
       (
              'id' => array
              (
                     'sql' => "int(10) unsigned NOT NULL auto_increment",
              ),
              'tstamp' => array('sql' => "int(10) unsigned NOT NULL default '0'"),
              'import_table' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['import_table'],
                     'inputType' => 'select',
                     'options_callback' => array(
                            'tl_import_from_csv',
                            'optionsCbGetTables'
                     ),
                     'eval' => array(
                            'doNotShow' => true,
                            'multiple' => false,
                            'mandatory' => true,
                            'includeBlankOption' => true,
                            'submitOnChange' => true,
                     ),
                     'sql' => "varchar(255) NOT NULL default ''"
              ),
              'field_separator' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['field_separator'],
                     'inputType' => 'text',
                     'default' => ';',
                     'eval' => array(
                            'doNotShow' => true,
                            'mandatory' => true,
                     ),
                     'sql' => "varchar(255) NOT NULL default ''"
              ),
              'field_enclosure' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['field_enclosure'],
                     'inputType' => 'text',
                     'eval' => array(
                            'doNotShow' => true,
                            'mandatory' => false,
                     ),
                     'sql' => "varchar(255) NOT NULL default ''"
              ),
              'import_mode' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['import_mode'],
                     'inputType' => 'select',
                     'options' => array('append_entries', 'truncate_table'),
                     'reference' => $GLOBALS['TL_LANG']['tl_import_from_csv'],
                     'eval' => array(
                            'doNotShow' => true,
                            'multiple' => false,
                            'mandatory' => true,
                     ),
                     'sql' => "varchar(255) NOT NULL default ''"
              ),
              'selected_fields' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['selected_fields'],
                     'inputType' => 'checkbox',
                     'options_callback' => array(
                            'tl_import_from_csv',
                            'optionsCbSelectedFields'
                     ),
                     'eval' => array(
                            'doNotShow' => true,
                            'multiple' => true,
                     ),
                     'sql' => "varchar(1024) NOT NULL default ''"
              ),
              'fileSRC' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['fileSRC'],
                     'inputType' => 'fileTree',
                     'eval' => array(
                            'doNotShow' => true,
                            'multiple' => false,
                            'fieldType' => 'radio',
                            'files' => true,
                            'mandatory' => true,
                            'extensions' => 'csv',
                            'submitOnChange' => true,
                     ),
                     'sql' => "blob NULL"
              ),
       )
);

/**
 * Class tl_import_from_csv
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Marko Cupic
 * @author     Marko Cupic
 * @package    tl_import_from_csv
 */
class tl_import_from_csv extends Backend
{
       public function __construct()
       {
              parent::__construct();
              if (Input::post('FORM_SUBMIT')) {
                     ImportFromCsv::initImport();
              }
       }

       public function optionsCbGetTables()
       {
              $objTables = Database::getInstance()->listTables();
              $arrOptions = array();
              foreach ($objTables as $table) {
                     $arrOptions[] = $table;
              }
              return $arrOptions;
       }

       public function optionsCbSelectedFields()
       {
              $objDb = Database::getInstance()->prepare('SELECT * FROM tl_import_from_csv WHERE id = ?')->execute(Input::get('id'));
              if ($objDb->import_table == '') return;
              $objFields = Database::getInstance()->listFields($objDb->import_table, 1);
              $arrOptions = array();
              //die(print_r($objFields,true));
              foreach ($objFields as $field) {
                     if ($field['name'] == 'PRIMARY') continue;
                     if (in_array($field['name'], $arrOptions)) continue;
                     $arrOptions[$field['name']] = $field['name'] . ' [' . $field['type'] . ']';
              }
              return $arrOptions;
       }
}           
              