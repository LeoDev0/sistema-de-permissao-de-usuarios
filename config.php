<?php

$dbuser = 'root';
$dbpass = '';
$dbname = 'projeto_permissao';
$dbhost = 'localhost';
$dsn = "mysql:dbname=$dbname;host=$dbhost";
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];

try {
  $pdo = new PDO($dsn, $dbuser, $dbpass, $options);
} catch (PDOException $e) {
  die('Erro: ' . $e->getMessage());
}