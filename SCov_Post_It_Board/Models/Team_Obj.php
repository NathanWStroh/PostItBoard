<?php

class Team_Obj {

    //variables
    private $id; //int
    private $teamName; //strings
    private $msembers; //Array for partner notifications

    //getters

    function getID() {
        return $this->id;
    }

    function getTeamName() {
        return $this->teamName;
    }

    //setters
    function setID($id) {
        $this->id = $id;
    }

    function setTeamName($teamName) {
        $this->teamName = $teamName;
    }

}
