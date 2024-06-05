<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strong - Registrazione</title>
    <link rel="stylesheet" href="../css/stylePrenotazione.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Registrati su Strong</h1>
            <?php
            session_start();
            if (isset($_SESSION['error'])) {
                echo '<p style="color: red;">' . htmlspecialchars($_SESSION['error']) . '</p>';
                unset($_SESSION['error']);
            }
            if (isset($_SESSION['success'])) {
                echo '<p style="color: green;">' . htmlspecialchars($_SESSION['success']) . '</p>';
                unset($_SESSION['success']);
            }
            ?>
            <form action="../backend/registrazioneController.php" method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="email" name="email" placeholder="Email" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit">Registrati</button>
            </form>
        </div>
    </div>
</body>
</html>
