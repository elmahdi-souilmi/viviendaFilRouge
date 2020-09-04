<?php
include 'config/connect.php';
$id = $_GET["id"];
$sql = "DELETE FROM user WHERE  IdUser= $id ";
//get result
$stmt = $conn->prepare($sql);
$stmt->execute();
header('Location: ' . $_SERVER['HTTP_REFERER']);
