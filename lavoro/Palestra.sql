DROP DATABASE IF EXISTS Palestra;
CREATE DATABASE Palestra;
USE Palestra;
--sistemare che un utente che si registra non deve vedere tutti i campi degli esercizi ma solamente i suoi


CREATE TABLE `Utenti` (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    nome VARCHAR(255) NOT NULL,
    cognome VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    data_registrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE Esercizi (
    id int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    utente_id INT,
    descrizione TEXT,
    gruppo_muscolare VARCHAR(50),
    FOREIGN KEY (utente_id) REFERENCES Utenti(id)
);

CREATE TABLE Sessioni (
    id int AUTO_INCREMENT PRIMARY KEY,
    utente_id INT,
    data DATE,
    FOREIGN KEY (utente_id) REFERENCES Utenti(id)
);

CREATE TABLE Esercizi_Sessioni (
    id int AUTO_INCREMENT PRIMARY KEY,
    sessione_id INT,
    esercizio_id INT,
    ripetizioni INT,
    peso DECIMAL(5, 2),
    serie INT,
    FOREIGN KEY (sessione_id) REFERENCES Sessioni(id),
    FOREIGN KEY (esercizio_id) REFERENCES Esercizi(id)
);