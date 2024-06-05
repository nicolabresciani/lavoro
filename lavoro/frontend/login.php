<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strong - Login</title>
    <link rel="stylesheet" href="../css/styleIndex.css">
</head>
<body>
    <div class="container">
        <div class="content">
            <h1>Accedi a Strong</h1>
            <?php
            session_start();
            if (isset($_SESSION['login_error'])) {
                echo '<p class="error-message">' . htmlspecialchars($_SESSION['login_error']) . '</p>';
                unset($_SESSION['login_error']);
            }
            ?>
            <form action="../backend/loginController.php" method="POST">
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
                <button type="submit" class="register-btn">Accedi</button>
            </form>
        </div>
    </div>
</body>
</html>
