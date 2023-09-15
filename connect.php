<?php

    $HOSTNAME=  'localhost';
    $USERNAME=  'root';
    $PASSWORD=  'root';
    $DATABASE=  'signupforms';


    try {
        $conn = new PDO("mysql:host=$HOSTNAME;dbname=$DATABASE", $USERNAME, $PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        $error = $e->getMessage();
        echo "Error: -> $error";
    }
    

?>