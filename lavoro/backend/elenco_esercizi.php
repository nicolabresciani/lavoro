<?php
    //elenca gli esercizi presenti nel database
    include '../connessione.php';

    $query = "SELECT * FROM esercizi";
    $result = $conn->query($query);

    $exercises = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $exercise = array(
                'nome' => $row['nome'],
                'descrizione' => $row['descrizione'],
                'gruppoMuscolare' => $row['gruppo_muscolare']
            );
            array_push($exercises, $exercise);
        }
    }

    header('Content-Type: application/json');
    echo json_encode($exercises);
    $conn->close();
?>