
<?php 

require_once 'Model/CampsiteDataSet.php';
require_once 'Model/UserDataSet.php';

session_start();

$view = new stdClass;

$view->pageTitle= "Campsite search";

$campsiteData = new CampsiteDataSet;

$userData = new UserDataSet;

$count = $campsiteData->countDatabaseEntry(); // count the entries of data in the campsite table.


$landingCheck = false; // set to false. Check is the user it's on the landing page for the firs time or is he's searching


$searchCheckBar = false; // checks wether the user is using the search or not. 

$searchCheck = false; // checks wether the user is using the search or not. 

$searchCheckFilter = false; // Checks wether the fileter search is being applied or not. 

$pagingCheck = false; // varibel used to control the pagination between the search and landing page. 

$limit= 5; // set the limit of entries to show per page.

//$nOfPages = ceil($count/$limit); // Calculate the amount of pages I need to display for the user.

$searchFilterLine = ""; 

$resultNotFound = false; 


$favouriteCampsite = " "; 

if (isset($_GET['search-action'])) {
    $searchActionCheck = $_GET['search-action'];
    if ($searchActionCheck == 'searchBar') {
        $searchCheckBar = true;

        $searchCheck = true;

        if (isset($_GET['page'])) {$pageNumber = $_GET['page'];} else {
            $pageNumber = 1; 
        }
        
        if(isset($_GET['search-keyword']))
            {$searchKeyword = $_GET['search-keyword'];}

        $view->campsite = $campsiteData->fetchSomeCampsitesFromSearch($searchKeyword, $pageNumber, $limit);
        // Paginatin for the search option

        $countSearchCampsite = count($campsiteData->fetchSomeCampsitesFromSearch($searchKeyword, $pageNumber, $limit));

        // var_dump($countSearchCampsite);
        // die();
    
        // if (isset($_GET['pagination'])) {
        //     $pageNumber = $_GET['pagination'];
        // }
        
        if ($countSearchCampsite > 0) {
            # code...
           // $pagingCheck = true;
           // if there are exactly 5 campsite in the website, pagination will be shown and this will be an erro to correct. 
            if ($countSearchCampsite >= 5) {
                $pagingCheck = true;
            }
        }
      
        else {
            # code...

            $displayResultsNotFoundMessage = " Result Not Found "; 

            $resultNotFound = True; 
        }
        
    }
    elseif ($searchActionCheck === 'searchFilter') {

            // rating logic 
            $searchCheck = true;

            $searchCheckFilter = true;

            $searchKeyword = $_GET['search-action']; 

            if (isset($_GET['page'])) {$pageNumber = $_GET['page'];} else {
                $pageNumber = 1; 
            }

          //  $searchFilterLine = ""; 
 
        if(isset($_GET['rating-input-5'])){$ratingValue = $_GET['rating-input-5']; $searchFilterLine .= "&rating-input-5="; $searchFilterLine .= $ratingValue; } else {$ratingValue = 0; } // rating value       
                    // facilities logic; 
        if(isset($_GET['shower'])){$shower = $_GET['shower']; $searchFilterLine .= "&shower=1";}  else { $shower = 0;  }//
        if(isset($_GET['wifi'])){ $wifi = $_GET['wifi']; $searchFilterLine .= "&wifi=1";} else { $wifi = 0; }//
        if(isset($_GET['coffe'])){$coffe = $_GET['coffe']; $searchFilterLine .= "&coffe=1";} else {$coffe = 0;}//    
        if(isset($_GET['disabe_facilties'])){$acessibility = $_GET['disabe_facilties']; $searchFilterLine .= "&disabe_facilties=1";} else {$acessibility = 0;} //  
        if(isset($_GET['water'])){ $water = $_GET['water']; $searchFilterLine .= "&water=1";} else { $water = 0; } //
        if(isset($_GET['family'])){$family = $_GET['family']; $searchFilterLine .= "&family=1";} else {$family = 0; } //
           
            // country logic
        if(isset($_GET['selectedCountry'])){$country = $_GET['selectedCountry']; $searchFilterLine .= '&selectedCountry='.$country; }  else { $country = false;  }//
       
        $searchFilterValuePagination = $searchFilterLine; 

      //  $pageNumber = 1; 


        
        $view->campsite = $campsiteData->searchFilter($country, $ratingValue, $shower, $wifi, $coffe, $family, $water, $acessibility, $limit, $pageNumber);
        
        $countSearchCampsite = count($view->campsite); 
        
        

        if ($countSearchCampsite > 0) {
            # code...
           // $pagingCheck = true;
           // if there are exactly 5 campsite in the website, pagination will be shown and this will be an erro to correct. 
            if ($countSearchCampsite >= 5) {
                $pagingCheck = true;
            }
        }
      
        else {
            # code...

            $displayResultsNotFoundMessage = " Result Not Found "; 

            $resultNotFound = True; 
        }
        
        //var_dump($view->campsite); 
        //die();
       
        //if(isset($_GET[''])){} 
    }
}
else {
    # code...

    $pagingCheck = true; 

    if (isset($_GET['page'])) {$pageNumber = $_GET['page'];}
      // Get the page number from the URL

    $landingCheck = true; // set the variable to true, so we can display the camsite to the user. 

   // if (isset($_GET['pagination'])) {$pageNumber = $_GET['pagination'];}

    $view->campsites = $campsiteData->fetchSomeCampsites($pageNumber, $limit); // Fetch from the campsite by passing parameters for limit and offset.

    if (isset($_GET['favouriteCampsiteID'])) /// you could post the fields really. 
    {
        $favouriteCampsite = $_GET['favouriteCampsiteID'];
        if (isset($_GET['FavAction'])){
            $action = $_GET['FavAction'];
            if ($action == 'add') {
                $favouriteCampsite = $_GET['favouriteCampsiteID'];

                $userFavouriting = $_SESSION['id']; // get the user from the session

                $campsiteData->addToFavourite($favouriteCampsite, $userFavouriting); // add the campsite to the  database
            }
            elseif ($action == 'remove') {
                $campsiteData->removeFromFavourite($favouriteCampsite);
            }

            }
        //var_dump($favouriteCampsite);
        }
    

}



// if (isset($_GET['search']))
// {
//     $searchKeyword = $_GET['search']; // assign the keyword to a new viariable

//     $campsiteData->fetchSomeCampsitesFromSearch($searchKeyword);

// }

require_once 'View/campsiteList.phtml';

