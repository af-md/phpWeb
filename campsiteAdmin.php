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
    if (isset($_GET['pageNumber'])) {

        $pageNumber = $_GET['pageNumber']; 
        $limit= 5;
        $view->page= "Admin Campsite";
        $view->campsites = $campsiteData->fetchSomeCampsites($pageNumber, $limit);
        require_once 'View/campsiteAdminCampsite.phtml';
    }
}

elseif(isset($_GET['userID']))
{   
        $userID = $_GET['userID'];
        $userData->removeUser($userID);
        $view->users = $userData->getAllUserSignedUp();
        require_once 'View/campsiteAdminUser.phtml';   
}
elseif(isset($_GET['campsiteID']))
{
    if (isset($_GET['pageNumber'])) {
        $pageNumber = $_GET['pageNumber'];
        $limit= 5;
        $campsiteID = $_GET['campsiteID'];
        $campsiteData->removeCampsite($campsiteID);
        $view->campsites = $campsiteData->fetchSomeCampsites($pageNumber, $limit);
        require_once 'View/campsiteAdminCampsite.phtml';
    }
}




