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


function createNewUser($insertData) {
    global $connection;

    $password = sha1($insertData['password']);

    $result = mysqli_query($connection, "
        INSERT INTO users
        SET
        username = '{$insertData['username']}',
        password = '{$password}',
        email = '{$insertData['email']}',
        description = '{$insertData['description']}';
    ");

}

function validateUserInput($input)
{
    $errors = array();

    if(!isset($input['username']) || strlen(trim($input['username'])) < 3 || strlen(trim($input['username'])) > 255) {
        $errors['username'] = 'Incorrect username';
    }

    return $errors;
}


function getUserById($id)
{
    global $connection;

    $result = mysqli_query($connection, "
        SELECT * FROM users WHERE id = {$id}
    ");

    $array = mysqli_fetch_assoc($result);

    return $array;
}

function editUser($id, $insertData)
{
    global $connection;

    $result = mysqli_query($connection, "
        UPDATE users
        SET
        username = '{$insertData['username']}',
        email = '{$insertData['email']}',
        description = '{$insertData['description']}'
        WHERE id = {$id}
    ");
}

function deleteUser($id)
{
    global $connection;

    $result = mysqli_query($connection, "
       DELETE FROM `users` WHERE `id`= {$id}
    ");

}

function getToursWithCategories()
{
    global $connection;

    $result = mysqli_query($connection, "
        SELECT
            t.image ,t.id as tours_id, t.description as tour_description,  t.name as tour_name,
            c.name as category_name, c.description, c.id
            FROM tours as t
            LEFT JOIN categories as c ON c.id = t.category_id
    ");


    $array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $array[] = $row;
    }

    return $array;
}

?>