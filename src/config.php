<?php
$host_name = 'host_name';
$database = 'database';
$user_name = 'user_name';
$password = 'password';

$link = new mysqli($host_name, $user_name, $password, $database);

if ($link->connect_error) {
  die('<p>Verbindung zum MySQL Server fehlgeschlagen: '. $link->connect_error .'</p>');
}
?>