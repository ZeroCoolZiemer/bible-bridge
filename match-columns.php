<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS'])) ini_set('session.cookie_secure', 1);

session_start();

if (!isset($_SESSION['db_host']) || !isset($_SESSION['db_version_name'])) {
    die("Database connection not established. <a href='setup.php'>Go back to Setup</a>");
}

$versionName = $_SESSION['db_version_name'];
$dbNameDisplay = $_SESSION['db_name'];
$setupComplete = false;

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
        if (in_array($selected_table, $tables)) {
            $stmt = $pdo->prepare("SHOW COLUMNS FROM `$selected_table`");
            $stmt->execute();
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        } else {
            unset($_SESSION['selected_table']);
            $selected_table = null;
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save_config']) && isset($columns)) {
        $configFile = "./config/config.php";
        $bibles = [];
        if (file_exists($configFile)) {
            include($configFile); 
        }

        $mappings = [];
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
                    $mappings[$key] = $columns[$index];
                }
            }
        }
	$bible_permissions = trim($_POST['bible_permissions']);

	$mappings['permissions'] = $bible_permissions;

        $bibles[$versionName] = [
            'dbHost'     => $_SESSION['db_host'],
            'dbName'     => $_SESSION['db_name'],
            'dbUser'     => $_SESSION['db_user'],
            'dbPass'     => $_SESSION['db_pass'],
            'tableName'  => $_SESSION['selected_table'],
            'website'    => "//" . rtrim($_POST['website'], '/') . "/",
            'mappings'   => $mappings
        ];

        $configData = "<?php\n\n";
        $configData .= "\$bibles = " . var_export($bibles, true) . ";\n\n";
        $configData .= "?>";

        if (file_put_contents($configFile, $configData)) {
            $setupComplete = true;
            session_unset();
            session_destroy();
        } else {
            $error = "Failed to write config.php. Check directory permissions.";
        }
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
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
            <h2 class="display-6">Version Saved!</h2>
            <p class='lead'><strong><?= htmlspecialchars($versionName) ?></strong> has been added to your configuration.</p>
        </div>
        <hr>
        <div class="d-grid gap-2 d-md-block">
            <a href="setup.php" class="btn btn-outline-primary btn-lg px-4">Add Another Bible</a>
            <a href="index.php" class="btn btn-success btn-lg px-4">Go to Website</a>
        </div>
    </div>
</div>
<?php else: ?>
<h3 class="mb-1">Setup Version: <span class="text-primary"><?= htmlspecialchars($versionName) ?></span></h3>
<p class="text-muted mb-4">Connected to database: <code><?= htmlspecialchars($dbNameDisplay) ?></code></p>

<?php if (isset($error)): ?>
<div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="post" class="mb-4 shadow-sm p-3 bg-light border rounded">
    <label class="form-label fw-bold">Step 1: Select the Bible Table for this Version</label>
    <div class="input-group">
        <select name="table_name" class="form-select">
            <option value="" disabled <?= !isset($selected_table) ? 'selected' : '' ?>>-- Choose Table --</option>
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

    <div class="col-md-4">
        <div class="card h-100 border-dark">
            <div class="card-header bg-dark text-white">Detected Columns</div>
            <ul class="list-group list-group-flush small">
                <?php foreach ($columns as $index => $column): ?>
                <li class="list-group-item"><strong><?= $index + 1 ?>.</strong> <?= htmlspecialchars($column) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card h-100 shadow-sm border-primary">
            <div class="card-body">
                <h5 class="card-title mb-4">Step 2: Map to Framework</h5>

                <div class="mb-3">
                    <label class="form-label fw-bold">Website Name/URL:</label>
                    <input type="text" name="website" class="form-control" placeholder="holybible.com" required>
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-primary">Verse Text (Column #):</label>
                        <input type="number" name="verseTextColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold text-primary">Book Name (Column #):</label>
                        <input type="number" name="bookColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Chapter (Column #):</label>
                        <input type="number" name="chapterColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Verse (Column #):</label>
                        <input type="number" name="verseColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-bold">Book ID (Column #):</label>
                        <input type="number" name="bookIDColumn" class="form-control" min="1" max="<?= count($columns) ?>" required>
                    </div>
		    <div class="col-12">
    			<label class="form-label fw-bold">Bible Permissions:</label>
    			<input type="text" name="bible_permissions" class="form-control" required
           		value="<?= isset($_POST['bible_permissions']) ? htmlspecialchars($_POST['bible_permissions']) : '' ?>">
    		    <div class="form-text">Example: King James Version (Public Domain)</div>
		    </div>
                </div>
                <button type="submit" class="btn btn-success btn-lg w-100 mt-4">Save Version Details</button>
            </div>
        </div>
    </div>
</form>
<?php endif; ?>
<?php endif; ?>

</body>
</html>



