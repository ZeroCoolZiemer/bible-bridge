<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS'])) ini_set('session.cookie_secure', 1);

session_start();

if (!isset($_SESSION['db_host'])) {
    die("Database connection not established. <a href='setup.php'>Go back</a>");
}

$cacheKey = 'book_titles_cache';
if (function_exists('apcu_enabled') && apcu_enabled() && apcu_exists($cacheKey)) {
    apcu_delete($cacheKey);
}

$setupComplete = false;
$dbNameDisplay = $_SESSION['db_name'];

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

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_config']) && isset($columns)) {
        
        $configData = "<?php\n";
        $configData .= "\$dbHost = " . var_export($_SESSION['db_host'], true) . ";\n";
        $configData .= "\$dbName = " . var_export($_SESSION['db_name'], true) . ";\n";
        $configData .= "\$dbUsername = " . var_export($_SESSION['db_user'], true) . ";\n";
        $configData .= "\$dbPassword = " . var_export($_SESSION['db_pass'], true) . ";\n";
        $configData .= "\$tableName = " . var_export($_SESSION['selected_table'], true) . ";\n";
        $configData .= "\$website = " . var_export("//" . rtrim($_POST['website'], '/') . "/", true) . ";\n";

        $column_fields = [
            'verseTextColumn' => 'Verse Text Column',
            'bookColumn'      => 'Book Column',
            'chapterColumn'   => 'Chapter Column',
            'verseColumn'     => 'Verse Column',
            'bookIDColumn'    => 'Book ID Column'
        ];

        foreach ($column_fields as $key => $desc) {
            if (!empty($_POST[$key])) {
                $index = (int)$_POST[$key] - 1;
                if (isset($columns[$index])) {
                    $configData .= "\$$key = " . var_export($columns[$index], true) . ";\n";
                }
            }
        }
        $configData .= "?>";

        if (file_put_contents("./config/config.php", $configData)) {
            $setupComplete = true;
            $_SESSION = [];
            session_destroy();
        } else {
            $error = "Failed to write config.php. Check permissions.";
        }
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
    <title>Match Columns - BibleBridge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <?php if ($setupComplete): ?>
        <div class="row justify-content-center">
            <div class="col-md-8 text-center border p-5 shadow-lg rounded bg-white">
                <div class="alert alert-success">
                    <h2 class="display-6">Configuration Saved!</h2>
                    <p class='lead'>Connected to <strong><?= htmlspecialchars($dbNameDisplay) ?></strong>.</p>
                </div>
                <hr>
                <p class="text-danger fw-bold fs-5">ACTION REQUIRED:</p>
                <p class="mb-4">Delete <b>setup.php</b> and <b>match-columns.php</b> immediately for security.</p>
                <a href="index.php" class="btn btn-primary btn-lg px-5">Go to Website</a>
            </div>
        </div>
    <?php else: ?>
        <h3 class="mb-3">Database: <?= htmlspecialchars($dbNameDisplay) ?></h3>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post" class="mb-4 shadow-sm p-3 bg-light border rounded">
            <label class="form-label fw-bold">Step 1: Select Your Bible Table</label>
            <div class="input-group">
                <select name="table_name" class="form-select">
                    <?php foreach ($tables as $table): ?>
                        <option value="<?= htmlspecialchars($table) ?>" <?= (isset($selected_table) && $selected_table == $table) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($table) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn btn-primary">Fetch Columns</button>
            </div>
        </form>

        <?php if (isset($columns)): ?>
            <form method="post" class="row g-4">
                <input type="hidden" name="save_config" value="1">
                
                <div class="col-md-5">
                    <div class="card h-100">
                        <div class="card-header bg-dark text-white">Detected Columns</div>
                        <ul class="list-group list-group-flush small">
                            <?php foreach ($columns as $index => $column): ?>
                                <li class="list-group-item"><strong><?= $index + 1 ?>.</strong> <?= htmlspecialchars($column) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>

                <div class="col-md-7">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Step 2: Map to Framework</h5>
                            
                            <div class="mb-3">
                                <label class="form-label">Website URL:</label>
                                <input type="text" name="website" class="form-control" placeholder="holybible.com" required>
                            </div>

                            <div class="row g-3">
                                <div class="col-6">
                                    <label class="form-label small">Verse Text (#):</label>
                                    <input type="number" name="verseTextColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label small">Book Name (#):</label>
                                    <input type="number" name="bookColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label small">Chapter (#):</label>
                                    <input type="number" name="chapterColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label small">Verse (#):</label>
                                    <input type="number" name="verseColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                                </div>
                                <div class="col-4">
                                    <label class="form-label small">Book ID (#):</label>
                                    <input type="number" name="bookIDColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Save & Finish Setup</button>
                        </div>
                    </div>
                </div>
            </form>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
