<?php

class User_Obj {
    	//variables
	private $username, $password, $role; //strings
	private $partnerSettings; //Array for partner notifications

	//getters
	function getUsername()	{ return $this->username; }
	function getPassword()	{ return $this->password; }
        function getRole()      { return $this->role;     }
	function getPartnerSettings()	{ return $this->partnerSettings; }
	
	//setters
	function setUsername($username)           {$this->username = $username; }	
	function setPassword($password) 	  {$this->password = $password; }
        function setRole($role)                   {$this->role = $role;         }
	function setPartnerSettings($partnerSettings) 	  {$this->issues = $partnerSettings; }
}
