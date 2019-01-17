<?php

Class Campsite {
    
    protected $_id, $_campsiteName, $_campsiteStreetAddress, $_postcode, $__city, $_country, $_latitude, $_longitude, $_photo;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['campsiteID'];
        $this->_campsiteName = $dbRow['campsiteName'];
        $this->_campsiteStreetAddress = $dbRow['StreetAddress'];
        $this->_postcode = $dbRow['postcode'];
        $this->_city = $dbRow['city'];
        $this->_country = $dbRow['country'];
        $this->_latitude = $dbRow['latitude'];
        $this->_longitude = $dbRow['longitude'];
        $this->_photo = $dbRow['photo'];    
    
    }

       // set the getters 

    public function getCampsiteID()  { 
        return $this->_id;
    }
   
    public function getCampsiteName() {
       return $this->_campsiteName;
    }
    
    public function getCampsiteStreetAddress() {
       return $this->_campsiteStreetAddress;
    }
    
    public function getPostcode() {
       return $this->_postcode;
    }
    
    public function getCity() {
       return $this->_city;
    }

    public function getCountry()
    {
        return $this->_country;
     }
    
     public function getPhoto()
     {
         return $this->_photo;
     }
}


