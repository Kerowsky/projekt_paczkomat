CREATE DATABASE InteligentnaSkrytka;

USE InteligentnaSkrytka;

CREATE TABLE IF NOT EXISTS Paczkomat
(
    id_skrytki INT PRIMARY KEY    NOT NULL,
    rozmiar    ENUM ('S','M','L') NOT NULL,
    status     ENUM ('WOLNA','ZAJETA') DEFAULT 'WOLNA',
    CHECK (id_skrytki IN (1, 2, 3))
);


CREATE TABLE IF NOT EXISTS Uzytkownicy
(
    id_uzytkownika INT PRIMARY KEY UNIQUE AUTO_INCREMENT NOT NULL,
    login          VARCHAR(255)                          NOT NULL UNIQUE,
    haslo          VARCHAR(255)                          NOT NULL,
    imie           VARCHAR(255)                          NOT NULL,
    nazwisko       VARCHAR(255)                          NOT NULL,
    rola           ENUM ('ADMIN','KURIER','KLIENT') DEFAULT 'KLIENT'
);

CREATE TABLE IF NOT EXISTS Paczki
(
    id_paczki      INT PRIMARY KEY UNIQUE AUTO_INCREMENT,
    id_uzytkownika INT                                        NOT NULL,
    id_skrytki     INT,
    status         ENUM ('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
    nadawca        VARCHAR(255),
    data_nadania   DATETIME NOT NULL ,
    data_odebrania DATETIME,
    FOREIGN KEY (id_uzytkownika) REFERENCES Uzytkownicy (id_uzytkownika),
    FOREIGN KEY (id_skrytki) REFERENCES Paczkomat (id_skrytki)

);

CREATE TABLE IF NOT EXISTS Archiwum
(
    id_paczki      INT PRIMARY KEY UNIQUE AUTO_INCREMENT,
    id_uzytkownika INT                                        NOT NULL,
    id_skrytki     INT,
    status         ENUM ('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
    nadawca        VARCHAR(255),
    data_nadania   DATETIME NOT NULL ,
    data_odebrania DATETIME,

    FOREIGN KEY (id_uzytkownika) REFERENCES Uzytkownicy (id_uzytkownika),
    FOREIGN KEY (id_skrytki) REFERENCES Paczkomat (id_skrytki)

);

##              Przykładowi użytkownicy     ##
INSERT INTO Uzytkownicy (login, haslo, imie, nazwisko, rola)
VALUES ('admin', '1234', 'Jan', 'Nowak', 'ADMIN'),
       ('kurier_jan', '1234', 'Jan', 'Kowalski', 'KURIER'),
       ('kurier_anna', '1234', 'Anna', 'Wiśniewska', 'KURIER'),
       ('klient_marek', '1234', 'Marek', 'Zieliński', 'KLIENT'),
       ('klient_ewa', '1234', 'Ewa', 'Kamińska', 'KLIENT'),
       ('klient_piotr', '1234', 'Piotr', 'Lewandowski', 'KLIENT'),
       ('marekz', '1234', 'Marek', 'Zieliński', 'KLIENT'),
       ('ewak', '1234', 'Ewa', 'Kamińska', 'KLIENT'),
       ('piotrlew', '1234', 'Piotr', 'Lewandowski', 'KLIENT'),
       ('olakac', '1234', 'Ola', 'Kaczmarek', 'KLIENT'),
       ('tomaszd92', '1234', 'Tomasz', 'Dąbrowski', 'KLIENT'),
       ('kasiamz', '1234', 'Katarzyna', 'Mazur', 'KLIENT'),
       ('bartekw_', '1234', 'Bartosz', 'Wójcik', 'KLIENT'),
       ('ania.kow', '1234', 'Anna', 'Kowalczyk', 'KLIENT'),
       ('michalw', '1234', 'Michał', 'Woźniak', 'KLIENT'),
       ('magdazaj', '1234', 'Magdalena', 'Zając', 'KLIENT'),
       ('pawelk_', '1234', 'Paweł', 'Krawczyk', 'KLIENT'),
       ('agnieszas', '1234', 'Agnieszka', 'Szymańska', 'KLIENT'),
       ('karolkr', '1234', 'Karol', 'Król', 'KLIENT'),
       ('dominikw', '1234', 'Dominik', 'Witkowski', 'KLIENT'),
       ('martyna.p', '1234', 'Martyna', 'Pawlak', 'KLIENT'),
       ('lukasz83', '1234', 'Łukasz', 'Nowicki', 'KLIENT'),
       ('sylwiaa', '1234', 'Sylwia', 'Lis', 'KLIENT'),
       ('filipm', '1234', 'Filip', 'Michalski', 'KLIENT');

INSERT INTO Paczkomat (id_skrytki, rozmiar, status)
VALUES (1, 'L', 'WOLNA'),
       (2, 'M', 'WOLNA'),
       (3, 'M', 'ZAJETA');

INSERT INTO Paczki (id_uzytkownika, id_skrytki, status, nadawca, data_nadania, data_odebrania)
VALUES (4, 3, 'W_PACZKOMACIE', 'CCC', NOW(), NULL),
       (5, NULL, 'NADANA', 'MODIVO SP. ZOO', NOW(), NULL),
       (5, NULL, 'NADANA', 'Botland', NOW(), NULL),
       (6, NULL, 'NADANA', 'Empik', '2025-10-10 16:50:00', NULL),
       (7, NULL, 'NADANA', 'Media Expert', '2025-10-15 10:30:00', NULL),
       (8, NULL, 'NADANA', 'Zalando', '2025-10-07 13:45:00', NULL),
       (9, NULL, 'NADANA', 'Allegro Smart!', '2025-10-14 12:10:00', NULL),
       (10, NULL, 'NADANA', 'x-kom', '2025-10-15 08:05:00', NULL),
       (11, NULL, 'NADANA', 'Reserved', '2025-10-13 19:32:00', NULL),
       (12, NULL, 'NADANA', '4F', '2025-10-01 10:05:00', NULL),
       (13, NULL, 'NADANA', 'Decathlon', '2025-10-15 11:12:00', NULL),
       (14, NULL, 'NADANA', 'H&M', '2025-10-12 15:55:00', NULL),
       (15, NULL, 'NADANA', 'Empik', '2025-09-28 09:10:00', NULL),
       (16, NULL, 'NADANA', 'Morele.net', '2025-10-14 18:42:00', NULL),
       (17, NULL, 'NADANA', 'Smyk', '2025-10-13 13:05:00', NULL),
       (18, NULL, 'NADANA', 'RTV Euro AGD', '2025-10-15 07:48:00', NULL),
       (19, NULL, 'NADANA', 'Answear.com', '2025-10-14 17:30:00', NULL),
       (20, NULL, 'NADANA', 'Ceneo', '2025-10-15 12:25:00', NULL),
       (9, NULL, 'NADANA', 'Poczta Polska', '2025-10-10 10:00:00', NULL),
       (7, NULL, 'NADANA', 'Komputronik', '2025-10-15 14:45:00', NULL);


##          ZAPYTANIA DO PANELÓW      ##
UPDATE uzytkownicy
SET uzytkownicy.rola = 'KLIENT'
WHERE uzytkownicy.id_uzytkownika = 2;

## WSTAWIANIE PACZKI (Opcje kuriera)

SELECT paczkomat.id_skrytki, paczkomat.status
FROM paczkomat;

UPDATE paczkomat
SET paczkomat.status = 'WOLNA'
WHERE paczkomat.id_skrytki = 1;

UPDATE paczki
SET paczki.status = 'NADANA'
WHERE id_paczki = 2;

UPDATE paczki
SET paczki.status = 'W_PACZKOMACIE'
WHERE id_paczki = 2;


SELECT id_paczki, uzytkownicy.id_uzytkownika AS 'id_uzytkownika',
concat(uzytkownicy.imie,' ', uzytkownicy.nazwisko) AS 'imie_nazwisko',
id_skrytki, status, nadawca, data_nadania, data_odebrania
FROM paczki JOIN uzytkownicy
                 ON paczki.id_uzytkownika = uzytkownicy.id_uzytkownika
order by id_uzytkownika asc;