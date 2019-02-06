<?php 

require_once 'Model/UserDataSet.php';
require_once 'Model/CampsiteDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Homepage";

$userData = new UserDataSet;

$campsite = new CampsiteDataSet;

$view->campsites = $campsite->fetchSomeCampsites(1, 6);


require_once 'View/index.phtml';