<?php
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

// UPDATE GAME
if (isset($_POST['update'])) {
    $match_date = $_POST['match_date'];
    $match_time = $_POST['match_time'];
    $venue      = $_POST['venue'];
    $team_one   = $_POST['team_one'];
    $team_two   = $_POST['team_two'];
    $status     = $_POST['status'];

    $conn->query("UPDATE game_schedule SET
        match_date='$match_date',
        match_time='$match_time',
        venue='$venue',
        team_one='$team_one',
        team_two='$team_two',
        status='$status'
        WHERE schedule_id=$id
    ");

    header("Location: view_games.php");
    exit;
}

// FETCH GAME DATA
$result = $conn->query("SELECT * FROM game_schedule WHERE schedule_id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Game</title>

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

/* 🔧 SAME ALIGNMENT FIX */
input,
select {
    width: 100%;
    height: 48px;
    padding: 12px;
    margin-bottom: 15px;
    border: 2px solid #FFB74D;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

input:focus,
select:focus {
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
<h2>Edit Game</h2>

<form method="POST">

    <label>Match Date</label>
    <input type="date" name="match_date" value="<?= $row['match_date'] ?>" required>

    <label>Match Time</label>
    <input type="time" name="match_time" value="<?= $row['match_time'] ?>" required>

    <label>Venue</label>
    <input type="text" name="venue" value="<?= htmlspecialchars($row['venue']) ?>" required>

    <label>Team One</label>
    <input type="text" name="team_one" value="<?= htmlspecialchars($row['team_one']) ?>" required>

    <label>Team Two</label>
    <input type="text" name="team_two" value="<?= htmlspecialchars($row['team_two']) ?>" required>

    <label>Status</label>
    <select name="status" required>
        <option value="Scheduled" <?= $row['status']=="Scheduled" ? "selected" : "" ?>>Scheduled</option>
        <option value="Ongoing" <?= $row['status']=="Ongoing" ? "selected" : "" ?>>Ongoing</option>
    </select>

    <button type="submit" name="update">Update Game</button>
</form>

<a class="back" href="view_games.php">← Back to Game Schedule</a>
</div>

<?php $conn->close(); ?>
</body>
</html>
