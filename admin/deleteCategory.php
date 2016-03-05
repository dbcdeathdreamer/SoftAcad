<?php
require_once('common/header.php');

if (!loggedIn()) {
    header('Location: login.php');
}

if(!isset($_GET['id'])) {
    header('Location: categories.php');
}

$categoryCollection = new CategoryCollection();


$category = $categoryCollection->getOne($_GET['id']);

if (is_null($category)) {
    header('Location: categories.php');
}
$categoryCollection->delete($category->getId());

header('Location: categories.php');

?>