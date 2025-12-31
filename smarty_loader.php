<?php
require_once 'vendor/autoload.php';

use Smarty\Smarty;

$smarty = new Smarty();

$smarty->setTemplateDir('/var/www/html/smarty/templates');
$smarty->setCompileDir('/var/www/html/smarty/templates_c');
$smarty->setConfigDir('/var/www/html/smarty/configs');
$smarty->setCacheDir('/var/www/html/smarty/cache');
?>