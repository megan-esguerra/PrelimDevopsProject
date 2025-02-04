<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Your Password</h2>

    <?php if (isset($validation)): ?>
        <p style="color:red"><?= $validation->listErrors() ?></p>
    <?php endif; ?>

    <form action="<?= site_url('/reset-password/' . $token) ?>" method="post">
        <?= csrf_field() ?>
        <label>New Password</label>
        <input type="password" name="password" required>
        
        <label>Confirm Password</label>
        <input type="password" name="confirm_password" required>
        
        <button type="submit">Update Password</button>
    </form>
</body>
</html>
