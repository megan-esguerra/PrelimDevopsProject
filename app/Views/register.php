<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="<?= base_url('img/tabicon.png'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
           font-family: 'Karla', sans-serif;
           background-color: rgb(199, 190, 162);
           background-image: url('<?= base_url('images/bg.png') ?>');
           background-size: cover;
           background-repeat: no-repeat;
           background-position: center;
           margin: 0;
           padding: 0;
           display: flex;
           flex-direction: column;
           justify-content: center;
           align-items: center;
           height: 100vh;
           position: relative;
        }  
        .container {
            margin: 67px auto 18px;
            padding: 30px;
            border-radius: 10px;
            position: relative;
            z-index: 1;
            margin-bottom: 6rem;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
            background: linear-gradient(to bottom right, #e0d6b9, #b3a588);
            width: 49rem;
            border: 3px solid;
        }
        .form-group {
            margin-bottom: 4px;
            width: 110%;
        }
        .form-row {
            display: flex;
            gap: 20px;
        }
        .form-row .form-group {
            flex: 1;
            margin-top: 1rem;
        }
        .form-row .form-group.half-width {
            flex: 0.5;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #041a4a;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"], select {
            width: 90%;
            padding: 15px;
            background-color: #ecebde;
            border: 2px solid #271f19;
            border-radius: 5px;
            margin-bottom: 1px;
            height: 22%;
            font-size: 17px;
            font-family: 'Karla', sans-serif;
        }
        button {
            background-color: #2c2a25;
            color: #fff;
            padding: 10px 40px;
            border: none;
            border-radius: 11px;
            cursor: pointer;
            height: 50px;
            width: 12rem;
            font-family: 'Karla', sans-serif;
            font-size: 14px;
            margin-top: 1rem;
        }
        button:hover {
            background-color: #1c1b18;
        }
        h1.highlight {
           font-size: 35px;
        }
       .highlight {
        color: #041a4a;
        font-size: 15px;
        }
        .terms-container {
            display: flex;
            align-items: center;
        }
        .terms-container label {
            margin-left: 10px;
            margin-bottom: 0;
        }
        .login-link {
            font-weight: bold;
            text-decoration: none;
            color: #2a2a72;
        }
        .cat-image {
            margin-top: -292px;
            width: 420px;
            opacity: 0.8;
        }
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 2px;
            margin-bottom: 20px;
        }
        select#role {
            height: 64%;
            width: 100%;
            font-family: 'Karla', sans-serif;
        }
    </style>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6LesE8wqAAAAAFGQb8owvb9VoWoM7tSeaFbcv296"></script>
    <script>
        function validatePhoneNumber() {
            const phoneInput = document.getElementById('phone');
            const errorMessage = document.getElementById('phone-error');
            if (phoneInput.value.length < 11) {
                errorMessage.textContent = 'The phone field must be at least 11 characters in length.';
            } else {
                errorMessage.textContent = '';
            }
        }

        function updateRoleDisplay() {
            const roleSelect = document.getElementById('role');
            const selectedRole = roleSelect.options[roleSelect.selectedIndex].text;
            roleSelect.setAttribute('title', selectedRole);
        }

        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            roleSelect.addEventListener('change', updateRoleDisplay);
            updateRoleDisplay(); 
        });
    </script>
</head>
<body>
    <div class="container">
        <h1 class="highlight">Register</h1>
        <p class="highlight">Manage all your inventory efficiently.</p>
     
        <form action="<?= site_url('/register/store') ?>" method="post">
            <?= csrf_field() ?>
            <?php if (session()->getFlashdata('errors')): ?>
                <ul>
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div class="form-row">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" id="first_name" value="<?= old('first_name') ?>" placeholder="Enter your first name" style="padding-right: 10px;" pattern=".{2,}" title="First name must be at least 2 characters long" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" id="last_name" value="<?= old('last_name') ?>" placeholder="Enter your last name" style="padding-left: 10px;" pattern=".{2,}" title="Last name must be at least 2 characters long" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= old('email') ?>" placeholder="Enter your email" pattern="[a-z0-9._%+-]+@gmail\.com$" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" value="<?= old('phone') ?>" placeholder="Minimum 11 characters" minlength="11" maxlength="11" pattern="[0-9]+" required oninput="this.value = this.value.replace(/[^0-9]/g, ''); validatePhoneNumber();">
                    <div id="phone-error" class="error-message"></div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group half-width">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" pattern=".{8,}" title="Password must be at least 8 characters long" required>
                </div>
                <div class="form-group half-width">
                    <label for="role">Role</label>
                    <select name="role" id="role" required>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group terms-container">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">I agree to all terms, privacy policies, and fees</label>
            </div>
            <button type="submit">Sign up</button>
        </form>

        <p>Already have an account? <a href="<?= site_url('/LogIn') ?>" class="login-link">Log in</a></p>
    </div>
    <img src="<?= base_url('images/Cat.png') ?>" alt="Cat" class="cat-image">
</body>
</html>