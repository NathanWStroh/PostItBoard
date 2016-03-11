<?php

class User_Obj {
    	//variables
        private $id, $teamId; //int
	private $username, $password, $role; //strings
	private $partnerSettings; //Array for partner notifications

	//getters
        function getID()        { return $this->id;       }
        function getTeamID()    { return $this->teamId;   }
	function getUsername()	{ return $this->username; }
	function getPassword()	{ return $this->password; }
        function getRole()      { return $this->role;     }
	function getPartnerSettings()	{ return $this->partnerSettings; }
	
	//setters
        function setID($id)                       {$this->id = $id;             }
        function setTeamID($teamId)               {$this->teamId = $teamId;     }
	function setUsername($username)           {$this->username = $username; }	
	function setPassword($password) 	  {$this->password = $password; }
        function setRole($role)                   {$this->role = $role;         }
	function setPartnerSettings($partnerSettings) 	  {$this->issues = $partnerSettings; }
}
