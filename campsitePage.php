<?php

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Single Campsite Page";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

if (isset($_GET['campsiteID'])) {
    $campsiteID = $_GET['campsiteID'];
    $campsite = $campsiteData->getCampsite($campsiteID);
}

if (isset($_POST['submit'])) {
    $campsiteID = $_POST['campsiteID']; 
    $ratingValue = $_POST['rating-input-5'];
    if ($ratingValue == 'rating-input-1-1-5') {
        $ratingValue = 1;   
    }
    elseif ($ratingValue == 'rating-input-1-2-5') {
        # code...
        $ratingValue = 2;
    }
    elseif ($ratingValue == 'rating-input-1-3-5') {
        # code...
        $ratingValue = 3;
    }
    elseif ($ratingValue == 'rating-input-1-4-5') {
        # code...
        $ratingValue = 4;
    }
    elseif ($ratingValue == 'rating-input-1-5-5') {
        # code...
        $ratingValue = 5;
    }
    $campsiteData->insertRating($campsiteID, $ratingValue); 
}



require_once 'View/campsitePage.phtml';
