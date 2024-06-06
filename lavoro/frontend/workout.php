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
            <div class="timer" id="timer">0:00</div>
            <form id="terminate-form" method="POST" action="../backend/terminateWorkoutController.php">
                <input type="hidden" name="workout_id"> 
                <button type="submit" class="terminate-btn" id="terminate-btn">Termina</button>
            </form>
        </div>
        <div class="workout-info">
            <h1 id="workout-name">Allenamento &nbsp 
                <img src="../img/modifica.png" alt="Modifica" id="edit-icon"> 
            </h1>
        </div>
        <button class="action-btn add-exercise-btn" id="add-exercise-btn">Aggiungi esercizi</button>
        <form method="POST" action="../backend/cancelWorkoutController.php">
            <input type="hidden" name="workout_id" value="123"> <!-- Replace with actual workout ID -->
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

            // Edit workout name functionality
            function makeNameEditable() {
                let editIcon = document.getElementById("edit-icon");
                let workoutNameElement = document.getElementById("workout-name");

                editIcon.addEventListener("click", function() {
                    let currentName = workoutNameElement.childNodes[0].textContent.trim();
                    workoutNameElement.innerHTML = `
                        <input type="text" id="workout-name-input" value="${currentName}">
                        <button id="save-name-btn">Salva</button>
                    `;
                    let saveNameBtn = document.getElementById("save-name-btn");
                    let workoutNameInput = document.getElementById("workout-name-input");

                    saveNameBtn.addEventListener("click", function() {
                        let newName = workoutNameInput.value.trim();
                        if (newName) {
                            workoutNameElement.innerHTML = `${newName} &nbsp 
                                <img src="../img/modifica.png" alt="Modifica" id="edit-icon">
                            `;
                            makeNameEditable();
                        }
                    });
                });
            }

            makeNameEditable();

            // Modal functionality
            let modal = document.getElementById("exercise-modal");
            let addExerciseBtn = document.getElementById("add-exercise-btn");
            let closeModalBtn = document.querySelector(".modal .close");

            addExerciseBtn.addEventListener("click", function() {
                modal.style.display = "block";
            });

            closeModalBtn.addEventListener("click", function() {
                modal.style.display = "none";
            });

            window.addEventListener("click", function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            });

            // Terminate workout confirmation
            let terminateBtn = document.getElementById("terminate-btn");
            let terminateForm = document.getElementById("terminate-form");

            terminateBtn.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent the form from submitting immediately
                let confirmation = confirm("Sei sicuro di voler terminare la sessione di allenamento?");
                if (confirmation) {
                    terminateForm.submit();
                }
            });
        });
    </script>
</body>
</html>
