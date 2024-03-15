<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
    body {
        background-color: #f8f8f8;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .login-container {
        display: flex;
        overflow: hidden;
        width: 80%;
        max-width: 800px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        background: linear-gradient(135deg, #1e6f5c, #174a5a);
        color: #fff;
        transition: background-color 0.5s ease;
    }

    .login-container:hover {
        background: linear-gradient(135deg, #174a5a, #1e6f5c);
    }

    .logo-container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        transition: background-color 0.5s ease, transform 0.3s ease;
    }

    .logo-container img {
        max-width: 100%;
        height: auto;
    }

    .logo-container:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: scale(1.05);
    }

    .login-box {
        flex: 1;
        padding: 20px;
        text-align: center;
    }

    .login-box h2 {
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-bottom: 8px;
    }

    input {
        padding: 10px;
        margin-bottom: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
        transition: border-color 0.3s ease;
    }

    input:focus {
        border-color: #fff;
    }

    button {
        padding: 10px;
        background-color: #fff;
        color: #4CAF50;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    button:hover {
        background-color: #45a049;
        color: #fff;
    }

    .new-account-button {
        background-color: transparent;
        border: none;
        color: #fff;
        cursor: pointer;
        margin-top: 10px;
        transition: color 0.3s ease;
    }

    .new-account-button:hover {
        color: #45a049;
    }

</style>
<body>
    <div class="login-container">
        <div class="logo-container">
            <img src="/Assets/Icons/Logo (2).png" alt="Company Logo">
        </div>
        <div class="login-box">
            <h2>Login</h2>
            <form>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>

                <!-- <button class="new-account-button" onclick="redirectToNewAccountPage()">Create New Account</button> -->
            </form>
        </div>
    </div>

</body>
</html>
