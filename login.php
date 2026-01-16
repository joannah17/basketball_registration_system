<?php
session_start();
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");

    if ($result->num_rows == 1) {
        $_SESSION['email'] = $email;
        header("Location: signup.php");
        exit;
    } else {
        $error = "Invalid email or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>

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

/* Signup button style */
.signup-btn {
    display: block;
    width: 100%;
    height: 50px;
    line-height: 50px;
    background: linear-gradient(45deg, #FF6F00, #FFB74D);
    color: white;
    font-size: 16px;
    font-weight: bold;
    border-radius: 12px;
    text-decoration: none;
    margin-top: 15px;
    transition: 0.3s;
}

.signup-btn:hover {
    background: linear-gradient(45deg, #FFB74D, #FF6F00);
    transform: translateY(-2px);
}

.error {
    color: #D32F2F;
    margin-bottom: 15px;
    font-weight: bold;
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
    <h2>Login</h2>

    <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
    </form>

    <a href="signup.php" class="signup-btn">Sign Up</a>
    <a href="index.html" class="back"> Back to Home</a>
</div>

</body>
</html>
