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

    public function __construct($dbRow) // pass an associative array to the campsite file. 
    {
        $this->_id = $dbRow['userID']; 
        $this->_firstname = $dbRow['firstname'];
        $this->_lastname = $dbRow['lastname'];
        $this->_userName = $dbRow['userName'];
        $this->_password = $dbRow['userPassword'];
    }

    // set the accessor methods 

    public function getUserID()
    {
        return $this->_id;
    }
   
    public function getPassword()
    {
        return $this->_password;
    }
    
    public function getUserName()
    {
        return $this->_userName;
    }
 
    public function getFirstName()
    {
        return $this->_firstname;
    }
 
    public function getLastName()
    {
        return $this->_lastname;
    }
}
