<?php 

require_once 'Model/CampsiteDataSet.php';

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Single Campsite Page";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

$campsiteData->getCampsite(); 

require_once 'View/campsitePage.phtml';

