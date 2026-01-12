<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Team Creation Result</title>

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
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("<h2 class='error'>Connection Failed</h2><p>" . $conn->connect_error . "</p>");
}

$sex = $_POST['sex'];
$coach_name = $_POST['coach_name'];
$home_city = $_POST['home_city'];
$founded_year = $_POST['founded_year'];
$team_rank = $_POST['team_rank'];
$league_level = $_POST['league_level'];

$sql = "INSERT INTO teams_data (sex, coach_name, home_city, founded_year, team_rank, league_level)
        VALUES ('$sex', '$coach_name', '$home_city', '$founded_year', '$team_rank', '$league_level')";

if ($conn->query($sql)) {
    echo "<div class='success'>Team Created Successfully!</div>";
} else {
    echo "<div class='error'>Error: " . $conn->error . "</div>";
}

$conn->close();
?>

<a href="teams_form.html">Create Another Team</a>
<a href="view_teams.php">View All Teams</a>
<a href="index.html">Home</a>

</div>

</body>
</html>
