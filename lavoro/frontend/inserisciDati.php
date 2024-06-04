<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Dati</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        /* Stili CSS qui */
        .exercise form {
            display: none; /* Nascondi le form all'inizio */
        }
        .exercise.active form {
            display: block; /* Mostra la form quando la div di esercizio è attiva */
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="inserisci_esercizio.php">Inserisci esercizio</a></li>
            <li><a href="dashboard.html">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container" id="exerciseContainer">
        <h1>Esercizi Inseriti</h1>
    </div>

    <script>
        // Codice JavaScript qui
        const exerciseContainer = document.getElementById('exerciseContainer');

        fetch('../backend/elenco_esercizi.php')
            .then(response => response.json())
            .then(data => {
                data.forEach(exercise => {
                    const exerciseElement = document.createElement('div');
                    exerciseElement.classList.add('exercise');
                    exerciseElement.innerHTML = `
                        <h2>${exercise.nome}</h2>
                        <p>${exercise.descrizione}</p>
                        <p>${exercise.gruppoMuscolare}</p>
                        <button class="expand-btn">Aggiungi dati specifici</button>
                        <form>
                            <!-- Aggiungi qui i campi per le ripetizioni, il peso alzato, ecc. -->
                            <label for="ripetizioni">Ripetizioni:</label>
                            <input type="number" id="ripetizioni" name="ripetizioni">
                            <label for="peso">Peso (kg):</label>
                            <input type="number" id="peso" name="peso">
                            <!-- Aggiungi altri campi necessari -->
                            <button type="submit">Inserisci dati</button>
                        </form>
                    `;
                    exerciseContainer.appendChild(exerciseElement);

                    // Aggiungi un gestore di eventi al pulsante di espansione
                    const expandBtn = exerciseElement.querySelector('.expand-btn');
                    expandBtn.addEventListener('click', () => {
                        exerciseElement.classList.toggle('active');
                    });
                });
            });
    </script>
</body>
</html>
