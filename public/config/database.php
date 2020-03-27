<?php


/*

Connexion PHP my SQL avec PDO


*/

try{
    $db = new PDO(
        "mysql:host=$db_host;dbname=$db_name",
        $db_user,
        $db_password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //Active les erreurs SQL
            //On récupere tous les resultats en associatif
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

}catch (Exception $e){
    echo $e->getMessage();
    exit();
}