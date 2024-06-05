<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Controlla se i campi sono riempiti
    if (empty($username) || empty($password)) {
        $_SESSION['login_error'] = "Tutti i campi sono obbligatori.";
        header("Location: ../frontend/login.php");
        exit;
    }

    // Prepara ed esegue la query di selezione
    $sql = "SELECT id, password FROM Users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verifica la password
        if (password_verify($password, $hashed_password)) {
            // Password corretta, imposta la sessione
            $_SESSION['user_id'] = $user_id;
            header("Location: ../frontend/startWorkout.php"); // Reindirizza alla dashboard o ad un'altra pagina protetta
            exit;
        } else {
            $_SESSION['login_error'] = "Password non corretta.";
            header("Location: ../frontend/login.php");
            exit;
        }
    } else {
        $_SESSION['login_error'] = "Username non trovato.";
        header("Location: ../frontend/login.php");
        exit;
    }

    $stmt->close();
    $conn->close();
}
?>
