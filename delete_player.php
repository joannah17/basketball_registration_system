<?php
$conn = new mysqli("localhost", "root", "", "basket");

$id = $_GET['id'];

$conn->query("DELETE FROM players WHERE id=$id");

header("Location: view_players.php");
$conn->close();
?>
