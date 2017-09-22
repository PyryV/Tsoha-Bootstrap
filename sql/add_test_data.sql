-- Lisää INSERT INTO lauseet tähän tiedostoon

--Kayttaja-taulun testidata
INSERT INTO Kayttaja(id, nimi, password) VALUES (1, 'Pekka', 'abc123');
INSERT INTO Kayttaja(id, nimi, password) VALUES (2, 'Janne', 'salasana');
--Pelaaja-taulun testidata
INSERT INTO Pelaaja(kayttaja, nimi, pelipaikka, seura, taso) 
VALUES (1, 'Sidney Crosby', 'Hyökkääjä', 'Pittsburgh Penguins', 95);

INSERT INTO Pelaaja(kayttaja, nimi, pelipaikka, seura, taso) 
VALUES (1, 'Jamie Benn', 'Hyökkääjä', 'Dallas Stars', 94);


--Joukkue-taulun testidata
INSERT INTO Joukkue(nimi) VALUES ('Ultimate team');

