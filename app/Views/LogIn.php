<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #d1c5a5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #e0d6b9;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
        }
        .google-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .google-btn img {
            width: 20px;
            margin-right: 10px;
        }
        .login-btn {
            background: #1c1c3c;
            color: white;
            width: 100%;
        }
        .cat-image {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="login-container d-flex">
                    <div class="col-md-6">
                        <h4>Login</h4>
                        <p>See your growth and get support</p>
                        <div class="google-btn mb-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" alt="Google">
                            Sign in with Google
                        </div>
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Email*</label>
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password*</label>
                                <input type="password" class="form-control" placeholder="Minimum 8 characters">
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <input type="checkbox"> Remember me
                                </div>
                                <a href="#">Forgot password?</a>
                            </div>
                            <button class="btn login-btn">Login</button>
                        </form>
                        <p class="mt-3">Not registered yet? <a href="#">Create a new account</a></p>
                    </div>
                    <div class="col-md-6 text-center">
                        <img src="https://example.com/cat-image.png" class="cat-image" alt="Cat Illustration">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
