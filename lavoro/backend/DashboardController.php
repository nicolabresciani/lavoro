<?php
session_start();

// Connessione al database
include "../connessione.php";

// Controlla se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    header("Location: Login.php");
    exit();
}

$username = $_SESSION['username'];

// Recupera l'ID dell'utente
$userQuery = "SELECT id FROM Utenti WHERE Username='$username'";
$userResult = $conn->query($userQuery);
$userRow = $userResult->fetch_assoc();
$userId = $userRow['id'];

// Recupera i dati degli allenamenti
$allenamentiQuery = "
    SELECT es.esercizio_id, e.nome as esercizio, es.peso, es.ripetizioni, s.data
    FROM Esercizi_Sessioni es
    JOIN Sessioni s ON es.sessione_id = s.id
    JOIN Esercizi e ON es.esercizio_id = e.id
    WHERE s.user_id = '$userId'
    ORDER BY es.esercizio_id, s.data ASC";

$allenamentiResult = $conn->query($allenamentiQuery);

$allenamenti = [];
if ($allenamentiResult->num_rows > 0) {
    while ($row = $allenamentiResult->fetch_assoc()) {
        $allenamenti[$row['esercizio']][] = $row;
    }
}

// Chiudi connessione database
$conn->close();

// Passa i dati degli allenamenti al frontend
header('Content-Type: application/json');
echo json_encode($allenamenti);
?>
