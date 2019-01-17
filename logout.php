<?php

require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Logout";

$userData = new UserDataSet;

$userData->logout();



header("Location: index.php");

