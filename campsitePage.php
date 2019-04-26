<?php

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Campsite Page";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

if (isset($_GET['hshid'])) {
    //$campsiteID = $_SESSION['campsiteID']; 
    // $campsiteID = 1; 
    $hashID = $_GET['hshid'];
    $checkWebScrap = false; 

    $campsiteArraySizeSearched =   $_SESSION['campsiteID']; 

    // The below Conditional statements are used to go around the "OFFSET NOT FOUND" error, which can occurr if the campsiteArraySizeSearched variable has less elements in the below for loop break up number. 
    if (sizeof($campsiteArraySizeSearched) == 1 ) {
        # code...
        $safeNet = 1; 
    }
    elseif (sizeof($campsiteArraySizeSearched) == 2) {
        # code...
        $safeNet = 2;
    }
    elseif (sizeof($campsiteArraySizeSearched) == 3) {
        # code...
        $safeNet = 3;
    }
    elseif (sizeof($campsiteArraySizeSearched) == 4) {
        # code...
        $safeNet = 4;
    }
    elseif (sizeof($campsiteArraySizeSearched) == 5) {
        # code...
        $safeNet = 5;
    }

    for ($i=0; $i < $safeNet ; $i++) { 
        # code...

          $diffCampsiteID = $_SESSION['campsiteID'][$i];

        if(password_verify($diffCampsiteID, $hashID))
    {
        $campsite = $campsiteData->getCampsite($diffCampsiteID);
        $checkWebScrap = true; 
    }
    // else {
    //     $checkWebScrap = false; 
    // }
    }
    if($checkWebScrap)
    {
       //$campsite = $campsiteData->getCampsite($campsiteID);
    }
    else {
        header('Location:errorPage.php');
    }  
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
