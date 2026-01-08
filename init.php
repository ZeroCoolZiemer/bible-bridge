<?php
session_start();

$compileDir = __DIR__ . '/smarty/templates_c';
$flagFile   = $compileDir . '/.__writable_ok';
$relativePath = 'smarty/templates_c';

if (!is_dir($compileDir)) {
    @mkdir($compileDir, 0755, true);
}

$compileDir   = __DIR__ . '/smarty/templates_c';
$flagFile     = $compileDir . '/.__writable_ok';
$relativePath = 'smarty/templates_c';

if (!is_dir($compileDir)) {
    @mkdir($compileDir, 0755, true);
}

if (!file_exists($flagFile)) {
    $testFile = $compileDir . '/.__write_test';
    $writeOk  = @file_put_contents($testFile, 'ok') !== false;

    if ($writeOk) {
        @unlink($testFile);
        @file_put_contents($flagFile, "ok");
    } else {
        $selinux       = trim(@shell_exec('getenforce 2>/dev/null'));
        $selinuxActive = ($selinux === 'Enforcing');

        echo "<div style='border:2px solid red; padding:15px; margin:20px; font-family:sans-serif; background:#ffe6e6;'>
            <h2>Setup Needed</h2>
            <p>Smarty cannot write to its <strong>compile folder</strong>.</p>
            <p>Relative path from your project root: <code>{$relativePath}</code></p>
            <p>Please make this folder writable by your web server.</p>";

        if ($selinuxActive) {
            echo "<p><strong>SELinux detected.</strong> On CentOS/RHEL/Fedora servers you may need to run:</p>
                  <pre>
sudo semanage fcontext -a -t httpd_sys_rw_content_t '{$relativePath}(/.*)?'
sudo restorecon -Rv '{$relativePath}'
                  </pre>";
        }

        echo "<p>On shared hosting, adjust folder permissions to be writable by the web server user (commonly apache, www-data, or nobody).</p>
        </div>";

        exit;
    }
}

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');

$bibles = array_change_key_case($bibles, CASE_LOWER);

$requestedVersion = '';
if (!empty($_GET['v'])) {
    $requestedVersion = strtolower(trim($_GET['v']));
} elseif (!empty($_COOKIE['bible_version'])) {
    $requestedVersion = strtolower(trim($_COOKIE['bible_version']));
}

if (!empty($requestedVersion) && isset($bibles[$requestedVersion])) {
    $selectedVersion = $requestedVersion;
} else {
    $selectedVersion = array_key_first($bibles);
}

$_SESSION['active_bible'] = $selectedVersion;
setcookie('bible_version', $selectedVersion, time() + (86400 * 30), '/');

$activeConfig = $bibles[$selectedVersion];

require_once($path . '/connect.php');

$map             = $activeConfig['mappings'];
$bookIDColumn    = $map['bookIDColumn'];
$bookColumn      = $map['bookColumn'];
$chapterColumn   = $map['chapterColumn'];
$verseColumn     = $map['verseColumn'];
$verseTextColumn = $map['verseTextColumn'];
$bible_permissions = $map['permissions'];

$smarty->assign('bibles', $bibles);
$smarty->assign('selectedVersion', $selectedVersion);
$smarty->assign('activeConfig', $activeConfig);
$smarty->assign('website', $activeConfig['website']);

$smarty->assign('tableName', $activeConfig['tableName']);
$smarty->assign('map', $map);
$smarty->assign('bookIDColumn', $bookIDColumn);
$smarty->assign('bookColumn', $bookColumn);
$smarty->assign('chapterColumn', $chapterColumn);
$smarty->assign('verseColumn', $verseColumn);
$smarty->assign('verseTextColumn', $verseTextColumn);
$smarty->assign('bookNameColumn', $bookColumn);
$smarty->assign('bible_permissions', $bible_permissions);
?>