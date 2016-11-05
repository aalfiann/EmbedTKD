<?php 
include 'library.php';
// Start Configuration
//Title website
$sitetitle = 'Embed TKD Express';

//Version 
$version = '1.0';

//Author
$author = 'M ABD AZIZ ALFIAN';

//API TKD Express
$api = "https://api.tkd.co.id/v2/";

//Change this to true if website using ssl
$ssl = true;
$website = Protocol($ssl,'EmbedTKD');

//Show all error
error_reporting(E_ALL);

//Set display error, better to switch off for production
ini_set('display_errors','Off');
//End Configuration

?>