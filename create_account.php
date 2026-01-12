<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "basket";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<h2 class='error'>Connection Failed</h2><p>" . $conn->connect_error . "</p>");
}

// Get form data
$player_name = $_POST['player_name'] ?? '';
$team_name = $_POST['team_name'] ?? '';
$email = $_POST['email'] ?? '';
$pass = $_POST['password'] ?? '';
$age = $_POST['age'] ?? 0;
$category = $_POST['category'] ?? '';

// Insert data
$sql = "INSERT INTO players (player_name, team_name, email, password, age, category) 
        VALUES ('$player_name', '$team_name', '$email', '$pass', '$age', '$category')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Player Registration Result</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #FFE5B4;
            padding: 20px;
            margin: 0;
        }

        .container {
            background: #fff3e6;
            padding: 30px;
            border-radius: 20px;
            width: 95%;
            max-width: 600px;
            margin: auto;
            box-shadow: 0px 8px 25px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            color: #FF6F00;
            font-size: 30px;
            margin-bottom: 20px;
        }

        .success {
            color: green;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            color: red;
            font-size: 22px;
            margin-bottom: 20px;
            font-weight: bold;
        }

        a {
            display: inline-block;
            color: #FF6F00;
            background: #FFF3E6;
            padding: 12px 20px;
            border-radius: 10px;
            margin: 10px;
            text-decoration: none;
            font-weight: bold;
            border: 2px solid #FFB74D;
            transition: 0.3s;
        }

        a:hover {
            background: #FFB74D;
            color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.25);
        }
    </style>
</head>

<body>

<div class="container">

<?php
if ($conn->query($sql) === TRUE) {
    echo "<div class='success'>Registered Successfully!</div>";
} else {
    echo "<div class='error'>Error: " . $conn->error . "</div>";
}

$conn->close();
?>

<a href="create_account.html">Register New</a>
<a href="view_players.php">View Registers</a>
<a href="index.html">Home</a>

</div>

</body>
</html>
