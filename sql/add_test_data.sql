INSERT INTO Player (name, password) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Player (name, password) VALUES ('Henri', 'Henri123');
-- Game taulun testidata
INSERT INTO Drink (name, description, published, publisher, added) VALUES ('Vodka', 'Hyvää', '2011-11-11', 'Finlandia', NOW());-- Lisää INSERT INTO lauseet tähän tiedostoon
