<?php

require_once 'Model/UserDataSet.php';

require_once 'Model/Captcha.php';

session_start();

$view = new stdClass;

$view->pageTitle = "Login"; 

$userData  = new UserDataSet;

$_SESSION['count_time']= time(); // unique string stored

$timeCount = $_SESSION['count_time']; 

$captcha = new Captcha; 

$flag = 5;

$captcha->create_image();  // create the captcha Image


if (isset($_POST['submit_login'])) {
    $userName =  $_POST['uname'];
    $userPassword = $_POST['upassword'];
    $input = $_POST['input']; 
    $flag =  $_POST['flag'];
    
        if ($userData->verifyUser($userName, $userPassword)) {
            
            $user =  $userData->fetchSomeUser($userName);

            $userID = $user->getUserID();

            $_SESSION['id'] = $userID;

            $userFavTableID = $userData->getFavouriteForSession($userID); 

            $_SESSION['favourite'] = $userFavTableID;

            header("Location: index.php");
        }
    }



require_once 'View/LoginForm.phtml';


