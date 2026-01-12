<?php
$conn = new mysqli("localhost", "root", "", "basket");

$id = $_GET['id'];

$conn->query("DELETE FROM teams_data WHERE team_id=$id");

header("Location: view_teams.php");
exit;
?>
