<?php

require_once 'Database.php';

require_once 'Model/Campsite.php';

class CampsiteDataSet
{
    protected $db_Handle;
    protected $db_instance;
    private $_offset;


    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }

     /**
     * This function 
     * @return dataobject 
     */

    public function fetchCampsites()
    {
        $query = "select * FROM Campsite";

        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement
        
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new Campsite($row);
            //echo $dataset;
        }

        return $dataSet;
    }

    
     /**
     * This function creates campsites by their limit of pageNumber. 
     * @return dataobject
     */
    public function fetchSomeCampsites($pageNumber, $limit)
    {
        $offset = ($pageNumber - 1)* $limit;

        $query = "select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.longitude, Campsite.latitude,  Campsite.ownerName, Campsite.ownerContact, Photo.photo, Facilities.shower, Facilities.wifi, Facilities.cafe, Facilities.family_friendly, Facilities.drinking_water, Facilities.disabled_facilities FROM Campsite inner join Photo on Photo.campsiteID = Campsite.campsiteID inner join Facilities on Facilities.campsiteID = Campsite.campsiteID  LIMIT ?,?" ;

        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement
        
        $statement->bindParam(1, $offset, PDO::PARAM_INT);

        $statement->bindParam(2, $limit, PDO::PARAM_INT);
       
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new Campsite($row);
            //echo $dataset;
        }
        return $dataSet;
    }

    public function fetchSomeCampsitesFromSearch($searchField)
    {
        $query = "select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.longitude, Campsite.latitude, Campsite.ownerName, Campsite.ownerContact, Photo.photo, Facilities.shower, Facilities.wifi, Facilities.cafe, Facilities.family_friendly, Facilities.drinking_water, Facilities.disabled_facilities FROM Campsite inner join Photo on Photo.campsiteID = Campsite.campsiteID inner join Facilities on Facilities.campsiteID = Campsite.campsiteID WHERE Campsite.campsiteName = ?" ;

        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement
        
        $statement->bindParam(1, $searchField);

        // $statement->bindParam(1, $offset, PDO::PARAM_INT);

         //  $statement->bindParam(2, $limit, PDO::PARAM_INT);
      
        $statement->execute(); // execute the PDO statement
        
        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new Campsite($row);
            //echo $dataset;
        }

        
        return $dataSet;
    }

    /**
     * Return the data requested for filtering down. 
     */
    public function searchFilter($country, $ratingValue, $shower, $wifi, $cafe, $family, $water, $accessibility)
    {
        // joing the different tables relevant to it. 
        $query ="select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.longitude, Campsite.latitude,  Campsite.ownerName, Campsite.ownerContact, Photo.photo, Facilities.shower, Facilities.wifi, Facilities.cafe, Facilities.family_friendly, Facilities.drinking_water, Facilities.disabled_facilities, Ratings.rating FROM Campsite inner join Ratings on Ratings.campsite_id = Campsite.campsiteID inner join Photo on Photo.campsiteID = Campsite.campsiteID inner join Facilities on Facilities.campsiteID = Campsite.campsiteID";
        
       
        // Nested logic for filtering down the search. Check country value, Check any facility value and finally check any rating value. 
        if($country)
        {
            $query .= " WHERE Campsite.country = :country";
            
            if($shower > 0)
                {
                    $query .= " AND Facilities.shower = :faciltity";
                    
                }
                if($wifi > 0)
                {
                    $query .= " AND Facilities.wifi = :faciltity";
                }
                if($cafe> 0)
                {
                    $query .= " AND Facilities.cafe = :faciltity";
                    
                }
                if($family > 0)
                {
                    $query .= " AND Facilities.family_friendly = :faciltity";
                }
                if($water> 0)
                {
                    $query .= " AND Facilities.water = :faciltity";
                }
                if($accessibility> 0)
                {
                    $query .= " AND Facilities.disable_facilities = :faciltity";
                }
                if($ratingValue > 0)
                { 
                   $query .= " AND Ratings.rating = :rating";
               }
        }
        elseif ($shower > 0) {
            {
                $query .= " WHERE Facilities.shower = :faciltity";
                //$statement->bindParam(':faciltity', $shower);
            }
            if($wifi > 0)
            {
                $query .= " AND Facilities.wifi = :faciltity";
                //$statement->bindParam(':faciltity', $wifi);
            }
            if($cafe> 0)
            {
                $query .= " AND Facilities.cafe = :faciltity";
                //$statement->bindParam(':faciltity', $cafe);
            }
            if($family > 0)
            {
                $query .= " AND Facilities.family_friendly = :faciltity";
                //$statement->bindParam(':faciltity', $family);
            }
            if($water> 0)
            {
                $query .= " AND Facilities.water = :faciltity";
                //$statement->bindParam(':faciltity', $water);
            }
            if($accessibility> 0)
            {
                $query .= " AND Facilities.disable_facilities = :faciltity";
                //$statement->bindParam(':faciltity', $accessibility);
            }
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($wifi > 0) {
            $query = " WHERE Facilities.wifi = :faciltity";
            //$statement->bindParam(':faciltity', $wifi);
            if($cafe> 0)
            {
                $query .= " AND Facilities.cafe = :faciltity";
                //$statement->bindParam(':faciltity', $cafe);
            }
            if($family > 0)
            {
                $query .= " AND Facilities.family_friendly = :faciltity";
                //$statement->bindParam(':faciltity', $family);
            }
            if($water> 0)
            {
                $query .= " AND Facilities.water = :faciltity";
                //$statement->bindParam(':faciltity', $water);
            }
            if($accessibility> 0)
            {
                $query .= " AND Facilities.disable_facilities = :faciltity";
               // $statement->bindParam(':faciltity', $accessibility);
            }
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($cafe> 0) {
            $query .= " WHERE Facilities.cafe = :faciltity";
            //$statement->bindParam(':faciltity', $cafe);
            if($family > 0)
            {
                $query .= " AND Facilities.family_friendly = :faciltity";
                //$statement->bindParam(':faciltity', $family);
            }
            if($water> 0)
            {
                $query .= " AND Facilities.water = :faciltity";
                //$statement->bindParam(':faciltity', $water);
            }
            if($accessibility> 0)
            {
                $query .= " AND Facilities.disable_facilities = :faciltity";
                //$statement->bindParam(':faciltity', $accessibility);
            }
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($family > 0) {
            $query .= " WHERE Facilities.family_friendly = :faciltity";
            //$statement->bindParam(':faciltity', $cafe);
            if($water> 0)
            {
                $query .= " AND Facilities.water = :faciltity";
                //$statement->bindParam(':faciltity', $water);
            }
            if($accessibility> 0)
            {
                $query .= " AND Facilities.disable_facilities = :faciltity";
                //$statement->bindParam(':faciltity', $accessibility);
            }
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($water> 0) {
            $query .= " WHERE Facilities.water = :faciltity";
            //$statement->bindParam(':faciltity', $cafe);
            if($accessibility> 0)
            {
                $query .= " AND Facilities.disable_facilities = :faciltity";
                //$statement->bindParam(':faciltity', $accessibility);
            }
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($accessibility> 0) {
            $query .= " WHERE Facilities.disable_facilities = :faciltity";
            //$statement->bindParam(':faciltity', $cafe);
            if($ratingValue > 0)
            { 
               $query .= " AND Ratings.rating = :rating";
               //$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);
           }
        }
        elseif ($ratingValue > 0) {
            $query .= " WHERE Ratings.rating = :rating";
            //$statement->bindParam(':faciltity', $ratingValue, PDO::PARAM_INT);
            
        }

        // prepare the Query to be executed. 
        $statement = $this->_dbHandle->prepare($query);

        // Bind all the parameters that you might need. 
        if($country){$statement->bindParam(':country', $country);}
        if($shower > 0){$statement->bindParam(':faciltity', $shower);}
        if($wifi > 0){$statement->bindParam(':faciltity', $wifi);}
        if($cafe > 0){$statement->bindParam(':faciltity', $cafe);}
        if($family > 0){$statement->bindParam(':faciltity', $family);}
        if($water > 0){$statement->bindParam(':faciltity', $water);}
        if($accessibility > 0)$statement->bindParam(':faciltity', $accessibility);{}
        if($ratingValue > 0){$statement->bindParam(':rating', $ratingValue, PDO::PARAM_INT);}
        
        
        // execute the PDO statement
        $statement->execute(); 

        //$arrayCampsites = [];
        while($obj = $statement->fetch())
        {
            $arrayCampsites[] = new Campsite($obj); 
        }

        // var_dump($arrayCampsites); 
        // die();

        return $arrayCampsites; 

    }


     /**
     * This function counts all the entries in the database 
     * @return Integer 
     */                
    public function countDatabaseEntry()
    {
        $query =  "select count(*) FROM Campsite ";

        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement

        $statement->execute(); // execute the PDO statement

        $numberOfCampsites = $statement->fetch();

        $numberCamp = $numberOfCampsites['0'];

        return $numberCamp; 
    }

    /**
    * fetch the values of the facilities for a campsite.
    */
    public function fetchFacilities($campsiteID)
    {
        $query= "select * FROM facilites WHERE campsiteID = ?";

        $statement = $this->_dbHandle->prepare($query); // prepare a PDO statement

        $statement->execute(); // execute the PDO statement
    }

    // /**
    //  * Function to add campsites in the database
    //  */
    // public function addCampsite($campsitename, $streetAddress, $postcode, $city, $country)
    // {        
    //     // invent some random longitude latitude numbers
    //     $query = "INSERT INTO Campsite (userName, userPassword, firstname, lastname ) VALUES (?,?,?,?)";
    //     $statement = $this->_dbHandle->prepare($query);
    //     $statement->bindParam(1, $campsitename);
    //     $statement->bindParam(2, $streetAddress);
    //     $statement->bindParam(3, $postcode);
    //     $statement->bindParam(4, $city);
    //     $statement->bindParam(5, $country);
    //     $statement->execute();
    // }

    /**
     * This method retrieves campsite data from the camsite table
     */
    // public function getFavCampsites($userID){

    //  //Revise the SQL queris   $query = "select bla bla FROM Campsite, favorite WHERE favorite.userID = ?";

    //  $statement->bindParam( 1, $userID);
     
    //  $statement->execute();

    //     if (row->count > 0)
    //     {

    //         // return something bakc 
    //     }
    //     else {
    //         return false; 
    //     }
    // }

    public function addToFavourite($campsiteid, $userid)
    {
        $query="INSERT INTO favourites (campsite_id, user_id) VALUES (?,?) "; /// inserts the favourite campsiteID in to the database
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindparam(1, $campsiteid);
        $statement->bindparam(2, $userid);
        $statement->execute();
        
        $favSessArra = $_SESSION['favourite'];
        
        //array_push($favSessArra['campsite_id'], $campsiteid); // push the new campsite ID in to the array. 
        
        $favSessArra[]['campsite_id'] = $campsiteid; 


            //var_dump($favSessArra); 
 

        $_SESSION['favourite'] = $favSessArra; 
        
    }

    /**
     * This function removes the campsite from the favourite table, so that it's not a favourite campsite anymore.  
     **/
    public function removeFromFavourite($campsiteID)
    {
        $query="DELETE FROM favourites WHERE campsite_id=?"; 
        
        $statement = $this->_dbHandle->prepare($query);
        
        $statement->bindparam(1, $campsiteID);

        $statement->execute();

        $favSessArra = $_SESSION['favourite']; // the user

        //$key = array_search($campsiteID, $favSessArra); // use the function "array_search" to find the favourite campsite in the session array and then erase it. 
        
        //unset($favSessArra[$key]); // unset the key = element when found in the array
        
        foreach($favSessArra as $subKey => $subArray){
            if($subArray['campsite_id'] == $campsiteID)
            {
                 unset($favSessArra[$subKey]);
            }
       }

        $_SESSION['favourite'] = $favSessArra; 


    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getFavourite($userid)
    {
        $sql =  "Select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.ownerName, Campsite.ownerContact, Campsite.latitude, Campsite.longitude, Photo.photo FROM favourites RIGHT JOIN on Photo ON Campsite.campsiteID = Photo.campsiteID RIGHT JOIN Campsite ON favourites.campsite_id = Campsite.campsiteID WHERE favourites.user_id = ?";
     
        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $userid);
        
        $statement->execute();

        $dataset = []; 

        while($row = $statement->fetch())
        {
            $dataset = new Campsite($row); 
        }

        return $dataset; 
        
         // var_dump($dataset);
        // die();
       // return $dataset; 
      // if the row is less than 1 then return somethings, and make the page send a message. 
    }

    
    /**
     * Remove campsite from the database. 
     * @param campsiteID $campsiteID
     * @return null
     */
    public function removeCampsite($campsiteID)
    {
        $query = "DELETE FROM Campsite WHERE campsiteID = ?";   
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(1, $campsiteID);
        $statement->execute();
    }

    /**
     * Check if the campsite is in the favourite session array or not.  
     */
    public function checkCampIdInFavSes($ID)
    {
        $isAlreadyFav = false; // create boolean value that sets to true if the campsite ID is in the array already. 
        // for ($i=0; $i < count($_SESSION['favourite']); $i++) // get in to the array and compare if the campsite ID is the same as the one passed in the paramater
        // { 
       

        //   if ($_SESSION['favourite'][$i]['campsite_id'] === $ID)  // checking is the ID passed from the parameter, it's the same in the session array. 
        //   {
            
        //   }
        // }
        $favSessArra = $_SESSION['favourite']; 

        foreach ($favSessArra as $subKey => $subArray) {
            if ($subArray['campsite_id'] == $ID) {
                //unset($favSessArra[$subKey]);
                $isAlreadyFav = true;
            }
        }
        

        return $isAlreadyFav; 
        
    }

    /**
     * Insert a new campsite in the database 
     * @param mixed campsite Details
     * @return null 
     **/
    
     public function insertCampsite($campsiteName, $campsiteStreet, $campsitePostcode, $campsiteCity, $campsiteCountry, $latitude, $longitude, $ownerName, $ownerContact, $photo) 
     {
         $sql = "INSERT INTO Campsite (campsiteName, StreetAddress, postcode, city, country, longitude, latitude, ownerName, ownerContact) VALUES (?,?,?,?,?,?,?,?,?)";  
         $statement = $this->_dbHandle->prepare($sql);
         $statement->bindParam(1, $campsiteName); // Bind paramers for safety reasons
         $statement->bindParam(2, $campsiteStreet); // Bind paramers for safety reasons
         $statement->bindParam(3, $campsitePostcode); // Bind paramers for safety reasons
         $statement->bindParam(4, $campsiteCity); // Bind paramers for safety reasons
         $statement->bindParam(5, $campsiteCountry); // Bind paramers for safety reasons     
         $statement->bindParam(6, $latitude); // Bind paramers for safety reasons
         $statement->bindParam(7, $longitude); // Bind paramers for safety reasons  
         $statement->bindParam(8, $ownerName); // Bind paramers for safety reasons
         $statement->bindParam(9, $ownerContact); // Bind paramers for safety reasons                              
         $statement->execute();
         $campsiteID =  $this->_dbHandle->lastInsertId(); 
         $query = "INSERT INTO Photo (photo, campsiteID) VALUES (?,?)"; 
         $statement_2 = $this->_dbHandle->prepare($query);
         $statement_2->bindParam(1, $photo); // Bind paramers for safety reasons
         $statement_2->bindParam(2, $campsiteID); // Bind paramers for safety reasons          
         $statement_2->execute();
     }

     /**
      * Get a single campsite to display in the view. 
      */
     public function getCampsite($campsiteID)
     {
        $query ="select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.longitude, Campsite.latitude, Campsite.ownerName, Campsite.ownerContact, Photo.photo, Facilities.shower, Facilities.wifi, Facilities.cafe, Facilities.family_friendly, Facilities.drinking_water, Facilities.disabled_facilities FROM Campsite inner join Photo on Photo.campsiteID = Campsite.campsiteID inner join Facilities on Facilities.campsiteID = Campsite.campsiteID WHERE Campsite.campsiteID = ?";
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(1, $campsiteID); // Bind paramers for safety reasons
        $statement->execute();
        $row = $statement->fetch();
        $dataset = new Campsite($row); 
        return $dataset; 
     }

     /** 
      * Function to leave a rating for a specific campsite; 
     */

     public function insertRating($campsiteID, $ratingValue)
     {
        $query = "INSERT INTO Ratings (rating, campsite_id) VALUES (?,?)";
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(1, $ratingValue); // Bind paramers for safety reasons
        $statement->bindParam(2, $campsiteID); // Bind paramers for safety reasons
        $statement->execute();
     }

     /**
      * Calculate the average of the rating star of the campsite 
      */
      public function getRatingAverage($campsiteID)
      {
        $query = "SELECT ROUND(AVG(rating)) FROM Ratings Where campsite_id = ? ";
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(1, $campsiteID); // Bind paramers for safety reasons
        $statement->execute();
        $arrayAverage = $statement->fetch(); 
        $averageNormal = $arrayAverage[0][0]; 
        //$averageCast = (int)$average; 
        return $averageNormal; 
      }

      /**
       * Insert the facilities in to the campsites
       */
      public function insertFacilities($campsiteID, $shower, $cafe, $wifi, $family, $water, $disabilty)
      {
        $query = 'INSERT INTO Facilities (shower, cafe, wifi, family_friendly, drinking_water, disabled_facilities, campsiteID) VALUES (?, ?, ?, ?, ?, ?, ?)'; 
        $statement = $this->_dbHandle->prepare($query); 
        $statement->bindParam(1, $shower); // Bind paramers for safety reasons
        $statement->bindParam(2, $cafe); // Bind paramers for safety reasons
        $statement->bindParam(3, $wifi); // Bind paramers for safety reasons
        $statement->bindParam(4, $family); // Bind paramers for safety reasons
        $statement->bindParam(5, $water); // Bind paramers for safety reasons
        $statement->bindParam(6, $disabilty); // Bind paramers for safety reasons
        $statement->bindParam(7, $campsiteID); // Bind paramers for safety reasons
        $statement->execute();
      }

      /**
       * Generates more campsites for testing purposes
       * 
       */
      public function generateCampsites()
      {
          // Wrap all of this around a for loop after you thinks it works. Just make 5 thousands campsites. 
          $campsiteID = 62;
            // Generate the photo here
                // For the photo I could use just 10 or more 
            // Generate campsite data here
                // Choose a random Country name
                    $campsiteCountrys = array('Italy'); 
                // Choose a random Campsite name which will be the campsite name as well. 
                    $campsiteNames = array('Milano', 'Torino'); 
                    $positionCampsiteName = array_rand($campsiteNames); // select the key randomly of the elemetns in the array. 
                // Fix the postcode name 
                    $postcode = 'DLE RLT'; 
                // Campsite contact details
                    $campsiteOwner = 'Bob'; 
                    $campsiteOwnerNumber = '1234567'; 
                // Fix latitude and longitude 
                    $latitude = '';
                    $longitude = ''; 
                // Choose a random rating 
                    $randomRating = rand(1, 5);
                // Choose random facilities
                    $shower = rand(0, 1); 
                    $cafe  = rand(0, 1); 
                    $wifi  = rand(0, 1); 
                    $family  = rand(0, 1); 
                    $water  = rand(0, 1); 
                    $disabilty  = rand(0, 1); 
                // Insert the photo and the data in the campsite also in different tables if possible 

                // Call the different insertion methods from the campsite
                     
                    insertCampsite($campsiteName, $campsiteStreet, $campsitePostcode, $campsiteCity, $campsiteCountry, $latitude, $longitude, $ownerName, $ownerContact, $photo); 
                    insertRating($randomRating, $campsiteID); // campsiteID is 52 and just encreasing from there with +1 
                    insertFacilities($campsiteID, $shower, $cafe, $wifi, $family, $water, $disabilty); // Insert the facilities in the campsite

                            
      }
}
