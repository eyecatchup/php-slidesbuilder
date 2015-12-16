<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../vendor/autoload.php';

defined('DEMOCLASS_TEST')
or define('DEMOCLASS_TEST', dirname(__FILE__) . DIRECTORY_SEPARATOR);

#/* @var $loader \Composer\Autoload\ClassLoader */
#$loader = require __DIR__ . '/../vendor/autoload.php';
#$classMap1 = \Composer\Autoload\ClassMapGenerator::createMap(__DIR__);
#$loader->addClassMap($classMap1);

/**
require_once dirname(dirname(__FILE__))
	. DIRECTORY_SEPARATOR . 'vendor'
	. DIRECTORY_SEPARATOR . 'autoload.php';

defined('DEMOCLASS_TEST')
or define('DEMOCLASS_TEST', dirname(__FILE__) . DIRECTORY_SEPARATOR);
*/
