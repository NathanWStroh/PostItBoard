<?php

class Partner_Obj {
    	//variables
        private $id, $partnerNumber,$scrUserID; //int
	private $partnerName, $scrGroupName; //strings

	//getters
        function getID()            { return $this->id;       }
	function getPartnerName()   { return $this->partnerName; }
        function getPartnerNumber() { return $this->partnerNumber; }
        function getScrUserID()     { return $this->scrUserID; }
        function getScrGroupName()  { return $this->scrGroupName; }
	
	//setters
        function setID($id)                           {$this->id = $id;                     }
	function setPartnerName($partnerName)         {$this->partnerName = $partnerName;   }
	function setPartnerNumber($partnerNumber)     {$this->partnerNumber = $partnerNumber;   }
	function setScrUserID($scrUserID)             {$this->scrUserID = $scrUserID;   }
	function setScrGroupName($scrGroupName)        {$this->scrGroupName = $scrGroupName;   }
}
