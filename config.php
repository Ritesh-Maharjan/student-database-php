<?php
require_once("dbinfo.php");
session_start();
const TIMEOUT_IN_SECONDS = 3600;


//instantiate a mysqli object and establish connection to database
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);


//determine if connection was successful 
if (mysqli_connect_errno() != 0) {
    die('DB Connection failed');
}

