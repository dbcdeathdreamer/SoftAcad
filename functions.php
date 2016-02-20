<?php

function loggedInClient()
{
    if (isset($_SESSION['client'])) {
        return true;
    }
    return false;
}