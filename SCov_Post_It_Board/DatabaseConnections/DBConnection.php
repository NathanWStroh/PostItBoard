<?php

class DBConnection {

    //this function will need to be updated to allow for proper db connection on live server.
    public function dbconnect($user, $pass) {
        $query;
        $servername = 'localhost';
        $database = 'scov_post_it';

        try {
            $connection = new mysqli($servername, $user, $pass, $database);

            if ($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
                }else{
                    return $connection;
                }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
