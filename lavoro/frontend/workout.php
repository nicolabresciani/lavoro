<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Allenamento in Corso</title>
    <link rel="stylesheet" href="../css/styleWorkout.css">
    <body>
    <div class="container">
        <div class="header">
            <div class="timer" id="timer">0:00</div>
            <form method="POST" action="../backend/terminateWorkoutController.php">
                <input type="hidden" name="workout_id">
                <button type="submit" class="terminate-btn">Termina</button>
            </form>
        </div>
        <div class="workout-info">
            <h1>Allenamento </h1>

            
            <p class="note">Note</p>
        </div>

        <button class="action-btn add-exercise-btn">Aggiungi esercizi</button>
        <form method="POST" action="../backend/cancelWorkoutController.php">
            <input type="hidden" name="workout_id">
            <button type="submit" class="action-btn cancel-workout-btn">Annulla allenamento</button>
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let timerElement = document.getElementById("timer");
            let startTime = Date.now();

            function updateTimer() {
                let elapsedTime = Date.now() - startTime;
                let totalSeconds = Math.floor(elapsedTime / 1000);
                let minutes = Math.floor(totalSeconds / 60);
                let seconds = totalSeconds % 60;

                timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            }

            setInterval(updateTimer, 1000);
        });
    </script>
</body>
</html>