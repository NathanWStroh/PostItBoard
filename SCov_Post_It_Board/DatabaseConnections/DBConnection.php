<?php

class DBConnection {

    //this function will need to be updated to allow for proper db connection on live server.
    public function dbconnect() {
//        $basicLoginUsername = 'isp_postboard';
//        $basicLoginPassword = 'SCpost01!';
//        $servername = '172.25.0.151';
//        $database = 'scov_post_it';

        $basicLoginUsername = 'root';
        $basicLoginPassword = 'root';
        $servername = 'localhost';
        $database = 'scov_post_it';
        
        try {
            $connection = new mysqli($servername, $basicLoginUsername, $basicLoginPassword, $database);

            if ($connection->connect_error) {
                die('<p style="color:red;">Connection failed: ' . $connection->connect_error.'</p>');
                }else{
                    return $connection;
                }
        } catch (PDOException $e) {
            echo '<p style="color:red;">Connection failed: ' . $e->getMessage().'</p>';
        }
    }
}
