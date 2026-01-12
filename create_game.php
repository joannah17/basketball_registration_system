<?php
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("<h2 class='error'>Connection Failed</h2><p>" . $conn->connect_error . "</p>");
}

$match_date = $_POST['match_date'];
$match_time = $_POST['match_time'];
$venue = $_POST['venue'];
$team_one = $_POST['team_one'];
$team_two = $_POST['team_two'];
$status = $_POST['status'];

$sql = "INSERT INTO game_schedule (match_date, match_time, venue, team_one, team_two, status)
        VALUES ('$match_date', '$match_time', '$venue', '$team_one', '$team_two', '$status')";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game Creation Result</title>

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
if ($conn->query($sql)) {
    echo "<div class='success'>Game Added Successfully!</div>";
} else {
    echo "<div class='error'>Error: " . $conn->error . "</div>";
}

$conn->close();
?>

<a href="games_form.html">Add Another Game</a>
<a href="view_games.php">View All Games</a>
<a href="index.html">Home</a>

</div>

</body>
</html>
