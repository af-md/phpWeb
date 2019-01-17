<?php
/**
 *Controller for the captcha view and model. 
 */

require_once 'Model/Captcha.php';

session_start();

$_SESSION['count_time']= time(); // unique string stored

$timeCount = $_SESSION['count_time']; 

$captcha = new Captcha; 

$flag = 5;

$captcha->create_image();  // create the captcha Image

if (isset($_POST['submit'])) //  check that POST variable is not empty and set them to their inputs. 
{
   
    $input = $_POST['input'];
    $flag = $_POST['flag'];
    
}

echo    $_SESSION['captcha_string'];

require_once 'View/captcha.phtml';



