
CREATE TABLE Autor
(
	id                   INTEGER NOT NULL,
	naziv                VARCHAR(40) NULL
);

ALTER TABLE Autor
ADD CONSTRAINT XPKAutor PRIMARY KEY (id);

CREATE TABLE Komentar
(
	id                   INTEGER NOT NULL,
	text                 VARCHAR(255) NULL,
	vreme                DATETIME NULL,
	idPes                INTEGER NULL,
	idKor                INTEGER NULL
);

ALTER TABLE Komentar
ADD CONSTRAINT XPKKomentar PRIMARY KEY (id);

CREATE TABLE Korisnik
(
	id                   INTEGER NOT NULL,
	username             VARCHAR(20) NOT NULL,
	password             VARCHAR(20) NULL,
	tip                  VARCHAR(20) NOT NULL CHECK ( tip IN ('admin', 'moderator', 'korisnik') )
);

ALTER TABLE Korisnik
ADD CONSTRAINT XPKKorisnik PRIMARY KEY (id);

CREATE TABLE Pesma
(
	id                   INTEGER NOT NULL,
	naziv                VARCHAR(40) NULL,
	stanje               VARCHAR(20) NOT NULL CHECK ( stanje IN ('neodobren', 'odobren') ),
	putanjaDoAkorda      VARCHAR(255) NULL,
	ytLink               VARCHAR(255) NULL,
	brPregleda           INTEGER NOT NULL DEFAULT 0,
	idZanr               INTEGER NULL,
	idAutor              INTEGER NULL
);

ALTER TABLE Pesma
ADD CONSTRAINT XPKPesma PRIMARY KEY (id);

CREATE TABLE Zanr
(
	id                   INTEGER NOT NULL,
	tip                  VARCHAR(20) NULL
);

ALTER TABLE Zanr
ADD CONSTRAINT XPKZanr PRIMARY KEY (id);

ALTER TABLE Komentar
ADD CONSTRAINT R_1 FOREIGN KEY (idPes) REFERENCES Pesma (id)
		ON DELETE CASCADE;

ALTER TABLE Komentar
ADD CONSTRAINT R_2 FOREIGN KEY (idKor) REFERENCES Korisnik (id);

ALTER TABLE Pesma
ADD CONSTRAINT R_3 FOREIGN KEY (idZanr) REFERENCES Zanr (id);

ALTER TABLE Pesma
ADD CONSTRAINT R_4 FOREIGN KEY (idAutor) REFERENCES Autor (id);
