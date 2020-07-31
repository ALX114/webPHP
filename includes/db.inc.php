<?php

include $_SERVER['DOCUMENT_ROOT'] .  '/includes/helpers.inc.php';

$name = 'MySQLConnect';
$password = 'UltraLow1337';

try
{
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb', $name, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $pdo->exec('SET NAMES "utf8"');
}
catch (PDOException $e)
{
  errorScript('Unable to connect to the database server.');
}
