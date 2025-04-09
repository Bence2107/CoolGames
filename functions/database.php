<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "coolgames";
if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname))
{
    die("Nem tudtunk csatlakozni az adatbazishoz!");
}
