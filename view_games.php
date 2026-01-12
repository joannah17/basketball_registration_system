<?php 
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("
    SELECT g.*, 
           t1.coach_name AS team_one_name,
           t2.coach_name AS team_two_name
    FROM game_schedule g
    LEFT JOIN teams_data t1 ON g.team_one = t1.team_id
    LEFT JOIN teams_data t2 ON g.team_two = t2.team_id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Game Schedule</title>

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
    max-width: 1300px;
    margin: auto;
    box-shadow: 0px 8px 25px rgba(0,0,0,0.2);
}

h2 {
    text-align: center;
    color: #FF6F00;
    font-size: 32px;
    margin-bottom: 25px;
}

table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 12px;
    overflow: hidden;
}

th {
    background: #FF6F00;
    color: white;
    padding: 14px;
    font-size: 16px;
}

td {
    padding: 12px;
    text-align: center;
    background: #fff;
    border-bottom: 1px solid #FFB74D;
}

tr:nth-child(even) {
    background: #fff8f0;
}

tr:hover {
    background: #FFE0B2;
}

.actions a {
    text-decoration: none;
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: bold;
    margin: 0 4px;
    font-size: 14px;
}

.edit {
    background: #FFB74D;
    color: #000;
}

.delete {
    background: #E53935;
    color: white;
}

.edit:hover {
    background: #FF9800;
}

.delete:hover {
    background: #C62828;
}

.links {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
    margin-top: 25px;
}

.links a {
    display: inline-block;
    color: #FF6F00;
    background: #FFF3E6;
    padding: 12px 25px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: bold;
    border: 2px solid #FFB74D;
    transition: 0.3s;
}

.links a:hover {
    background: #FF6F00;
    color: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    transform: translateY(-2px);
}

@media(max-width: 600px) {
    th, td { font-size: 14px; padding: 10px; }
}
</style>
</head>

<body>
<div class="container">
<h2>Game Schedule</h2>

<table>
<tr>
    <th>ID</th>
    <th>Date</th>
    <th>Time</th>
    <th>Venue</th>
    <th>Team One</th>
    <th>Team Two</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php 
if ($result && $result->num_rows > 0):
    while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['schedule_id'] ?></td>
    <td><?= $row['match_date'] ?></td>
    <td><?= $row['match_time'] ?></td>
    <td><?= htmlspecialchars($row['venue']) ?></td>
    <td><?= htmlspecialchars($row['team_one_name'] ?? $row['team_one']) ?></td>
    <td><?= htmlspecialchars($row['team_two_name'] ?? $row['team_two']) ?></td>
    <td><?= htmlspecialchars($row['status']) ?></td>
    <td class="actions">
        <a class="edit" href="edit_game.php?id=<?= $row['schedule_id'] ?>">Edit</a>
        <a class="delete"
           href="delete_game.php?id=<?= $row['schedule_id'] ?>"
           onclick="return confirm('Are you sure you want to delete this game?');">
           Delete
        </a>
    </td>
</tr>
<?php 
    endwhile;
else:
    echo "<tr><td colspan='8'>No games found</td></tr>";
endif;
?>
</table>

<div class="links">
    <a href="game_form.html">Add New Game</a>
    <a href="create_account.html">Back to Registration</a>
    <a href="index.html">Home</a>
</div>
</div>

<?php $conn->close(); ?>
</body>
</html>
