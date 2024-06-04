<?php
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
</head>
<body>
    <?php
    if (isset($_SESSION['error'])) {
        echo "<p style='color: red;'>{$_SESSION['error']}</p>";
        unset($_SESSION['error']);
    } elseif (isset($_SESSION['success'])) {
        echo "<p style='color: green;'>{$_SESSION['success']}</p>";
        unset($_SESSION['success']);
    }
    ?>
    <form id="registrazioneForm" method="post" action="../backend/RegistraController.php">
        <label for="username">Username:</label>
        <input type="text" name="username" required>
        <br>
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <br>
        <label for="cognome">Cognome:</label>
        <input type="text" name="cognome" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <br>
        <label for="mail">Mail:</label>
        <input type="email" name="mail" required>
        <br>
        <input type="submit" value="Registrati">
    </form>
    <div class="login-link">
        <a href="Login.php">Hai già un account? Accedi</a>
    </div>
</body>
</html>
