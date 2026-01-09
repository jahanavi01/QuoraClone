<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;
            background: linear-gradient(135deg, #000000, #1a0000);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .login-container {
            background: #0d0d0d;
            padding: 30px;
            width: 100%;
            max-width: 380px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(255, 0, 0, 0.4);
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ff1a1a;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            color: #ff4d4d;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background: #1a1a1a;
            color: #fff;
        }

        .form-group input:focus {
            outline: none;
            border-color: #ff1a1a;
            box-shadow: 0 0 5px #ff1a1a;
        }

        .error {
            color: #ff4d4d;
            font-size: 13px;
            margin-top: 4px;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background: #ff1a1a;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background: #cc0000;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .register-link a {
            color: #ff4d4d;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn">Login</button>
    </form>

    <div class="register-link">
        Don’t have an account?
        <a href="{{ route('register') }}">Register</a>
    </div>
</div>

</body>
</html>
