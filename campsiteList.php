
<?php 

require_once 'Model/CampsiteDataSet.php';
require_once 'Model/UserDataSet.php';
session_start();

$view = new stdClass;

$view->pageTitle= "Campsite search";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

$count = $campsiteData->countDatabaseEntry(); // count the entries of data in the campsite table.

$limit= 5; // set the limit of entries to show per page.

//$nOfPages = ceil($count/$limit); // Calculate the amount of pages I need to display for the user.

$pageNumber = $_GET['page'];  // Get the page number from the URL

$favouriteCampsite = " "; 


$view->campsites = $campsiteData->fetchSomeCampsites($pageNumber, $limit); // Fetch from the campsite by passing parameters for limit and offset.

if (isset($_POST['submit'])) {

    $searchKeyword = $_POST['search-keyword']; 
}

if ($_GET['favouriteCampsiteID'] != null)
{
    $favouriteCampsite = $_GET['favouriteCampsiteID']; 

    var_dump($favouriteCampsite);
}


require_once 'View/campsiteList.phtml';

