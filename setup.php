<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
if (isset($_SERVER['HTTPS'])) ini_set('session.cookie_secure', 1);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = $_POST['host'];
    $dbname = $_POST['dbname'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Store credentials in session
        $_SESSION['db_host'] = $host;
        $_SESSION['db_name'] = $dbname;
        $_SESSION['db_user'] = $username;
        $_SESSION['db_pass'] = $password;

        header("Location: match-columns.php");
        exit();
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Connection failed: " . $e->getMessage() . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BibleBridge Framework Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-6">
                <h2 class="text-danger">BibleBridge Framework Setup</h2>
                <form method="post">
                    <div class="alert alert-danger d-inline-block" role="alert">
                    The permissions of <b>./config/config.php</b> must be writable during the setup process.
		    For comprehensive installation instructions, please refer to the README.md documentation.</div>
                   
                    <div class="mb-3">
                        <label for="host" class="form-label"><b>Host</b>:</label>
			<small class="text-muted">(usually <code>127.0.0.1</code> or <code>localhost</code>)</small>
                        <input type="text" class="form-control" id="host" name="host" value="127.0.0.1" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="dbname" class="form-label">Database Name:</label>
                        <input type="text" class="form-control" id="dbname" name="dbname" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" required autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="off">
                    </div>
		    <div class="text-center">
                    <button type="submit" class="btn btn-primary d-inline-block">Test Connection</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>

