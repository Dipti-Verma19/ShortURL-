<?php

 try{

    $host="localhost";
    $dbname="shorturl";
    $user="postgres";
    $pass="1234";

    $conn = new PDO("pgsql:host=$host;port=5432;dbname=$dbname;",$user,$pass);
    //echo "Connected to PGsql";
 }
 catch(PDOException $e){
    echo "Error is ".$e->getMessage();
 }
?>