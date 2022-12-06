<?php

$absolute_root_path =  $_SERVER['DOCUMENT_ROOT'];

require($absolute_root_path."/classes.php");

//responsible for CRUD operations on domain class User
class UserModel
{

    //when user tries to log with entered credentials
    //returns User
    public static function getUserByEmailAndPassword($user_email, $user_password)
    {
        //connecting to the database
        DBBroker::connect();

        //SELECT only the User whose email and password match to entered email and password
        $query = "SELECT user_id, user_name FROM users 
        WHERE user_email= ? AND user_password = ?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param('ss', $user_email, $user_password);

        //executing statement
        $stmt->execute();

        //get result set in a variable
        $result = $stmt->get_result();

        //compute number of rows
        $no_of_rows = mysqli_num_rows($result);

        //if the query returned only one row, than the user typed correct credentials
        if ($no_of_rows == 1) {

            //get single row as an array
            $row = $result->fetch_assoc();

            $user_id = $row['user_id'];
            $user_name = $row['user_name'];

            //creating new User
            $user = new User($user_id, $user_name, $user_email);
        } else {
            //the user with that email and password doesn't exists
            $user = null;
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //returns a User with the given email and password or null if user wasn't found
        return $user;
    }

    //checks in db if the given email is not taken
    //returns true (typed email doesn't exists in db)
    //returns false (typed email exists, therefore it's not unique)
    public static function isEmailUnique($email)
    {

        //connecting to the database
        DBBroker::connect();

        //query for inserting new order into table orders; it returns 1 (account found) or 0 (not found)
        $query = "SELECT COUNT(*) AS count FROM users WHERE user_email=?";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param('s', $email);

        //executing statement
        $stmt->execute();

        //get result set in a variable
        $result = $stmt->get_result();

        $no_of_same_emails = $result->fetch_assoc()['count'];


        //if user with typed email already exists
        if ($no_of_same_emails == 1) {
            //typed email isn't unique
            $email_unique = false;

            //if user with typed email doesn't exists
        } else {
            //typed email is unique
            $email_unique = true;
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //returns email found
        return $email_unique;
    }


    //create new User (registration)
    //returns boolean (query success status)
    public static function createUser(User $user)
    {
        //connecting to the database
        DBBroker::connect();

        //query for inserting new order into table orders
        $query = "INSERT INTO users (user_name, user_email, user_password)
        VALUES (?,?,?)";

        //creating prepare statement
        $stmt = DBBroker::$conn->prepare($query);

        //binding params into created prepared statement
        $stmt->bind_param('sss', $user->user_name, $user->user_email, $user->user_password);

        //keep status of query execution in a variable
        $signal = $stmt->execute();

        //check if the query was successful
        if ($signal) {
            //set order's foreign key to the automaticaly generated id from db
            $user->user_id = $stmt->insert_id;;
        }

        //commit transaction
        DBBroker::$conn->commit();

        //close statement
        $stmt->close();

        //close database connection
        DBBroker::disconnect();

        //returns a signal of success (true) or failure (false)
        return $signal;
    }

}
?>