<?php
    // Connessione al database 
    $servename = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Palestra";

    $conn = new mysqli($servename, $username, $password, $dbname);

    // Controllo della connessione
    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

?>