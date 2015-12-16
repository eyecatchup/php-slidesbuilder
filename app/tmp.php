<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**
 * Disabling Zend Garbage Collection (to prevent segfaults) with PHP 5.4+.
 * @see <https://bugs.php.net/bug.php?id=53976>
 */
if (version_compare(PHP_VERSION, '5.4', '>=') && gc_enabled()) {
    gc_disable();
}


$a = array(
	'saveAs' => 'custom-save-as-filename.html',
	'markdownDirname' => 'custom-markdown-dirname',
	'templatesDirname' => 'custom-template-dirname',
);

$b = dirname(__FILE__);
$c = dirname(dirname(__FILE__));
$d = __DIR__;
$e = dirname(__DIR__);
$f = dirname(__DIR__ . '../');
$g = dirname(__DIR__ . '/../');
#$h = realpath(__DIR__ . '/../vendor/');
$h = realpath(__DIR__ . '/../vendor/');
$i = realpath($h . '/../');
var_dump($i);
