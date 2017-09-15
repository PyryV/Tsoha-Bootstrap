-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Pelaaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    pelipaikka varchar(10) NOT NULL,
    joukkue varchar(50) NOT NULL,
    taso INTEGER 
);

CREATE TABLE Kayttaja(
    id SERIAL PRIMARY KEY,
    nimi varchar(20) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Joukkue(
    pelaaja INTEGER,
    omistaja INTEGER,
    nimi varchar(20),
    FOREIGN KEY (pelaaja) REFERENCES Pelaaja(id),
    FOREIGN KEY (omistaja) REFERENCES Kayttaja(id)
);