<?php

require_once('Database.php');

require_once('User.php');

class UserDataSet
{
    protected $db_Handle;
    protected $db_instance;


    public function __construct()
    {
        $this->_dbInstance = Database::getInstance();
        $this->_dbHandle = $this->_dbInstance->getdbConnection();
    }


    /**
     * This function creates a new user in the database.   
     */
    public function addUser($username, $userpassword, $firstname, $lastname) 
    {
        $hash = password_hash($userpassword, PASSWORD_DEFAULT); 

        $query = "INSERT INTO User (userName, userPassword, firstname, lastname ) VALUES (?,?,?,?)";
 
        $statement = $this->_dbHandle->prepare($query);

        $statement->bindParam(1, $username); // Bind paramers for safety reasons
        $statement->bindParam(2, $hash); // Bind paramers for safety reasons
        $statement->bindParam(3, $firstname); // Bind paramers for safety reasons
        $statement->bindParam(4, $lastname); // Bind paramers for safety reasons

        $statement->execute();
    }
    
    /**
     * This function varifies if the user exists inside the database
     *  
     * @return data boolean
     */
    public function verifyUser($userName, $userPassword)
    {
        $query = "select userPassword FROM User WHERE userName = ? ";


        $statement = $this->_dbHandle->prepare($query);


        $statement->bindParam(1, $userName); // Bind paramers for safety reasons

        $statement->execute();

        $pass = $statement->fetch();


        if (password_verify($userPassword, $pass['userPassword'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function checks if the username exists inside the database, if it does, it will get create a user object with it.  
     * @return data objects 
     */
    public function checkUser($email)
    {
        $query = "SELECT userName, userPassword FROM User WHERE userName = '?'"; // get the user details with the username
      
        $statement = $this->_dbHandle->prepare($query); // prepare query 

        $statement->bindParam(1, $email); // Bind paramers for safety reasons

        $statement->execute(); // execute query 
      
        $dataSet = [];

        while ($row = $statement->fetch()) {
            $dataSet[] = new User($row);  // pass an associative array to the user row. 
        }
        return $dataSet;
    }
    

    /**
     * This function fetches the users from the database. 
     * @return data object 
     */
    public function fetchSomeUser($userName) // this method fetches users
    {
        $query = "SELECT * FROM User WHERE userName = ?";
      
        $statement = $this->_dbHandle->prepare($query);

        $statement->bindParam(1, $userName); // Bind paramers for safety reasons

        $statement->execute();

        $row = $statement->fetch();
       
        $user = new User($row);

        return $user;
    }

    /**
     * This function check is the user is logged or not
     */
    public function isUserLogged()
    {
        if (isset($_SESSION['id'])) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function loges out the user by destroying the session variable 
     */
    public function logout()
    {
        session_destroy();
    }

    /**
     * Get all the users in the database 
     */
    public function getAllUserSignedUp()
    {
        $query = "SELECT * FROM User";
      
        $statement = $this->_dbHandle->prepare($query);

       // $statement->bindParam(1, $userName); // Bind paramers for safety reasons

        $statement->execute();

        $dataSet = [];

        while($row = $statement->fetch())
        {
           $dataSet = new User($row);
        }

        return $dataSet;
    }

    /**
     * Remove user
     */
    public function removeUser($userID)
    {
        $sql = "DELETE FROM User WHERE userID = ?";

        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $userID); // Bind paramers for safety reasons

        $statement->execute();

    }

    /**
     * This function retrives the favourite campsites id's from the the database, and stores them in to an array. 
     *
     * @param $userID
     * @return associative array
     */
    public function getFavouriteForSession($userID)
    {
        // What if the user hasn't any campsite ? 
        $sql =  "SELECT campsite_id FROM favourites WHERE user_id = ?";
     
        $statement = $this->_dbHandle->prepare($sql);

        $statement->bindParam(1, $userID);
        
        $statement->execute();

        $dataset = []; 

        while($row = $statement->fetchAll()) // the sql statement fetches all the arrays, and then it returns them  as an array. 
        {
            $dataset = $row; 
        }
        
        return $dataset; 
    }
}
