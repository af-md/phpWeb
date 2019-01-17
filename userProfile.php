<?php



require_once 'Model/UserDataSet.php';

session_start();	

$view = new stdClass();

$view->pageTitle = "user profile";

$userData = new UserDataSet;

require_once 'View/userProfile.phtml';