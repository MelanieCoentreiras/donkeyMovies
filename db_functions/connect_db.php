<?php
    

    function connectDatabase()
    {
        return new PDO('mysql:host='.DB_HOST.';dbname='.DB_DB, DB_USER, DB_PASS);
    }

?>