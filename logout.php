<?php
session_start();
unset($_SESSION['client']);
header('Location: login.php');
//session_destroy();
?>