<?php
$host = 'localhost';
$dbname = 'gestorDeLibros';
$username = 'root';
$password = '';

try{
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8",
        $username,
        $password);

} catch (PDOException $e){
    echo "Error de conexión: " . $e->getMessage();
    exit;
}