<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allenamento in Corso</title>
    <link rel="stylesheet" href="../css/styleWorkout.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <form method="POST" action="../backend/terminateWorkoutController.php">
                <input type="hidden" name="workout_id">
                <button type="submit" class="terminate-btn">Termina</button>
            </form>
        </div>
        <div class="workout-info">
            <h1>Allenamento serale</h1>
            <p>0:00</p>
            <p class="note">Note</p>
        </div>
        <button class="action-btn add-exercise-btn">Aggiungi esercizi</button>
        <form method="POST" action="../backend/cancelWorkoutController.php">
            <input type="hidden" name="workout_id">
            <button type="submit" class="action-btn cancel-workout-btn">Annulla allenamento</button>
        </form>
    </div>
</body>
</html>
