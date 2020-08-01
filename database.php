<?php
 
error_reporting(E_ALL);
ini_set('display_errors', 'On');
 
$username = "magazin_cafea"; //username-ul de conectare la baza de date
$password = "cafea";         // parola de conectare la baza de date
$database = "localhost/XE";  // connect string-ul pentru a ne conecta la baza de date
 
$c = oci_connect($username, $password, $database);
if (!$c) {
    $m = oci_error();
    trigger_error('Could not connect to database: '. $m['message'], E_USER_ERROR);
}
 
?>