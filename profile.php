<?php
require_once('init.php');

if (!isset($_SESSION['user'])) {
    header("Location: login");
    exit;
}

if (!isset($_SESSION['user']) || !in_array($_SESSION['role'], ['admin', 'demo', 'user'])) {
    header("Location: unauthorized");
    exit;
}

$session_username = $_SESSION["username"];

include($db_path . '/articles-db.php');

// Check if form is submitted to update password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

if ($_SESSION['role'] === 'demo') {
    header("Location: unauthorized");
    exit;
}

    $currentPassword = $_POST['current_password'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {

        $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->execute([$session_username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($currentPassword, $user['password'])) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateStmt = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
            $updateStmt->execute([$hashedPassword, $session_username]);

            $successMessage = "Password updated successfully!";
        } else {
            $errorMessage = "Current password is incorrect.";
        }
    } else {
        $errorMessage = "New password and confirmation do not match.";
    }
}

$smarty->assign('errorMessage', $errorMessage ?? '');
$smarty->assign('successMessage', $successMessage ?? '');
$smarty->assign('website', $website);
$smarty->assign('activePage', 'admin');
$smarty->display('profile.tpl');
?>
