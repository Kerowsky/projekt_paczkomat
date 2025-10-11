CREATE DATABASE InteligentnaSkrytka;

USE InteligentnaSkrytka;

CREATE TABLE IF NOT EXISTS Paczkomat (
    id_skrytki INT PRIMARY KEY NOT NULL,
    rozmiar ENUM('S','M','L') NOT NULL,
    status ENUM('WOLNA','ZAJETA') DEFAULT 'WOLNA',
    CHECK (id_skrytki IN (1, 2, 3))
);


CREATE TABLE IF NOT EXISTS Uzytkownicy(
    id_uzytkownika INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
    login VARCHAR(255) NOT NULL,
    haslo VARCHAR(255) NOT NULL,
    imie VARCHAR(255) NOT NULL,
    nazwisko VARCHAR(255) NOT NULL,
    rola ENUM('ADMIN','KURIER','KLIENT') DEFAULT 'KLIENT'
);

CREATE TABLE IF NOT EXISTS Paczki(
    id_paczki INT PRIMARY KEY UNIQUE AUTO_INCREMENT,
    id_uzytkownika INT NOT NULL,
    id_skrytki INT,
    status ENUM('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
    nadawca VARCHAR(255),
    FOREIGN KEY (id_uzytkownika) REFERENCES Uzytkownicy(id_uzytkownika),
    FOREIGN KEY (id_skrytki) REFERENCES Paczkomat(id_skrytki)

);

##              Przykładowi użytkownicy     ##
INSERT INTO Uzytkownicy (login, haslo, imie, nazwisko, rola)
VALUES
    ('admin', '1234', 'Jan', 'Nowak', 'ADMIN'),
    ('kurier_jan', '1234', 'Jan', 'Kowalski', 'KURIER'),
    ('kurier_anna', '1234', 'Anna', 'Wiśniewska', 'KURIER'),
    ('klient_marek', '1234', 'Marek', 'Zieliński', 'KLIENT'),
    ('klient_ewa', '1234', 'Ewa', 'Kamińska', 'KLIENT'),
    ('klient_piotr', '1234', 'Piotr', 'Lewandowski', 'KLIENT');

INSERT INTO Paczkomat (id_skrytki, rozmiar, status)
VALUES
    (1, 'L', 'WOLNA'),
    (2, 'M', 'WOLNA'),
    (3, 'M', 'ZAJETA');

INSERT INTO Paczki (id_uzytkownika, id_skrytki, status, nadawca)
VALUES
    (4,3,'W_PACZKOMACIE', 'CCC'),
    (5, NULL, 'NADANA', 'MODIVO SP. ZOO'),
    (5, NULL, 'NADANA', 'Botland')

