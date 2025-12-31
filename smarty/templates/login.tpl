<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    {include file="bootstrap-head.tpl"}
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-3">Login to Your Account</h2>
            <!-- <p class="text-center text-danger fw-bold">Authorized users only!</p> -->
            <p>Don't have an account? <a class="text-decoration-none" href="/register">Register here</a>.</p>
            <p class="text-info bg-dark text-start rounded p-2">Demo account: Username is <b>lux</b> and password is <b>demo</b> for CMS testing purposes.</p>
            {if isset($error)}
            <p class="text-danger text-center">{$error}</p>
            {/if}
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control autocomplete='off'" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" autocomplete='off' required>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-dark">Login</button>
                </div>
            </form>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="bookmark.tpl"}
</body>

</html>