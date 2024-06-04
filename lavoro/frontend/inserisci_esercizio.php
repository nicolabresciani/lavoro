<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci Esercizio</title>
    <link rel="stylesheet" href="../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        nav {
            display: flex;
            justify-content: flex-end;
            background-color: #f8f8f8;
            padding: 10px 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: right;
        }
        nav ul li {
            display: inline;
            margin-right: 20px;
        }
        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #28a745;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="inserisciDati.php">Home</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Inserisci Esercizio</h1>
        <form action="../backend/inserisci_esercizio.php" method="post" class="form-group">
            <div class="form-group">
                <label for="nomeEsercizio">Nome Esercizio</label>
                <input type="text" id="nomeEsercizio" name="nomeEsercizio" required>
            </div>
            <div class="form-group">
                <label for="descrizioneEsercizio">Descrizione Esercizio</label>
                <input type="text" id="descrizioneEsercizio" name="descrizioneEsercizio" required>
            </div>
            <div class="form-group">
                <label for="gruppoMuscolare">Gruppo Muscolare</label>
                <input type="text" id="gruppoMuscolare" name="gruppoMuscolare" required>
            </div>
            <button type="submit">Inserisci Esercizio</button>
        </form>
    </div>
</body>
</html>
