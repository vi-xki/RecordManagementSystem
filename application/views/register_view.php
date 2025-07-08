<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Employee Data App</title>
    <style>
        body { background: #f0f2f5; font-family: Arial; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .form-box { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 300px; }
        .form-box h2 { text-align: center; margin-bottom: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="password"] { width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
        .btn { background: #667eea; color: white; border: none; padding: 10px; width: 100%; border-radius: 4px; cursor: pointer; }
        .btn:hover { background: #5a67d8; }
        .message { text-align: center; margin-top: 10px; color: green; }
        .error { color: red; text-align: center; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Register</h2>

        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <?php if (isset($success)) echo "<div class='message'>$success</div>"; ?>

        <form method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Confirm Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button class="btn" type="submit">Register</button>
        </form>
        <p style="text-align:center; margin-top: 10px; font-size: 12px;">
            Already have an account? <a href="<?= site_url('auth/login') ?>">Login</a>
        </p>
    </div>
</body>
</html>
