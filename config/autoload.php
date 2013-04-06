<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Import_from_csv
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'MCupic',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'MCupic\ImportFromCsv' => 'system/modules/import_from_csv/classes/ImportFromCsv.php',
));
