<?php
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "loginsystem";

// Create connection to the database
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// Check connection to the database
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
