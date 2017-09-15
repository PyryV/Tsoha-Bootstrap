-- Lisää INSERT INTO lauseet tähän tiedostoon

--Pelaaja-taulun testidata
INSERT INTO Pelaaja(nimi, pelipaikka, joukkue, taso) 
VALUES ('Sidney Crosby', 'Hyökkääjä', 'Winnipeg Penguins', 95);

INSERT INTO Pelaaja(nimi, peliapaikka, joukkue, taso) 
VALUES ('Jamie Benn', 'Hyökkääjä', 'Dallas Stars', 94);

--Kayttaja-taulun testidata
INSERT INTO Kayttaja(nimi, password) VALUES ('Pekka', 'abc123');
INSERT INTO Kayttaja(nimi, password) VALUES ('Janne', 'salasana');

--Joukkue-taulun testidata
INSERT INTO Joukkue(nimi) VALUES ('Ultimate team');