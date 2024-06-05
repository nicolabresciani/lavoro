<?php
session_start();
include 'config.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['username'])) {
    header("Location: ../frontend/login.php");
    exit;
}

$user_id = $_SESSION['username'];

try {
    // Prepara ed esegue la query di inserimento per un nuovo allenamento
    $sql = "INSERT INTO Workouts (user_id, nome, data, durata, totale_kg_sollevati) VALUES ('$user_id', '', NOW(), '00:00:00', 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        // Redirect to the workout page or dashboard
        header("Location: ../frontend/workout.php");
    } else {
        throw new Exception("Errore durante l'inserimento dell'allenamento: " . $stmt->error);
    }
} catch (Exception $e) {
    $_SESSION['error'] = $e->getMessage();
    header("Location: ../frontend/startWorkout.php");
}
$stmt->close();
$conn->close();
?>
