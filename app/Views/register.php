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
            max-width: 700px;
            margin: 60px auto 20px; 
            padding: 20px;
            border-radius: 10px;
          
            position: relative;
            z-index: 1;
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
        label {
            display: block;
            margin-bottom: 5px;
            color: #041a4a;
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"], input[type="tel"] {
            width: 84%;
            padding: 15px;
            background-color: #ecebde; 
            border: 1px solid #8f8f8f; 
            border-radius: 5px;
            margin-bottom: 23px;
            height: 28%;
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
           font-weight: bold;
           color: #041a4a;
           font-size: 18px;
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
            margin-top: -20px;
            margin-bottom: 20px;
        }
    </style>
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
    </script>
</head>
<body>
    <div class="container">
        <h1 class="highlight">Register</h1>
        <p class="highlight">Manage all your inventory efficiently.</p>
        <p style="color:#272626;">Let's get you all set up so you can verify your personal account and begin setting up your work profile.</p>

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
                    <input type="text" name="first_name" id="first_name" value="<?= old('first_name') ?>" placeholder="Enter your name" style="padding-right: 10px;" pattern=".{2,}" title="First name must be at least 2 characters long" required>
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
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" pattern=".{8,}" title="Password must be at least 8 characters long" required>
            </div>
            <div class="form-group terms-container">
                <input type="checkbox" name="terms" id="terms" required>
                <label for="terms">I agree to all terms, privacy policies, and fees</label>
            </div>
            <button type="submit">Sign up</button>
        </form>

        <p>Already have an account? <a href="<?= site_url('/login') ?>" class="login-link">Log in</a></p>
    </div>
    <img src="<?= base_url('images/Cat.png') ?>" alt="Cat" class="cat-image">
</body>
</html>