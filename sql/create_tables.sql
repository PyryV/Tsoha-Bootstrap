-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Kayttaja(
    id INTEGER PRIMARY KEY,
    nimi varchar(20) NOT NULL,
    password varchar(50) NOT NULL
);

CREATE TABLE Pelaaja(
    id SERIAL PRIMARY KEY,
    kayttaja INTEGER,
    nimi varchar(50) NOT NULL,
    pelipaikka varchar(10) NOT NULL,
    seura varchar(50) NOT NULL,
    taso INTEGER, 
    FOREIGN KEY (kayttaja) REFERENCES Kayttaja(id)
);


CREATE TABLE Joukkue(
    id SERIAL PRIMARY KEY,
    kayttaja INTEGER,
    nimi varchar(20),
    FOREIGN KEY (kayttaja) REFERENCES Kayttaja(id)
);

CREATE TABLE Sopimus(
    pelaaja INTEGER,
    joukkue INTEGER,
    FOREIGN KEY (pelaaja) REFERENCES Pelaaja(id),
    FOREIGN KEY (joukkue) REFERENCES Joukkue(id)
);