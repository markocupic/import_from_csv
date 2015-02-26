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
 * Class MyValidateImportFromCsvHook
 * Copyright: 2014 Marko Cupic Sponsor der Erweiterung: Fast-Doc UG, Berlin
 * @author Marko Cupic <m.cupic@gmx.ch>
 * @package import_from_csv
 */


class MyValidateImportFromCsvHook extends \System
{

    /**
     * @param $strTable
     * @param $arrDCA
     * @param $strFieldname
     * @param string $strFieldContent
     * @param $arrAssoc
     * @param null $objBackendModule
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