<?php
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'filrouge';
// set DSN
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
// create a PDO instance
$conn = new PDO($dsn, $user, $password);
