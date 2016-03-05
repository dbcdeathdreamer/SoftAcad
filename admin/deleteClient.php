<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: clients.php');
}

$clientCollection = new ClientsCollection();


$client = $clientCollection->getOne($_GET['id']);

if (is_null($client)) {
    header('Location: clients.php');
}
$clientCollection->delete($client->getId());

header('Location: clients.php');

?>