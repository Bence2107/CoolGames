<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "coolgames";
$con = mysqli_connect($dbhost,$dbuser,$dbpass, '',3307);

$dataBaseBeeing = mysqli_query($con, "SHOW DATABASES LIKE '$dbname'"); //Megnézzük létezik-e az Adatbázis
if(mysqli_num_rows($dataBaseBeeing)==0){ //Ha nem, létrehozzuk, és megpróbálunk rá csatlakozni
    if(mysqli_query($con,"CREATE DATABASE $dbname")){
        $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname, 3307);
    }
    else{   //Ha valami hiba történt csatlakozáskor létrehozás után
        die("Adatbázis nem lett létrehozva.");
    }
}
else{ //Amúgy, ha létezik próbáljon meg normálisan csatlakozni
    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname, 3307)){
        die("Nem tudtunk csatlakozni az adatbazishoz!");
    }
}
