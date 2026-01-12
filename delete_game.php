<?php
$conn = new mysqli("localhost", "root", "", "basket");

$id = $_GET['id'];
$conn->query("DELETE FROM game_schedule WHERE schedule_id=$id");

header("Location: view_games.php");
exit;
?>
