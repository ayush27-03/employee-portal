<?php
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','portal');

    try{
        $conn = new PDO(
            "mysql:host=127.0.0.1;dbname=".DB_NAME, 
            DB_USER, 
            DB_PASS
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        /**
         * The selected line of code configures the error handling behavior for a PDO (PHP Data Objects) database connection. 
         * Here, $con is assumed to be a PDO object that represents an active connection to a database.
         * By calling the setAttribute method with the parameters PDO::ATTR_ERRMODE and PDO::ERRMODE_EXCEPTION,
         * it sets the error mode of the PDO connection to throw exceptions whenever a database error occurs.
         */
        // echo "✅Connected successfully to MySQL at 127.0.0.1 using PDO!<hr/>";
    } catch(PDOException $e) {
        echo "❌Connection failed<hr/>" . $e->getMessage();
    }
    //@ $conn = null; // Close the connection
    //? $conn is set to null to close the connection
    /**
     * Password validation
     if (password_verify($userInput, $hashedPassword)) {
        echo "Password is valid!";} else {
        echo "Invalid password.";}
       
        //@ userInput is the password entered by the user, and hashedPassword is the hashed password stored in the database.
     */
?>