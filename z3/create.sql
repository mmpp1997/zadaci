CREATE TABLE tablica_artikala (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artikal VARCHAR(255) NOT NULL,
    stanje_na_skladistu DECIMAL(10, 2) NOT NULL,
    cijena DECIMAL(10, 2),
    mjerna_jedinica VARCHAR(255),
    potrebno_nabaviti INT,
    cijena_u_nabavi DECIMAL(10, 2),
    krajnji_rok_nabave DATE
);