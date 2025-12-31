<?php
session_start();

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['username'] = $user['username'];
 	
	if ($_SESSION['role'] == "admin" || $_SESSION['role'] == "demo") {	
	header("Location: admin-dashboard");
	exit;
        } else {
	header("Location: user-dashboard");
	exit;
	}
    } else {
        $error = "Invalid username or password.";
    }
}
$smarty->assign('error', $error);
$smarty->assign('website', $website);
$smarty->assign('activePage', 'login');
$smarty->display('login.tpl');
?>
