<?php
if($_SERVER['HTTP_HOST']=='localhost' || $_SERVER['HTTP_HOST']=="127.0.0.1" || $_SERVER['HTTP_HOST']=="192.168.1.1"  || $_SERVER['HTTP_HOST']=="[::1]") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "kss";
}else{
    $servername = "dsvinfosolutions.ipagemysql.com";
    $username = "kss";
    $password = "latest@123";
    $db = "kss";
}


    try {
        $con = new PDO("mysql:host=$servername;dbname=$db", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "Connection failed: " . $e->getMessage();
    }