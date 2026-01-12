<?php
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;

// UPDATE TEAM
if (isset($_POST['update'])) {
    $sex     = $_POST['sex'];
    $coach  = $_POST['coach_name'];
    $city   = $_POST['home_city'];
    $year   = $_POST['founded_year'];
    $rank   = $_POST['team_rank'];
    $league = $_POST['league_level'];

    $conn->query("UPDATE teams_data SET
        sex='$sex',
        coach_name='$coach',
        home_city='$city',
        founded_year='$year',
        team_rank='$rank',
        league_level='$league'
        WHERE team_id=$id
    ");

    header("Location: view_teams.php");
    exit;
}

// FETCH TEAM DATA
$result = $conn->query("SELECT * FROM teams_data WHERE team_id=$id");
$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Team</title>

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

/* 🔧 SAME ALIGNMENT FIX AS EDIT PLAYER */
input {
    width: 100%;
    height: 48px;
    padding: 12px;
    margin-bottom: 15px;
    border: 2px solid #FFB74D;
    border-radius: 8px;
    font-size: 15px;
    box-sizing: border-box;
}

input:focus {
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
<h2>Edit Team</h2>

<form method="POST">
    <label>Sex</label>
    <input type="text" name="sex" value="<?= htmlspecialchars($row['sex']) ?>" required>

    <label>Coach Name</label>
    <input type="text" name="coach_name" value="<?= htmlspecialchars($row['coach_name']) ?>" required>

    <label>Home City</label>
    <input type="text" name="home_city" value="<?= htmlspecialchars($row['home_city']) ?>" required>

    <label>Founded Year</label>
    <input type="number" name="founded_year" value="<?= $row['founded_year'] ?>" required>

    <label>Team Rank</label>
    <input type="number" name="team_rank" value="<?= $row['team_rank'] ?>" required>

    <label>League Level</label>
    <input type="text" name="league_level" value="<?= htmlspecialchars($row['league_level']) ?>" required>

    <button type="submit" name="update">Update Team</button>
</form>

<a class="back" href="view_teams.php">← Back to Teams List</a>
</div>

<?php $conn->close(); ?>
</body>
</html>
