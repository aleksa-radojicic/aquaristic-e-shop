<?php

class DBBroker
{

    //reference to connection
    //(can be transformed into private variable in the future)
    public static mysqli $conn;
    
    //function for connecting to a database
    public static function connect()
    {
        //database credentials
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "iteh_homework_php";

        //creating new connection using MySQL DBMS
        DBBroker::$conn = new mysqli($host, $user, $pass, $db);

        //setting utf8 for unicode characters
        DBBroker::$conn->set_charset("utf8");

        //disable auto commit so we can handle transactions properly
        DBBroker::$conn->autocommit(false);
    }

    //disconnecting from the database
    public static function disconnect()
    {
        //closing connection
        DBBroker::$conn->close();

    }

    
    
    

}

?>