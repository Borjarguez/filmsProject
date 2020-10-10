<?php
session_start();

$user = $_POST['user'];
$name = $_POST['name'];
$password = $_POST['password'];

if ($user == null || $name == null || $password == null) {
    header('location:register.html');
    return;
}

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;

try {

    $connection = new mysqli('localhost', 'DBUSER2018', 'DBPSWD2018');
    $connection->select_db('BD');

    $query = $connection->prepare('INSERT INTO USER VALUES (?, ?, SHA1(?))');
    $query->bind_param('sss', $name, $user, $password);
    $query->execute();

    $_SESSION['currentUser'] = [
        'user' => $user,
        'name' => $name
    ];

    header('location:todas.php');

    $connection->close();
} catch (mysqli_sql_exception  $e) {
    header('location:error.php?mensaje=' . urlencode($e->getMessage()));
}
