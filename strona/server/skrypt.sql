CREATE DATABASE InteligentnaSkrytka;

USE InteligentnaSkrytka;


CREATE TABLE IF NOT EXISTS Paczki(
    id_paczki INT PRIMARY KEY AUTO_INCREMENT,
    id_uzytkownika INT NOT NULL ,
    id_skrytki INT NOT NULL,
    status ENUM('NADANA','W_PACZKOMACIE','ODEBRANA') NOT NULL,
    FOREIGN KEY (id_uzytkownika) REFERENCES Uzytkownicy(id_uzytkownika),
    FOREIGN KEY (id_skrytki) REFERENCES Paczkomat(id_skrytki)

);

CREATE TABLE IF NOT EXISTS Paczkomat
(
    id_skrytki    INT NOT NULL,
    rozmiar       ENUM ('S','M','L') NOT NULL,
    status        ENUM ('WOLNA','ZAJĘTA') DEFAULT 'WOLNA'
);

CREATE TABLE IF NOT EXISTS Uzytkownicy(
    id_uzytkownika INT  PRIMARY KEY AUTO_INCREMENT NOT NULL ,
    login VARCHAR(255) NOT NULL,
    haslo VARCHAR(255) NOT NULL,
    rola ENUM('ADMIN','KURIER','KLIENT') DEFAULT 'KLIENT'
);



