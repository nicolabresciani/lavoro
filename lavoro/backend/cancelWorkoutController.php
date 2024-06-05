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
        // Cancella l'allenamento
        $sql = "DELETE FROM Workouts WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $workout_id, $user_id);

        if ($stmt->execute()) {
            header("Location: ../frontend/startWorkout.php");
        } else {
            throw new Exception("Errore durante la cancellazione dell'allenamento: " . $stmt->error);
        }
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../frontend/workout.php?workout_id=$workout_id");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../frontend/workout.php");
    exit;
}
?>
