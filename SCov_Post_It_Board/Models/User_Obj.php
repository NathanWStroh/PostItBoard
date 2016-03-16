<?php

class User_Obj {
    	//variables
        private $id; //int
	private $firstName, $lastName, $role, $username; //strings

	//getters
        function getID()        { return $this->id;       }
	function getLastName()	{ return $this->firstName; }
	function getFirstName()	{ return $this->lastName; }
        function getUsername()  { return $this->username; }
        function getRole()      { return $this->role;     }
	
	//setters
        function setID($id)                        {$this->id = $id;             }
	function setLastName($firstName)           {$this->firstName = $firstName; }	
        function setFirstName($lastName)           {$this->lastName = $lastName; }
        function setUsername($username)            {$this->username = $username;}
        function setRole($role)                    {$this->role = $role;         }
}
