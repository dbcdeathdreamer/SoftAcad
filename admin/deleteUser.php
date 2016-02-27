<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: users.php');
}

$userCollection = new UserCollection();
$user = $userCollection->getOne($_GET['id']);

if(is_null($user)) {
    header('Location: users.php');
}

$userCollection->delete($user->getId());
header('Location: users.php');

?>

