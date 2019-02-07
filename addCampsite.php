<?php
require_once 'Model/UserDataSet.php';
require_once 'Model/CampsiteDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Homepage";

$userData = new UserDataSet;
$campsiteData = new CampsiteDataSet; 

 if(isset($_POST['add_campsite']))
 {
    $campsitename = $_POST['campsiteName'];
    $streetAddress = $_POST['streetAddress'];
    $postcode = $_POST['postcode']; 
    $city = $_POST['city'];
    $country = $_POST['country'];
  
   
   if(isset($_FILES['myFile']))
   {
         $file = $_FILES['myFile'];      // This was a great learning curve
         $fileName = $_FILES['myFile']['name'];
         $fileLocation = $_FILES['myFile']['tmp_name'];
         $fileError = $_FILES['myFile']['error'];
         $fileSize = $_FILES['myFile']['size'];
         $fileType = $_FILES['myFile']['type'];

            $typeofimage = array ('jpg','png', 'jpeg', 'pdf', 'image/jpeg');  // variable to compare the type of image passed by the user

            $fileFormat = explode('.', $fileName);   // seperate the image type from the actual image name

            $actFileFormat = strtolower(end($fileFormat)); // make the image name lower case


         if(in_array($actFileFormat, $typeofimage)) /// check if the file it's an image 
         {
            if ($fileError === 0)
            {
                  if ($fileSize < 500000 ) {
                        # code...                
                        
                        // change the file name to unique id (micro seconds)

                        $fileNameNew = uniqid('', true) . '.' .  $actFileFormat; 

                         // assiing the destinaiton of the file; 

                         $fileDestination =  'Images/'. $fileNameNew;  

                        // move the file from the temp folder to my folder
                         move_uploaded_file($fileLocation, $fileDestination);  

                         // output a sucessfull message
                         // use get to check the if the fiel has been uploaded. 

                         //header("Location : addCampsite.php?uploadsuccess");
                       
                         $campsiteData->insertCampsite($campsitename, $streetAddress, $postcode, $city, $country); 

                        // insert the name of the image in to the database 
                        // create an obejct to display the campsite inside the catoulogue 
                       

                  }
                  else {
                        echo "Sorry the file is to big"; 
                  }
            }

            else {
                  echo "Sorry an error occurred"; 
            }

         }

         else {

            echo 'your file is not allowed';

         }


         // Array ( [name] => WIN_20181028_01_24_50_Pro.jpg [type] => image/jpeg [tmp_name] => C:\xampp\tmp\phpAE43.tmp [error] => 0 [size] => 166078 )

         // post 2 arrays 

         // post the image name 
       
         // differentiating the name and the file
         
   }

    // check if the form fields are empty or not

//    if( empty($campsitename) || empty($streetAddress) || empty($postcode) || empty($city) || empty($country))
//    {
//      header("Location: campsite.php?form=empty");
//    }
//    elseif()


    
 }

require_once 'View/addCampsite.phtml';