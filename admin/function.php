<?php

function loggedIn()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1 && isset($_SESSION['user'])) {
        return true;
    }
    return false;
}

function getAllUsers() {
    global $connection;
    $result = mysqli_query($connection, "SELECT * FROM users");

    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    return $array;
}


?>