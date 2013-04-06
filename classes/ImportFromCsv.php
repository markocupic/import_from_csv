<?php

/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2013 Leo Feyer
 * @package Import_from_csv
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 * @author Marko Cupic <m.cupic@gmx.ch>
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace MCupic;


/**
 * Class ImportFromCsv
 *
 * @copyright Marko Cupic 2013
 * @author Marko Cupic <m.cupic@gmx.ch>
 * @package import_from_csv
 */
class ImportFromCsv extends \Backend
{
            
	/**
        * array
        * import options
        */
       public static $arrData;

       /**
        * @param object
        * @param string
        * @param string
        * @param string
        * @param string
        * @param string
	 * @param string
        */
       public static function importCsv($objCsvFile, $strTable, $strImportMode, $arrSelectedFields = null, $strFieldseparator = ';', $strFieldenclosure = '', $strPrimaryKey = 'id')
       {
              // store the options in self::$arrData
		self::$arrData = array(
			'tablename' 		=> $strTable,
			'primaryKey' 		=> $strPrimaryKey,
			'importMode' 		=> $strImportMode,
			'selectedFields' 	=> is_array($arrSelectedFields) ? $arrSelectedFields : array(),
			'fieldSeparator' 	=> $strFieldseparator,
			'fieldEnclosure' 	=> $strFieldenclosure,
		);
		
              // truncate table
              if (self::$arrData['importMode'] == 'truncate_table') {
                     \Database::getInstance()->execute('TRUNCATE TABLE `' . $strTable . '`');
              }
              if (count(self::$arrData['selectedFields']) < 1)
                     return;
              
		// create a tmp file
              $tmpFile = new \File('system/tmp/' . md5(time()) . '.csv');
              $tmpFile->truncate();
		
		// format file for correct handling
              $tmpFile->write(self::formatFile($objCsvFile));
              $tmpFile->close();
		
		//get content as array
              $arrFileContent = $tmpFile->getContentAsArray();
              $arrFieldnames = explode(self::$arrData['fieldSeparator'], $arrFileContent[0]);
              
		// trim quotes in the first line and get the fieldnames
              $arrFieldnames = array_map(function ($strFieldname) {
                     return trim($strFieldname, ImportFromCsv::$arrData['fieldEnclosure']);
              }, $arrFieldnames);
		
		// store each line as an entry in the db
              foreach ($arrFileContent as $line => $lineContent) {
                     
                     // line 0 contains the fieldnames
			if ($line == 0)
				continue;
			
                     // separate the line into the different fields	
                     $arrLine = explode(self::$arrData['fieldSeparator'], $lineContent);
                     
			// trim quotes
                     $arrLine = array_map(function ($fieldContent) {
                            return trim($fieldContent, ImportFromCsv::$arrData['fieldEnclosure']);
                     }, $arrLine);
			
                     $set = array();
                     foreach ($arrFieldnames as $k => $fieldname) {
                            // continue if field is excluded from import
                            if (!in_array($fieldname, self::$arrData['selectedFields']))
					continue;
                            
				// if entries are appended autoincrement id
                            if (self::$arrData['importMode'] == 'append_entries' && strtolower($fieldname) == self::$arrData['primaryKey'])
					continue;
                            
				$fieldContent = $arrLine[$k];
				// reinsert the newlines
                            $fieldContent = str_replace('[NEWLINE-N]', chr(10), $fieldContent);
                            $fieldContent = str_replace('[DOUBLE-QUOTE]', '"', $fieldContent);
                            $set[$fieldname] = $fieldContent;
                     }
                     
                     // insert into database
                     \Database::getInstance()->prepare('INSERT INTO `' . $strTable . '` %s')->set($set)->executeUncached();
              }
              $tmpFile->delete();
       }

       /**
        * @param object
        * @return string
        */
       private static function formatFile($objFile)
       {
              $file = new \File($objFile->path);
              $fileContent = $file->getContent();
              $fileContent = str_replace('\"', '[DOUBLE-QUOTE]', $fileContent);
              $fileContent = str_replace('\r\n', '[NEWLINE-RN]', $fileContent);
              $fileContent = str_replace(chr(13) . chr(10), '[NEWLINE-RN]', $fileContent);
              $fileContent = str_replace('\n', '[NEWLINE-N]', $fileContent);
              $fileContent = str_replace(chr(10), '[NEWLINE-N]', $fileContent);
              $fileContent = str_replace('[NEWLINE-RN]', chr(13) . chr(10), $fileContent);
              return $fileContent;
       }
}

