<?php 

// required files in the controller
session_start();
require_once 'Model/UserDataSet.php';
require_once 'Model/CampsiteDataSet.php';
$view = new stdClass();
// Logic to get the users out from the database and being able to display them

//$userData = new UserDataSet();

$campsiteData = new CampsiteDataSet();  

$view->campsites = $campsiteData->fetchCampsites(); 

// Logic to delete users 

if(isset($_GET['id']))
{
    $campsiteID = $_GET['id']; 

    $campsiteData->removeCampsite($campsiteID);
}


require_once 'View/campsiteAdminCampsite.phtml';

