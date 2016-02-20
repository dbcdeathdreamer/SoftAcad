<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: clients.php');
}

$client = $db->get('clients', "id =".$_GET['id']);

if(is_null($client[0])) {
    header('Location: clients.php');
}

$db->delete('clients', $client[0]['id']);
header('Location: clients.php');

?>