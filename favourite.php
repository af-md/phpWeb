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

//$favSessArray = $_SESSION['favourite'];



if (isset($_GET['favouriteCampsiteID'])) /// you could post the fields really. 
{
    $favouriteCampsite = $_GET['favouriteCampsiteID'];
    if (isset($_GET['FavAction']))
    {
        $action = $_GET['FavAction'];
      if ($action == 'remove') {
            $campsiteData->removeFromFavourite($favouriteCampsite);
        }

        }
    //var_dump($favouriteCampsite);
}

$view->favCampsites = $campsiteData->getFavourite($userID); 




//var_dump($userID);
//die();

// Get the facourite ID 
//var_dump($view->campsitesFav);

//die();

require_once 'View/favourite.phtml';

