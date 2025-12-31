<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Database credentials
    $host = 'localhost';
    $username = 'root';
    $password = ''; //ENTER YOUR PASSWORD
    $database = 'holy_bible_articles';

    if ($_FILES['db_file']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['db_file']['tmp_name'];
        $sqlContent = file_get_contents($fileTmpPath);

        $conn = new mysqli($host, $username, $password);

        if ($conn->connect_error) {
            die('Connection failed: ' . $conn->connect_error);
        }

        // Drop existing database and create a new one
        $conn->query("DROP DATABASE IF EXISTS $database");
        $conn->query("CREATE DATABASE $database");
        $conn->select_db($database);

        // Split and execute queries
        $queries = explode(";\n", $sqlContent);
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if (!$conn->query($query)) {
                    echo '<p style="color: red;">Error executing query: ' . $conn->error . '</p>';
                }
            }
        }

        $conn->close();

        echo '<p style="color: green;">Database imported successfully!</p>';
    } else {
        echo '<p style="color: red;">File upload error!</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Database</title>
</head>
<body>
    <h2>Import Database</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="db_file">Select SQL file:</label>
        <input type="file" name="db_file" id="db_file" required>
        <button type="submit">Import Database</button>
    </form>
</body>
</html>