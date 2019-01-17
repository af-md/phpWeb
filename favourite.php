<?php

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Favourites";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;


$favouritedCampsite = $_GET['favouriteCampsiteID'];

if ($userData->isUserLogged())
{
    $userIDfav = $_SESSION['id'];
}

else 
{
    echo 'You need to login first'; 
}

require_once 'View/favourite.phtml';

