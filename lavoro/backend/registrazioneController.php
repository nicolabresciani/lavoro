<?php
// Inizia la sessione
session_start();

// Include file di configurazione del database
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Riceve i dati dal modulo di registrazione
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Controlla se i campi sono riempiti
    if (empty($username) || empty($password) || empty($email)) {
        $_SESSION['error'] = "Tutti i campi sono obbligatori.";
        header("Location: ../frontend/registrazione.php");
        exit;
    }

    // Cripta la password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Inizio della transazione
    $conn->begin_transaction();

    try {
        // Prepara ed esegue la query di inserimento per gli utenti
        $sql = "INSERT INTO Users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        if (!$stmt->execute()) {
            // Controlla se l'errore è dovuto a duplicati di username o email
            if ($conn->errno == 1062) {
                // Estrae il campo duplicato dall'errore
                if (strpos($stmt->error, 'username') !== false) {
                    $_SESSION['error'] = "Username già esistente.";
                } elseif (strpos($stmt->error, 'email') !== false) {
                    $_SESSION['error'] = "Email già esistente.";
                }
            } else {
                throw new Exception($stmt->error);
            }
        }

        // Ottiene l'ID dell'utente appena inserito
        $user_id = $conn->insert_id;

        // Inserisce i dati iniziali per CompletedWorkouts
        $sql = "INSERT INTO CompletedWorkouts (user_id, workout_id, nome, data, durata, totale_kg_sollevati) VALUES (?, NULL, '', NOW(), '00:00:00', 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Inserisce i dati iniziali per BestPerformance
        $sql = "INSERT INTO BestPerformance (user_id, exercise_id, migliore_kg_sollevati, migliore_ripetizioni) VALUES (?, NULL, 0, 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Inserisce i dati iniziali per Workouts
        $sql = "INSERT INTO Workouts (user_id, nome, data, durata, totale_kg_sollevati) VALUES (?, '', NOW(), '00:00:00', 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            throw new Exception($stmt->error);
        }

        // Commit della transazione
        $conn->commit();

        // Reindirizza alla pagina di login con messaggio di successo
        $_SESSION['success'] = "Registrazione avvenuta con successo!";
        header("Location: ../frontend/login.php");
    } catch (Exception $e) {
        // Rollback della transazione in caso di errore
        $conn->rollback();
        // Salva il messaggio di errore nella sessione e reindirizza alla pagina di registrazione
        $_SESSION['error'] = $e->getMessage();
        header("Location: ../frontend/registrazione.php");
    }
    $conn->close();
}
?>
