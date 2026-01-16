<?php
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

// UPDATE PLAYER
if (isset($_POST['update'])) {
    $player_name = $_POST['player_name'];
    $team_name   = $_POST['team_name'];
    $email       = $_POST['email'];
    $password    = $_POST['password'];
    $age         = $_POST['age'];
    $category    = $_POST['category'];

    $conn->query("UPDATE players SET
        player_name='$player_name',
        team_name='$team_name',
        email='$email',
        password='$password',
        age='$age',
        category='$category'
        WHERE id=$id
    ");

    header("Location: view_players.php");
    exit;
}

// FETCH PLAYER DATA
$result = $conn->query("SELECT * FROM players WHERE id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Player</title>

<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #FFE5B4;
    padding: 20px;
    margin: 0;
}

.container {
    background: #fff3e6;
    padding: 35px;
    border-radius: 20px;
    width: 95%;
    max-width: 700px;
    margin: auto;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.2);
}

h2 {
    text-align: center;
    color: #FF6F00;
    font-size: 32px;
    margin-bottom: 30px;
}

label {
    font-weight: bold;
    color: #555;
    display: block;
    margin: 10px 0 5px;
}

/* 🔧 FIXED ALIGNMENT HERE */
input, select {
    width: 100%;
    height: 48px;
    padding: 12px;
    margin-bottom: 15px;
    border: 2px solid #FFB74D;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

input:focus, select:focus {
    border-color: #FF6F00;
    box-shadow: 0 0 8px rgba(255,111,0,0.4);
    outline: none;
}

button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(45deg, #FF6F00, #FFB74D);
    color: white;
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.25);
}

.back {
    display: block;
    text-align: center;
    margin-top: 20px;
    color: #FF6F00;
    font-weight: bold;
    text-decoration: none;
}
</style>
</head>

<body>
<div class="container">
<h2>Edit Player</h2>

<form method="POST">
    <label>Player Name</label>
    <input type="text" name="player_name" value="<?= htmlspecialchars($row['player_name']) ?>" required>

    <label>Team Name</label>
    <input type="text" name="team_name" value="<?= htmlspecialchars($row['team_name']) ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>

    <label>Password</label>
    <input type="text" name="password" value="<?= htmlspecialchars($row['password']) ?>" required>

    <label>Age</label>
    <input type="number" name="age" value="<?= $row['age'] ?>" required>

    <label>Category</label>
    <select name="category" required>
        <option value="UNDER 19" <?= $row['category']=="UNDER 19" ? "selected" : "" ?>>UNDER 19</option>
        <option value="UNDER 30" <?= $row['category']=="UNDER 30" ? "selected" : "" ?>>UNDER 30</option>
    </select>

    <button type="submit" name="update">Update Player</button>
</form>

<a class="back" href="view_players.php">Back to Players List</a>
</div>

<?php $conn->close(); ?>
</body>
</html>
