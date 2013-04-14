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
/**
 * -------------------------------------------------------------------------
 * BACK END MODULES
 * -------------------------------------------------------------------------
 */
if (TL_MODE == 'BE') {
       $GLOBALS['BE_MOD']['system']['import_from_csv'] = array(
              'icon' => 'system/modules/import_from_csv/assets/images/file-import-icon-16.png',
              'tables' => array(
                     'tl_import_from_csv'
              )
       );
}
if (TL_MODE == 'BE' && $_GET['do'] == 'import_from_csv') {
       $GLOBALS['TL_JAVASCRIPT'][] = 'system/modules/import_from_csv/assets/js/import_from_csv.js';
       $GLOBALS['TL_CSS'][] = 'system/modules/import_from_csv/assets/css/import_from_csv.css';
}

