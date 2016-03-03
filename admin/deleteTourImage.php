<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: users.php');
}

$imageCollection = new ToursImagesCollection();

$image = $imageCollection->getOne($_GET['id']);

if(is_null($image)) {
    header('Location: tours.php');
}

$tourId = $image->getToursId();

unlink('uploads/tours/'.$image->getImage());
$imageCollection->delete($_GET['id']);

header("Location: tourImages.php?id=".$tourId);

?>