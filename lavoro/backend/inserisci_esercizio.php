<?php
session_start();

// Connessione al database
include "../connessione.php";

// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

// Recupera i dati inviati dal form
$nomeEsercizio = $_POST['nomeEsercizio'];
$descrizioneEsercizio = $_POST['descrizioneEsercizio'];
$gruppoMuscolare = $_POST['gruppoMuscolare'];

// Query per inserire l'esercizio nel database
$inserisciQuery = "INSERT INTO Esercizi (nome, descrizione, gruppo_muscolare) VALUES ('$nomeEsercizio', '$descrizioneEsercizio', '$gruppoMuscolare')";

if ($conn->query($inserisciQuery) === TRUE) {
    $_SESSION['success'] = "Esercizio inserito con successo!";
} else {
    $_SESSION['error'] = "Errore durante l'inserimento dell'esercizio: " . $conn->error;
}

// Reindirizzamento alla pagina inserisciDati.php
header("Location: ../frontend/inserisciDati.php");
exit();
?>
