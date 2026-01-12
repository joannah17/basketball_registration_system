<?php
$conn = new mysqli("localhost", "root", "", "basket");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT id, player_name, team_name, email, password, age, category FROM players");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Registration List</title>

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
    text-align: center;
    margin-top: 25px;
}

.links a {
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

.links a:hover {
    background: #FFB74D;
    color: white;
    box-shadow: 0 5px 15px rgba(0,0,0,0.25);
}

@media(max-width: 600px) {
    th, td { font-size: 14px; padding: 10px; }
}
</style>
</head>

<body>
<div class="container">
<h2>Registration List</h2>

<table>
<tr>
    <th>ID</th>
    <th>Player Name</th>
    <th>Team</th>
    <th>Email</th>
    <th>Password</th>
    <th>Age</th>
    <th>Category</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= htmlspecialchars($row['player_name']) ?></td>
    <td><?= htmlspecialchars($row['team_name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['password']) ?></td>
    <td><?= $row['age'] ?></td>
    <td><?= htmlspecialchars($row['category']) ?></td>
    <td class="actions">
        <a class="edit" href="edit_player.php?id=<?= $row['id'] ?>">Edit</a>
        <a class="delete" 
           href="delete_player.php?id=<?= $row['id'] ?>" 
           onclick="return confirm('Are you sure you want to delete this player?');">
           Delete
        </a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<div class="links">
    <a href="create_account.html">Register New Player</a>
    <a href="index.html">Home</a>
    
</div>
</div>

<?php $conn->close(); ?>
</body>
</html>
