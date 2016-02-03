<!--
Parnter Notice Client.
Data retrieval class 

Last Modified: 2-2-2016
--Read comments
--Filled in shell with psuedo code for the time being.

This page calls the data from the database
-->

<?php
require_once('SCov_PostIt_Obj.php');

class PostItData {
	
	$postItList = [];
	
	$postItObj = new $SCov_PostIt_Obj;
	
	$result = mysql_query('SELECT * FROM PostItTable'); //will rewrite once the table is made and named.
	if(!$result) { die('Invalid query: '.mysql_error());}
	
	//will place each line of query into a PostItObj
	while ($row = mysql_fetch_object($result)) {
		$postItObj.setTeam($row->team_name);
		$postItObj.setPartner($row->partner_name);
		$postItObj.setIssues($row->issues);
		$postItObj.setIssuedRep($row->issues_rep);
		$postItObj.setStatus($row->status);
		$postItObj.setEntryDate($row->entry_date);
		
		if($row->close_date != null) { //will need to add in some more catches.
			$postItObj.setCloseDate($row->close_date);
		}else{
			$postItObj.setCloseDate('');
		}
		
		$postItList[] = $postItObj; //adds objects to array.
	} 
}
?>