<?php
include 'config/connect.php';
$id = $_GET["id"];
$sql = "DELETE FROM school WHERE  IdSchool = $id ";
//  var_dump($sql);
$stmt = $conn->prepare($sql);
$stmt->execute();
  header('Location: ' . $_SERVER['HTTP_REFERER']);