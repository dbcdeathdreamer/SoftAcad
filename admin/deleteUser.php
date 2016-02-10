<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: users.php');
}

$user = getUserById($_GET['id']);

if(is_null($user)) {
    header('Location: users.php');
}

deleteUser($user['id']);
header('Location: users.php');

?>

