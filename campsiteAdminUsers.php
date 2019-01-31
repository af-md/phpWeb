<?php 

// required files in the controller


session_start();
require_once 'Model/UserDataSet.php';
require_once 'Model/CampsiteDataSet.php';
$view = new stdClass();
// Logic to get the users out from the database and being able to display them

$userData = new UserDataSet();

$view->users = $userData->getAllUserSignedUp(); 

// Logic to delete users 

if(isset($_GET['id']))
{
    $userID = $_GET['id']; 

    $userData->removeUser($userID);
}


require_once 'View/campsiteAdminUsers.php';

