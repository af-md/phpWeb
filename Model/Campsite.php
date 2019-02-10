<?php

Class Campsite {
    
    protected $_id, $_campsiteName, $_campsiteStreetAddress, $_postcode, $_city, $_country, $_latitude, $_longitude, $_photo, $_shower, $_wifi, $_cafe, $_family, $_water, $_disabled, $_ownerName, $_ownerContact;
    
    public function __construct($dbRow) {
        $this->_id = $dbRow['campsiteID'];
        $this->_campsiteName = $dbRow['campsiteName'];
        $this->_campsiteStreetAddress = $dbRow['StreetAddress'];
        $this->_postcode = $dbRow['postcode'];
        $this->_city = $dbRow['city'];
        $this->_country = $dbRow['country'];
        $this->_latitude = $dbRow['latitude'];
        $this->_longitude = $dbRow['longitude'];
        $this->_shower = $dbRow['shower'];
        $this->_wifi = $dbRow['wifi'];
        $this->_cafe = $dbRow['cafe'];
        $this->_family = $dbRow['family_friendly'];
        $this->_water = $dbRow['drinking_water'];
        $this->_disabled = $dbRow['disabled_facilities'];
        $this->_photo = $dbRow['photo']; 
        $this->_ownerName = $dbRow['ownerName'];   
        $this->_ownerContact = $dbRow['ownerContact'];  
         
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

      /***  facility getters      */

    /**
     * Get the value of _wifi
     */ 
    public function get_wifi()
    {
        return $this->_wifi;
    }

    /**
     * Get the value of _disabled
     */ 
    public function get_disabled()
    {
        return $this->_disabled;
    }

    /**
     * Get the value of _shower
     */ 
    public function get_shower()
    {
        return $this->_shower;
    }

    /**
     * Get the value of _water
     */ 
    public function get_water()
    {
        return $this->_water;
    }

    /**
     * Get the value of _family
     */ 
    public function get_family()
    {
        return $this->_family;
    }

    /**
     * Get the value of _cafe
     */ 
    public function get_cafe()
    {
        return $this->_cafe;
    }

    /**
     * Get the value of _ownerName
     */ 
    public function get_ownerName()
    {
        return $this->_ownerName;
    }

    /**
     * Get the value of _ownerContact
     */ 
    public function get_ownerContact()
    {
        return $this->_ownerContact;
    }
}


