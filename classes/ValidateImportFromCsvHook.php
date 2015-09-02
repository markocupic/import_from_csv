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


class ValidateImportFromCsvHook extends \System
{

    /**
     * @param $arrCustomValidation
     * @param null $objBackendModule
     * @return array
     */
    public function myValidate($arrCustomValidation, $objBackendModule = null)
    {
        /**
        $arrCustomValidation = array(

            'strTable'      => 'tablename',
            'arrDCA'        => 'Datacontainer array (DCA) of the current field.',
            'fieldname'     => 'fieldname',
            'value'         => 'value',
            'arrayLine'     => 'Contains the current line/dataset as associative array.',
            'hasErrors'     => 'Should be set to true if validation fails.',
            'errorMsg'      => 'Define a custom text message if validation fails.',
            'doNotSave'     => 'Set this item to true if you don't want to save the value into the database.',
        );
        */

        // tl_member
        if ($arrCustomValidation['strTable'] == 'tl_member')
        {

            if ($arrCustomValidation['fieldname'] == 'firstname')
            {
                if($arrCustomValidation['value'] != 'Bruce')
                {
                    $arrCustomValidation['hasErrors'] = true;
                    $arrCustomValidation['errorMsg'] = "Firstname must be 'Bruce'! '" . $arrCustomValidation['value'] . "' given.";
                    $arrCustomValidation['doNotSave'] = true;
                }
            }

            if ($arrCustomValidation['fieldname'] == 'lastname')
            {
                if($arrCustomValidation['value'] != 'Springsteen')
                {
                    $arrCustomValidation['hasErrors'] = true;
                    $arrCustomValidation['errorMsg'] = "Lastname must be 'Springsteen'! '" . $arrCustomValidation['value'] . "' given.";
                    $arrCustomValidation['doNotSave'] = true;
                }
            }
        }

        // tl_user
        if ($arrCustomValidation['strTable'] == 'tl_user')
        {

            if ($arrCustomValidation['fieldname'] == 'username')
            {
                if($arrCustomValidation['value'] != 'brucespringsteen')
                {
                    $arrCustomValidation['hasErrors'] = true;
                    $arrCustomValidation['errorMsg'] = "Username must be 'brucespringsteen'! '" . $arrCustomValidation['value'] . "' given.";
                    $arrCustomValidation['doNotSave'] = true;
                }
            }
        }
        return $arrCustomValidation;
    }
}