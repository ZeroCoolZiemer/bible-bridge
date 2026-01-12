<?php
require_once 'vendor/autoload.php';

use Smarty\Smarty;

$smarty = new Smarty();

$smarty->setEscapeHtml(true);

$baseDir = __DIR__; 

$smarty->setTemplateDir($baseDir . '/smarty/templates');
$smarty->setCompileDir($baseDir . '/smarty/templates_c');
$smarty->setConfigDir($baseDir . '/smarty/configs');
$smarty->setCacheDir($baseDir . '/smarty/cache');
?>
