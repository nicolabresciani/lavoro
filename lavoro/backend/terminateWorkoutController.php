<?php
session_start();
include 'config.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: ../frontend/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $workout_id = $_POST['workout_id'];

    try {
        // Aggiorna lo stato dell'allenamento come terminato
        $sql = "UPDATE Workouts SET stato = 'terminato', data_fine = NOW() WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $workout_id, $user_id);

        if ($stmt->execute()) {
            header("Location: ../frontend/startWorkout.php");
            exit; // Assicurati di uscire dopo l'invio dell'intestazione
        } else {
            throw new Exception("Errore durante l'aggiornamento dell'allenamento: " . $stmt->error);
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../frontend/workout.php?workout_id=$workout_id");
        exit; // Assicurati di uscire dopo l'invio dell'intestazione
    } finally {
        // Chiudi il prepared statement e la connessione solo se sono stati definiti
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    header("Location: ../frontend/workout.php");
    exit; // Assicurati di uscire dopo l'invio dell'intestazione
}
?>
