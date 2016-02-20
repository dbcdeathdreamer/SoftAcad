<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: users.php');
}

$db = db::getInstance();
$image = $db->get('tours_images', 'id = '.$_GET['id']);

if(is_null($image)) {
    header('Location: tours.php');
}

$tourId = $image[0]['tours_id'];

unlink('uploads/tours/'.$image[0]['image']);
$db->delete('tours_images', $_GET['id']);

header("Location: tourImages.php?id=".$tourId);

?>