
CREATE TABLE Autor
(
	id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	naziv                VARCHAR(40) NULL
) AUTO_INCREMENT = 1;

CREATE TABLE Komentar
(
	id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	text                 VARCHAR(255) NULL,
	vreme                DATETIME NULL,
	stanje               VARCHAR(20) NOT NULL CHECK ( stanje IN ('odobren', 'neodobren') ),
	idPes                INTEGER NULL,
	idKor                INTEGER NULL
) AUTO_INCREMENT = 1;

CREATE TABLE Korisnik
(
	id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	username             VARCHAR(20) NOT NULL,
	password             VARCHAR(20) NULL,
	tip                  VARCHAR(20) NOT NULL CHECK ( tip IN ('admin', 'moderator', 'korisnik') )
) AUTO_INCREMENT = 1;

CREATE TABLE Pesma
(
	id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	naziv                VARCHAR(40) NULL,
	stanje               VARCHAR(20) NOT NULL CHECK ( stanje IN ('neodobren', 'odobren') ),
	putanjaDoAkorda      VARCHAR(255) NULL,
	ytLink               VARCHAR(255) NULL,
	brPregleda           INTEGER NOT NULL DEFAULT 0,
	idZanr               INTEGER NULL,
	idAutor              INTEGER NULL,
	idKor                INTEGER NULL
) AUTO_INCREMENT = 1;

CREATE TABLE Zanr
(
	id                   INTEGER PRIMARY KEY NOT NULL AUTO_INCREMENT,
	tip                  VARCHAR(20) NULL
) AUTO_INCREMENT = 1;

ALTER TABLE Komentar
ADD CONSTRAINT R_1 FOREIGN KEY (idPes) REFERENCES Pesma (id)
		ON DELETE CASCADE
		ON UPDATE CASCADE;

ALTER TABLE Komentar
ADD CONSTRAINT R_2 FOREIGN KEY (idKor) REFERENCES Korisnik (id)
		ON DELETE SET NULL
		ON UPDATE CASCADE;

ALTER TABLE Pesma
ADD CONSTRAINT R_3 FOREIGN KEY (idZanr) REFERENCES Zanr (id)
		ON DELETE RESTRICT
		ON UPDATE CASCADE;

ALTER TABLE Pesma
ADD CONSTRAINT R_4 FOREIGN KEY (idAutor) REFERENCES Autor (id)
		ON DELETE SET NULL
		ON UPDATE CASCADE;

ALTER TABLE Pesma
ADD CONSTRAINT R_5 FOREIGN KEY (idKor) REFERENCES Korisnik (id)
		ON DELETE SET NULL
		ON UPDATE CASCADE;
