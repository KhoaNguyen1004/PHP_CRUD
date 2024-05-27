<?php
$host = 'localhost';
$db_name = 'school';
$username = 'root';
$password = 'khoa123';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e1){
    die("Could not connect to the database $db_name : " . $e->getMessage());
}