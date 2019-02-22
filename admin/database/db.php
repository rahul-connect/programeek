<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'programeek';


$con = mysqli_connect($host,$user,$pass,$db_name);

if(!$con){
	die();
}
session_start(); 

?>