<?php
// Start the session
session_start();

// Connessione al database 
include "../connessione.php";

// Funzione per verificare l'autenticità dell'utente
function verificaAutenticitaUtente($conn, $username, $password) {
    // Prepara la query per selezionare l'utente con username e password forniti
    $verifica = "SELECT * FROM UtentI WHERE Username='$username' AND Password='$password'";
    
    // Esegue la query
    $result = $conn->query($verifica);

    // Verifica se l'utente è stato trovato
    if ($result->num_rows > 0) {
        // Ottieni i dettagli dell'utente
        $row = $result->fetch_assoc();
        return true; // Utente trovato
    } else {
        return false; // Utente non trovato
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Verifica se l'utente è un "Utente"
    $auth_result = verificaAutenticitaUtente($conn, $username, $password);
    if ($auth_result === true) {
        // Inizializza la sessione
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;

        // Reindirizza alla home
        header("Location: ../frontend/dashboard.html");
        exit();
    } else {
        // Mostra un messaggio di errore
        $_SESSION["error"] = "Credenziali non valide. Riprova.";
        header("Location: ../frontend/Login.php");
        exit();
    }
}

// Chiudi connessione database
$conn->close();