<?php
session_start();
include 'config.php';

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$workout_id = $_GET['workout_id'];

// Recupera le informazioni dell'allenamento dal database
$sql = "SELECT * FROM Workouts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $workout_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "Allenamento non trovato.";
    exit;
}

$workout = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allenamento in Corso</title>
    <link rel="stylesheet" href="../css/styleIndex.css">
    <style>
        /* Same CSS as above */
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <button onclick="window.history.back();">
                <img src="../icons/back-icon.png" alt="Indietro">
            </button>
            <button class="terminate-btn" onclick="terminateWorkout();">Termina</button>
        </div>
        <div class="workout-info">
            <h1><?php echo htmlspecialchars($workout['nome']); ?></h1>
            <p><?php echo htmlspecialchars($workout['durata']); ?></p>
            <p class="note"><?php echo htmlspecialchars($workout['note']); ?></p>
        </div>
        <button class="action-btn add-exercise-btn" onclick="location.href='addExercise.php?workout_id=<?php echo $workout_id; ?>'">Aggiungi esercizi</button>
        <button class="action-btn cancel-workout-btn" onclick="cancelWorkout();">Annulla allenamento</button>
    </div>

    <script>
        function terminateWorkout() {
            if (confirm("Sei sicuro di voler terminare l'allenamento?")) {
                window.location.href = "../backend/terminateWorkoutController.php?workout_id=<?php echo $workout_id; ?>";
            }
        }

        function cancelWorkout() {
            if (confirm("Sei sicuro di voler annullare l'allenamento?")) {
                window.location.href = "../backend/cancelWorkoutController.php?workout_id=<?php echo $workout_id; ?>";
            }
        }
    </script>
</body>
</html>
