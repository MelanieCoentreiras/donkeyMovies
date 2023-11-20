<?php
    
/*
    function connectDatabase()
    {
        return new PDO('mysql:host='.DB_HOST.';dbname='.DB_DB, DB_USER, DB_PASS);
    }
*/
    function connectDB() {
        // appelle le fichier connect
        require_once 'connect.php';
        // () définit dans le fichier connect
        $pdo = new \PDO(DSN, USER, PASSWORD);
        // renvoyer l'info avec un return
        return $pdo;
    }
    
?>