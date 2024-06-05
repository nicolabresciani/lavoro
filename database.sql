--se non esiste il database, lo crea
CREATE DATABASE IF NOT EXISTS gym_db;
DROP gym_db AND USE  gym_db;

CREATE TABLE Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    data_registrazione DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Workouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    nome VARCHAR(100),
    data DATETIME DEFAULT CURRENT_TIMESTAMP,
    durata TIME,
    totale_kg_sollevati FLOAT,
    FOREIGN KEY (user_id) REFERENCES Users(id)
);

CREATE TABLE Exercises (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    immagine VARCHAR(255),
    parte_del_corpo VARCHAR(50)
);

CREATE TABLE WorkoutDetails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    workout_id INT,
    exercise_id INT,
    kg_sollevati FLOAT,
    ripetizioni INT,
    serie INT,
    FOREIGN KEY (workout_id) REFERENCES Workouts(id),
    FOREIGN KEY (exercise_id) REFERENCES Exercises(id)
);

CREATE TABLE CompletedWorkouts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    workout_id INT,
    nome VARCHAR(100),
    data DATETIME,
    durata TIME,
    totale_kg_sollevati FLOAT,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (workout_id) REFERENCES Workouts(id)
);

CREATE TABLE BestPerformance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    exercise_id INT,
    migliore_kg_sollevati FLOAT,
    migliore_ripetizioni INT,
    FOREIGN KEY (user_id) REFERENCES Users(id),
    FOREIGN KEY (exercise_id) REFERENCES Exercises(id)
);
