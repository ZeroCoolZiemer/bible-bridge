<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS'])) ini_set('session.cookie_secure', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset(); 

    $host = $_POST['host'];
    $dbname = $_POST['dbname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $versionName = trim($_POST['version_name']);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $_SESSION['db_host'] = $host;
        $_SESSION['db_name'] = $dbname;
        $_SESSION['db_user'] = $username;
        $_SESSION['db_pass'] = $password;
        $_SESSION['db_version_name'] = $versionName;

        header("Location: match-columns.php");
        exit();
    } catch (PDOException $e) {
        $error = "Connection failed: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BibleBridge Framework - Add New Database</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="text-danger border-bottom pb-2 mb-4">Add Bible Database</h2>
                        
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                        <?php endif; ?>

                        <div class="alert alert-info small">
                            Adding a database will append it to your <code>./config/config.php</code> file. 
                            Ensure the directory is writable.
                        </div>

                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bible Version Name:</label>
                                <small class="text-muted d-block mb-1">(e.g., KJV, NIV, MSG)</small>
                                <input type="text" class="form-control" name="version_name" placeholder="KJV" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Host:</label>
                                <input type="text" class="form-control" name="host" value="127.0.0.1" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Database Name:</label>
                                <input type="text" class="form-control" name="dbname" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Username:</label>
                                <input type="text" class="form-control" name="username" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold">Password:</label>
                                <input type="password" class="form-control" name="password" autocomplete="off">
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Connect & Map Columns</button>
                                <a href="index.php" class="btn btn-link btn-sm text-decoration-none">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
                <p class="text-center mt-4 text-muted small">BibleBridge Multi-DB Setup</p>
            </div>
        </div>
    </div>
</body>
</html>