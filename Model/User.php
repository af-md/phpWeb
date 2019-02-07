<?php

class User
{

    /**
     * Properties
     */
    protected $_id;
    protected $_userName;
    protected $_password;
    protected $_firstname;
    protected $_lastname;
    protected $_adminPriviligies; 

    public function __construct($dbRow) // pass an associative array to the campsite file. 
    {
        $this->_id = $dbRow['userID']; 
        $this->_firstname = $dbRow['firstname'];
        $this->_lastname = $dbRow['lastname'];
        $this->_userName = $dbRow['userName'];
      //  $this->_password = $dbRow['userPassword'];
        $this->_adminPriviligies = $dbRow['isAdmin'];

    }

    // set the accessor methods 
    /**
     * Get the value of user ID
     */ 
    public function getUserID()
    {
        return $this->_id;
    }
   
    /**
     * Get the value of the password
     */ 
    public function getPassword()
    {
        return $this->_password;
    }
    
    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->_userName;
    }

    /**
     * Get the value of Firstname
     */ 
    public function getFirstName()
    {
        return $this->_firstname;
    }
 
    /**
     * Get the value of LastName
     */ 
    public function getLastName()
    {
        return $this->_lastname;
    }

    /**
     * Get the value of _adminPriviligies
     */ 
    public function get_adminPriviligies()
    {
        return $this->_adminPriviligies;
    }
}
