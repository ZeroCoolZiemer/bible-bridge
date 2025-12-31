<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Access denied']);
    exit;
}

require_once('smarty_loader.php');
require_once('settings.php');
require_once($path . '/config.php');
include($db_path . '/articles-db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

try {
    $book = trim($_GET['book']);
    $chapter = trim($_GET['chapter']);
    $user_id = trim($_GET['user_id']);

    if (empty($book) || empty($chapter) || !is_numeric($chapter) || $chapter < 1 || empty($user_id)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
        exit;
    }

    $bible_reference = "$book $chapter";

    $sql = "SELECT note FROM bible_notes WHERE user_id = ? AND bible_reference = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $bible_reference]);

    if ($stmt->rowCount() > 0) {
        $note = $stmt->fetchColumn();
        echo json_encode(['status' => 'success', 'note' => $note]);
    } else {
        echo json_encode(['status' => 'success', 'note' => '']);
    }

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database error occurred']);
} catch (Exception $e) {
    error_log('General error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Server error occurred']);
}
?>