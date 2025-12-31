<?php
session_start();

if (!isset($_SESSION['db_host'])) {
    die("Database connection not established. <a href='setup.php'>Go back</a>");
}

$cacheKey = 'book_titles_cache';

if (function_exists('apcu_enabled') && apcu_enabled() && apcu_exists($cacheKey)) {
    apcu_delete($cacheKey);
}

try {
    $pdo = new PDO(
        "mysql:host=" . $_SESSION['db_host'] . ";dbname=" . $_SESSION['db_name'],
        $_SESSION['db_user'],
        $_SESSION['db_pass']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['table_name'])) {
        $table = $_POST['table_name'];
        $_SESSION['selected_table'] = $table;
        header("Location: match-columns.php");
        exit();
    }

    if (isset($_SESSION['selected_table'])) {
        $selected_table = $_SESSION['selected_table'];
        $stmt = $pdo->prepare("SHOW COLUMNS FROM `$selected_table`");
        $stmt->execute();
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($columns)) {
        $configData = "<?php\n";
        $configData .= "\$dbHost = \"" . $_SESSION['db_host'] . "\";\n";
        $configData .= "\$dbName = \"" . $_SESSION['db_name'] . "\";\n";
        $configData .= "\$dbUsername = \"" . $_SESSION['db_user'] . "\";\n";
        $configData .= "\$dbPassword = \"" . $_SESSION['db_pass'] . "\";\n";
        $configData .= "\$tableName = \"" . $_SESSION['selected_table'] . "\";\n";
        $configData .= "\$website = \"//" . rtrim($_POST['website'], '/') . "/\";\n";

        $column_fields = [
            'verseTextColumn' => 'Verse Text Column',
            'bookColumn' => 'Book Column',
            'chapterColumn' => 'Chapter Column',
            'verseColumn' => 'Verse Column',
            'bookIDColumn' => 'Book ID Column'
        ];

        foreach ($column_fields as $key => $desc) {
            if (!empty($_POST[$key])) {
                $index = (int)$_POST[$key] - 1;
                if (isset($columns[$index])) {
                    $configData .= "\$$key = \"" . $columns[$index] . "\";\n";
                }
            }
        }

        $configData .= "?>";

        file_put_contents("./config/config.php", $configData);

        echo "<div class='alert alert-success mt-3'>Configuration saved successfully!</div>";
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Match Columns & Save Config</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

<h3 class="mb-3">Database: <?= htmlspecialchars($_SESSION['db_name'] ?? 'Unknown') ?></h3>

<form method="post">
    <label for="table_name" class="form-label">Select a Table:</label>
    <select name="table_name" class="form-select mb-3">
        <?php foreach ($tables as $table): ?>
            <option value="<?= htmlspecialchars($table) ?>"><?= htmlspecialchars($table) ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit" class="btn btn-primary">Get Columns</button>
</form>

<?php if (isset($columns)): ?>
    <h3 class="mt-4">Columns in '<?= htmlspecialchars($selected_table) ?>'</h3>

    <form method="post" class="row g-3">
        <div class="col-md-6">
            <ul class="list-group">
                <?php foreach ($columns as $index => $column): ?>
                    <li class="list-group-item"><strong><?= $index + 1 ?>.</strong> <?= htmlspecialchars($column) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="website" class="form-label">Website Name:</label>
                <input type="text" name="website" class="form-control" autocomplete="off" required>
            </div>

            <div class="mb-3">
                <label for="verseTextColumn" class="form-label">Verse Text Column (Enter Number):</label>
                <input type="number" name="verseTextColumn" class="form-control" autocomplete="off" min="1" max="<?= count($columns) ?>" required>
            </div>

            <div class="mb-3">
                <label for="bookColumn" class="form-label">Book Name Column (Enter Number):</label>
                <input type="number" name="bookColumn" class="form-control" autocomplete="off" min="1" max="<?= count($columns) ?>" required>
            </div>

            <div class="mb-3">
                <label for="chapterColumn" class="form-label">Chapter Column (Enter Number):</label>
                <input type="number" name="chapterColumn" class="form-control" autocomplete="off" min="1" max="<?= count($columns) ?>" required>
            </div>

            <div class="mb-3">
                <label for="verseColumn" class="form-label">Verse Number Column (Enter Number):</label>
                <input type="number" name="verseColumn" class="form-control" autocomplete="off" min="1" max="<?= count($columns) ?>" required>
            </div>

            <div class="mb-3">
                <label for="bookIDColumn" class="form-label">Book ID Column (Enter Number):</label>
                <input type="number" name="bookIDColumn" class="form-control" autocomplete="off" min="1" max="<?= count($columns) ?>" required>
            </div>

            <button type="submit" class="btn btn-success mb-3">Save to config.php</button>
        </div>
    </form>
<?php endif; ?>

</body>
</html>
