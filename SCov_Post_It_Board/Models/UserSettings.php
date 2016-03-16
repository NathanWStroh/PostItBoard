<?php

class UserSettings {
       	//variables
        private $settingsID, $partnerName, $visible ; //int

	//getters
        function getSettingID() { return $this->settingsID; }
	function getPartnerName()	{ return $this->partnerName;  }
        function getVisible()   { return $this->visible;    }
	
	//setters
        function setSettingID($settingsID)          {$this->settingsID = $settingsID;   }	
        function setPartnerName($partnerName)           {$this->partnerName = $partnerName;     }
        function setVisible($visible)               {$this->visible = $visible;         }
}
