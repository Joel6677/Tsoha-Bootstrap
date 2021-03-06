CREATE TABLE Player(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE Drink(
  id SERIAL PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id), -- Viiteavain Player-tauluun
  category_id INTEGER,
  name varchar(50) NOT NULL,
  description varchar(400),
  published DATE,
  publisher varchar(50)
  
);-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Category(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL-- Muista erottaa sarakkeiden määrittelyt pilkulla!
);

