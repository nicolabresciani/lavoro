<?php
session_start();

// Connessione al database
include "../connessione.php";

// Funzione per validare l'email
function validaEmail($email) {
    return strpos($email, '@') !== false;
}

// Funzione per validare la password con almeno 5 caratteri
function validaPassword($password) {
    return strlen($password) >= 5;
}

// Registrazione utente
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST["username"]);
    $nome = $conn->real_escape_string($_POST["nome"]);
    $cognome = $conn->real_escape_string($_POST["cognome"]);
    $password = $_POST["password"];
    $mail = $conn->real_escape_string($_POST["mail"]);

    $hashPassword = md5($password);

    // Verifica se lo username è già registrato
    $verificaUsername = "SELECT * FROM Utenti WHERE Username='$username'";
    $resultUsername = $conn->query($verificaUsername);

    if ($resultUsername->num_rows > 0) {
        $_SESSION['error'] = "Errore: Il nome utente '$username' è già registrato.";
        header("Location: ../frontend/Registra.php");
        exit();
    }

    // Verifica se l'email è già registrata
    $verificaEmail = "SELECT * FROM Utenti WHERE email='$mail'";
    $resultEmail = $conn->query($verificaEmail);

    if ($resultEmail->num_rows > 0) {
        $_SESSION['error'] = "Errore: L'indirizzo email '$mail' è già registrato.";
        header("Location: ../frontend/Registra.php");
        exit();
    }

    // Validazione dell'email
    if (validaEmail($mail)) {
        // Validazione della password
        if (validaPassword($password)) {
            // Inserimento dati nel database
            $inserisci = "INSERT INTO Utenti (Username, Nome, Cognome, Password, email) 
                          VALUES ('$username', '$nome', '$cognome', '$hashPassword', '$mail')";

            if ($conn->query($inserisci) === TRUE){
                $last_id = $conn->insert_id;

                // Inserimento di un esercizio di esempio per il nuovo utente
                $nomeEsercizio = "Esempio Esercizio";
                $descrizione = "Descrizione dell'esercizio di esempio.";
                $gruppo_muscolare = "Generale";

                $inserisciEsercizio = "INSERT INTO esercizi (nome, utente_id, descrizione, gruppo_muscolare) 
                                       VALUES ('$nomeEsercizio', '$last_id', '$descrizione', '$gruppo_muscolare')";

                if ($conn->query($inserisciEsercizio) === TRUE) {
                    header("Location: ../frontend/Login.php");
                    exit();
                } else {
                    $_SESSION['error'] = "Errore: " . $conn->error;
                    header("Location: ../frontend/Registra.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Errore: " . $conn->error;
                header("Location: ../frontend/Registra.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Errore: La password deve contenere almeno 5 caratteri.";
            header("Location: ../frontend/Registra.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Errore: Indirizzo email non valido.";
        header("Location: ../frontend/Registra.php");
        exit();
    }

    // Chiudi connessione database
    $conn->close();
}
?>
