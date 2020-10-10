<?php
session_start();

if (!isset($_SESSION['currentUser'])) {
    header('location:login.html');
    return;
}

$film = $_GET['id'];
$user = $_SESSION['currentUser']['user'];

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {

    $connection = new mysqli('localhost', 'DBUSER2018', 'DBPSWD2018');
    $connection->select_db('BD');

    $query = $connection->prepare('INSERT INTO FAVOURITES VALUES (?, ?)');
    $query->bind_param('ss', $user, $film);
    $query->execute();

    header('location:favoritas.php');

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header('location:error.php?mensaje=' . urlencode($e->message));
}
