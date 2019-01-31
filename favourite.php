<?php

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';


session_start();

$view = new stdClass;

$view->pageTitle= "Favourites";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;


//$favouritedCampsite = $_GET['favouriteCampsiteID'];


$userID = $_SESSION['id'];



//var_dump($userID);
//die();

// Get the facourite ID 

$view->campsitesFav = $campsiteData->getFavourite($userID);

//var_dump($view->campsitesFav);

//die();

require_once 'View/favourite.phtml';

