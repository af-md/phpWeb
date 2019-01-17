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

        $query = "select Campsite.campsiteID, Campsite.campsiteName, Campsite.StreetAddress, Campsite.postcode, Campsite.city, Campsite.country, Campsite.longitude, Campsite.latitude, Photo.photo FROM Campsite inner join Photo on Photo.campsiteID = Campsite.campsiteID  LIMIT ?,?" ;

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

    /**
     * Function to add campsites in the database
     */
    public function addCampsite($campsitename, $streetAddress, $postcode, $city, $country)
    {        
        // invent some random longitude latitude numbers
        $query = "INSERT INTO Campsite (userName, userPassword, firstname, lastname ) VALUES (?,?,?,?)";
        $statement = $this->_dbHandle->prepare($query);
        $statement->bindParam(1, $campsitename);
        $statement->bindParam(2, $streetAddress);
        $statement->bindParam(3, $postcode);
        $statement->bindParam(4, $city);
        $statement->bindParam(5, $country);
        $statement->execute();
    }

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
        $query="INSERT INTO `favourites` (campsite_id, user_id) VALUES ((select campsiteID 
        from `Campsite` WHERE campsiteID= ?), (select userID from `User` WHERE userID= ?)) ";
        
        $statement = $this->d_Handle->prepare($query);
        
        bindparam();

        $statement->execute();
    }

    /**
     * This function removes the favourite campsites 
     **/
    public function removeFromFavourite($userid)
    {
        $query="DELETE FROM favourites WHERE user_id=?";
        
        $statement = $this->d_Handle->prepare($query);
        
        bindparam($userid, 1);

        $statement->execute();

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
        $sql =  "Select  FROM Campsite, favourites WHERE `favourites`.user_id = ?`favourites`.campsite_id = `Campsite`.campsiteID";
     
        $statement = $this->db_Handle;

        // if the row is less than 1 then return somethings, and make the page send a message. 
    }
}
