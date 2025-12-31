<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Update Password</title>
    {include file="bootstrap-head.tpl"}
    {include file="fonts.tpl"}
    {include file="favicon.tpl"}
</head>

<body class="body-text">
    {include file="menu.tpl"}
    <div class="container mt-4">
        <h2 class="text-center mb-4">Welcome, <span class="text-danger">{$smarty.session.username}</span>!</h2>
        <p class="text-center"></p>
        <p class="text-center">Update your password below:</p>
        <!-- Messages -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 text-center">
                {if $errorMessage}
                <div class="alert alert-danger d-inline-block" role="alert">
                    {$errorMessage}
                </div>
                {/if}
                {if $successMessage}
                <div class="alert alert-success d-inline-block" role="alert">
                    {$successMessage}
                </div>
                {/if}
            </div>
        </div>
        <!-- Password Update Form -->
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <form method="POST" action="/profile" class="mb-5">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" autocomplete="off" required>
                    </div>
	            <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {include file="footer.tpl"}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    {include file="bookmark.tpl"}
</body>

</html>