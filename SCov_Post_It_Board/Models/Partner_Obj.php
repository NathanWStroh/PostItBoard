<?php

class Partner_Obj {
    	//variables
        private $id; //int
	private $partnerName; //strings

	//getters
        function getID()            { return $this->id;       }
	function getPartnerName()   { return $this->partnerName; }
	
	//setters
        function setID($id)                       {$this->id = $id;                     }
	function setPartnerName($partnerName)     {$this->partnerName = $partnerName;   }
}
