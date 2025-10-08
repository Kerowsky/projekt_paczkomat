CREATE DATABASE InteligentnaSkrytka;

USE InteligentnaSkrytka;


CREATE TABLE IF NOT EXISTS Paczki(
    id_paczki INT PRIMARY KEY AUTO_INCREMENT,
    id_uzytkownika INT,
    id_skrytki INT,
    status ENUM('NADANA','W_PACZKOMACIE','ODEBRANA'),
);

CREATE TABLE IF NOT EXISTS Paczkomat
(
    id_paczkomatu INT PRIMARY KEY AUTO_INCREMENT,
    id_skrytki    INT,
    rozmiar       ENUM ('S','M','L'),
    status        ENUM ('WOLNA','ZAJĘTA') DEFAULT 'WOLNA',
);

CREATE TABLE IF NOT EXISTS Uzytkownicy(
    id_uzytkownika INT,
    haslo VARCHAR(255),
    rola ENUM('ADMIN','KURIER','KLIENT')
);



