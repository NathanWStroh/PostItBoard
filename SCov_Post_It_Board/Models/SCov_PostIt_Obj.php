<!--
Parnter Notice Client.
Post It Data Object 

Last Modified: 2-2-2016
--renamed class and file to better reflect the object.
-->

<?php
class PostIts {
	//variables
	private $id, $team, $partner, $issues, $issuedRep, $status, $alert,$news, $updatedRep, $closedRep; //strings
	private $entryDate, $closeDate; //date

	//getters
        function getPostItID()      { return $this->id; }
	function getTeam()          { return $this->team; }
	function getPartner()       { return $this->partner; }
	function getIssues()        { return $this->issues; }
	function getIssuedRep()     { return $this->issuedRep; }
	function getStatus()        { return $this->status; }
	function getEntryDate()     { return $this->entryDate; }
	function getCloseDate()     { return $this->closeDate; }
	function getAlertStatus()   { return $this->alert; }
	function getCurrentNews()   { return $this->news; }
        function getUpdatedRep()    { return $this->updatedRep; }
        function getClosedRep()     { return $this->closedRep; }
	
	//setters
	function setPostItID ($id)          {$this->id = $id; }
	function setTeam($team)             {$this->team = $team; }	
	function setPartner($partner)       {$this->partner = $partner; }
	function setIssues($issues)         {$this->issues = $issues; }
	function setIssuedRep($issuedRep)   {$this->issuedRep = $issuedRep; }
	function setStatus($status)         {$this->status = $status; }
	function setEntryDate($entryDate)   {$this->entryDate = $entryDate; }
	function setCloseDate($closeDate)   {$this->closeDate = $closeDate; }
        function setAlertStatus($alert)     {$this->alert = $alert; }
        function setCurrentNews($news)      {$this->news = $news;           }
        function setUpdatedRep($updatedRep) {$this->updatedRep = $updatedRep;}
        function setClosedRep($closedRep)    {$this->closedRep = $closedRep;  }
}