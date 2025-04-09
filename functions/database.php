<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "coolgames";
$sqlFilePath = "sql/coolgames.sql";
$con = mysqli_connect($dbhost,$dbuser,$dbpass); //Alap csatlakozás a PhPMyAdminhoz

$dataBaseBeeing = mysqli_query($con, "SHOW DATABASES LIKE '$dbname'"); //Megnézzük létezik-e az Adatbázis
if(mysqli_num_rows($dataBaseBeeing)==0){ //Ha nem, létrehozzuk, és megpróbálunk rá csatlakozni
    if(mysqli_query($con,"CREATE DATABASE $dbname")){
        $con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

        //Import SQL fájl
        $sqlContent = file_get_contents($sqlFilePath);
        if ($sqlContent === false) {
            die("Nem sikerült beolvasni az SQL fájlt.");
        }

        $queries = explode(";", $sqlContent); //Kicsi query-kre osztás
        foreach ($queries as $query) {
            $query = trim($query);
            if (!empty($query)) {
                if (!mysqli_query($con, $query)) {
                    echo "SQL import hiba: " . mysqli_error($con) . "<br>";
                }
            }
        }
    }
    else{   //Ha valami hiba történt csatlakozáskor létrehozás után
        die("Adatbázis nem lett létrehozva.");
    }
}
else{ //Amúgy, ha létezik próbáljon meg normálisan csatlakozni
    if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)){
        die("Nem tudtunk csatlakozni az adatbazishoz!");
    }
}

if(session_status()==1){ //Lekezelés, hogy kívülről ne lehessen elérni
    header("Location: ../index.php");
}