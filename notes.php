<?php
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
    http_response_code(403);
    echo json_encode(['status' => 'error', 'message' => 'Access denied']);
    exit;
}

require_once('init.php');
include($db_path . '/articles-db.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

try {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON input']);
        exit;
    }

    $required = ['note', 'book', 'chapter', 'user_id'];
    foreach ($required as $field) {
        if (!isset($data[$field]) || empty(trim($data[$field]))) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => "Missing required field: $field"]);
            exit;
        }
    }

    $note = trim($data['note']);
    $book = trim($data['book']);
    $chapter = trim($data['chapter']);
    $user_id = trim($data['user_id']);

    if (strlen($note) > 500) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Note must be 500 characters or less']);
        exit;
    }

    if (!is_numeric($chapter) || $chapter < 1) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid chapter number']);
        exit;
    }

    $bible_reference = "$book $chapter";

    $sql = "SELECT * FROM bible_notes WHERE user_id = ? AND bible_reference = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id, $bible_reference]);

    if ($stmt->rowCount() > 0) {
        $update_sql = "UPDATE bible_notes SET note = ? WHERE user_id = ? AND bible_reference = ?";
        $update_stmt = $pdo->prepare($update_sql);
        $update_stmt->execute([$note, $user_id, $bible_reference]);

        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Note updated successfully!']);
    } else {
        $insert_sql = "INSERT INTO bible_notes (user_id, bible_reference, note) VALUES (?, ?, ?)";
        $insert_stmt = $pdo->prepare($insert_sql);
        $insert_stmt->execute([$user_id, $bible_reference, $note]);

        if ($insert_stmt->rowCount() === 0) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Note not saved']);
            exit;
        }

        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Note saved successfully!']);
    }

} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => 'Database error occurred',
        'error_code' => $e->getCode()
    ]);
} catch (Exception $e) {
    error_log('General error: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Server error occurred']);
}
?>