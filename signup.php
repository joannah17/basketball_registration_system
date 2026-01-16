<?php

$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $fullname = $_POST['fullname'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $conn->query("INSERT INTO users (fullname, email, password)
                  VALUES ('$fullname', '$email', '$password')");

    header("Location: create_account.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign Up</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFE5B4;
}

.container {
    background: #fff3e6;
    border-radius: 15px;
    padding: 40px 30px;
    width: 400px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    text-align: center;
}

h2 {
    color: #FF6F00;
    font-size: 28px;
    margin-bottom: 20px;
}

input {
    width: 100%;
    height: 48px;
    padding: 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: 2px solid #FFB74D;
    font-size: 15px;
    box-sizing: border-box;
}

input:focus {
    border-color: #FF6F00;
    outline: none;
    box-shadow: 0 0 8px rgba(255,111,0,0.4);
}

button {
    width: 100%;
    height: 50px;
    background: linear-gradient(45deg, #FF6F00, #FFB74D);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(45deg, #FFB74D, #FF6F00);
    transform: translateY(-2px);
}

.back {
    display: block;
    margin-top: 20px;
    color: #FF6F00;
    font-weight: bold;
    text-decoration: none;
}
</style>
</head>

<body>

<div class="container">
    <h2>Create Account</h2>

    <form method="POST">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="signup">Sign Up</button>
    </form>

    <a class="back" href="login.php">Back to Login</a>
</div>

</body>
</html>
