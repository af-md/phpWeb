<?php 

require_once 'Model/UserDataSet.php';

require_once 'Model/CampsiteDataSet.php';

$view = new stdClass; 

$view->page= "Admin Page"; 

$userData = new UserDataSet; 

$campsiteData = new CampsiteDataSet; 

// logic for whatever passed in the address bar
if(isset($_GET['userPage']))
{
    $view->page= "Admin User"; 
    $view->users = $userData->getAllUserSignedUp(); 
    require_once 'View/campsiteAdminUser.phtml';
}
 // logic for whatever passed in the address bar 
elseif (isset($_GET['campsitePage']))
{
    $view->page= "Admin Campsite"; 
    $view->campsites = $campsiteData->fetchSomeCampsites($pageNumber, $limit); 
    require_once 'View/campsiteAdminCampsite.phtml';

}

else {

    require_once "View/campsiteAdmin.phtml";
}




