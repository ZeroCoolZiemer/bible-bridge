<?php

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err)) {
        $sql_check = "SELECT COUNT(*) FROM users WHERE username = ?";
        if ($stmt_check = $pdo->prepare($sql_check)) {
            $stmt_check->bindParam(1, $username);
            $stmt_check->execute();
            $user_exists = $stmt_check->fetchColumn();

            if ($user_exists > 0) {
                $username_err = "Username already taken.";
            }
        }
    }

    if (empty($username_err) && empty($password_err)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, role) VALUES (?, ?, 'user')";
        
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $hashed_password);
            
            if ($stmt->execute()) {
                header("location: login.php");
                exit();
            } else {
                echo "Something went wrong. Please try again.";
            }
        }
    }
    
    unset($stmt);
}
if (!empty($username_err)) {
    $smarty->assign('error', $username_err);
} elseif (!empty($password_err)) {
    $smarty->assign('error', $password_err);
}
$smarty->assign('website', $website);
$smarty->assign('activePage', 'register');
$smarty->display('register.tpl');
?>