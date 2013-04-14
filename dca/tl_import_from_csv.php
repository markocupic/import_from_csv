<?php
if (!defined('TL_ROOT'))
       die('You can not access this file directly!');
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
              'default' => 'import_table,selected_fields,field_separator,field_enclosure,import_mode,fileSRC',
       ),
       // Fields
       'fields' => array
       (
             
              'import_table' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['import_table'],
                     'inputType' => 'select',
                     'options_callback' => array(
                            'tl_import_from_csv',
                            'optionsCbGetTables'
                     ),
                     'eval' => array(
                            'multiple' => false,
                            'mandatory' => true,
                            'includeBlankOption' => true,
                            'submitOnChange' => true,
                     ),
              ),
              'field_separator' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['field_separator'],
                     'inputType' => 'text',
                     'default' => ';',
                     'eval' => array(
                            'mandatory' => true,
                     ),
              ),
              'field_enclosure' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['field_enclosure'],
                     'inputType' => 'text',
                     'eval' => array(
                            'mandatory' => false,
                     ),
              ),
              'import_mode' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['import_mode'],
                     'inputType' => 'select',
                     'options' => array('append_entries', 'truncate_table'),
                     'reference' => $GLOBALS['TL_LANG']['tl_import_from_csv'],
                     'eval' => array(
                            'multiple' => false,
                            'mandatory' => true,
                     ),
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
                            'multiple' => true,
                     ),
              ),
              'fileSRC' => array
              (
                     'label' => &$GLOBALS['TL_LANG']['tl_import_from_csv']['fileSRC'],
                     'inputType' => 'fileTree',
                     'eval' => array(
                            'multiple' => false,
                            'fieldType' => 'radio',
                            'files' => true,
                            'mandatory' => true,
                            'extensions' => 'csv',
                            'submitOnChange' => true,
                     ),
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
              if ($this->Input->post('FORM_SUBMIT') && $this->Input->post('SUBMIT_TYPE') != 'auto') {
                     $this->initImport();
              }
       }
	/**
        * init the import
        */
       private function initImport()
       {
             
              $strTable = $this->Input->post('import_table');
              $importMode = $this->Input->post('import_mode');
              $arrSelectedFields = $this->Input->post('selected_fields');
              $strFieldseparator = $this->Input->post('field_separator');
              $strFieldenclosure = $this->Input->post('field_enclosure');
		
		// call the import class if file exists
              if (is_file(TL_ROOT . '/' . $this->Input->post('fileSRC'))) {
			$objFile = new File($this->Input->post('fileSRC'));
                     if (strtolower($objFile->extension) == 'csv') {
				$objImport = new ImportFromCsv;
                            $objImport->importCsv($objFile, $strTable, $importMode, $arrSelectedFields, $strFieldseparator, $strFieldenclosure, 'id');
                     }
              }
       }
       public function optionsCbGetTables()
       {
              $objTables = $this->Database->listTables();
              $arrOptions = array();
              foreach ($objTables as $table) {
                     $arrOptions[] = $table;
              }
              return $arrOptions;
       }

       public function optionsCbSelectedFields()
       {
              $objDb = $this->Database->prepare('SELECT * FROM tl_import_from_csv WHERE id = ?')->execute($this->Input->get('id'));
              if ($objDb->import_table == '') return;
              $objFields = $this->Database->listFields($objDb->import_table, 1);
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
              