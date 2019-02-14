<?php
require_once 'Model/UserDataSet.php';

session_start();	

$view = new stdClass();
$view->pageTitle = "Registration class";
$view->hello = '';

$userData = new UserDataSet;

if(isset($_POST['submit_signin']))
{	
	$username = $_POST['uname'];
	$password = $_POST['upassword'];
	$firstname = $_POST['firstname'];
	$lastname =  $_POST['lastname'];
	$confirmPassword =  $_POST['confirmedpassword'];
	//add checks for the email here. 
	

	// if($lastname == null || $firstname == null){

	// 	echo "You haven't inserted one of your names";
	// }
	// elseif($username == null){

	// 	echo "Insert your email";
	// }
	// elseif($password == null || $confirmPassword == null){

	// 	echo "You haven't inserted the correct passwords";
	// }

	if($password == $confirmPassword){

		$userData->addUser($username, $password, $firstname, $lastname);
		
		$user =  $userData->fetchSomeUser($username);

		$userID = $user->getUserID();

		$_SESSION['id'] = $userID; 

		header('Location: index.php');

	}

	else {

		echo  "The passwords do not match each other";
	}

	if ($userData->isUserLogged()){

		echo "You are logged on";
	}
	else{

		echo "session not set";
	};
}


require_once 'View/RegisterForm.phtml';

//insert this method inside the last  if statement 

//$userData->fetchSomeUser($username); 



// The method will create a user object with the fields. 
 
//??




