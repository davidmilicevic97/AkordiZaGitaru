
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
=======
CREATE TABLE [Autor]
( 
	[id]                 numeric  NOT NULL ,
	[naziv]              char(40)  NULL 
)
go

ALTER TABLE [Autor]
	ADD CONSTRAINT [XPKAutor] PRIMARY KEY  CLUSTERED ([id] ASC)
go

CREATE TABLE [Komentar]
( 
	[id]                 numeric  NOT NULL ,
	[text]               char(256)  NULL ,
	[vreme]              datetime  NULL ,
	[idPes]              numeric  NOT NULL ,
	[idKor]              numeric  NOT NULL
)
go

ALTER TABLE [Komentar]
	ADD CONSTRAINT [XPKKomentar] PRIMARY KEY  CLUSTERED ([id] ASC)
go

CREATE TABLE [Korisnik]
( 
	[id]                 numeric  NOT NULL  IDENTITY ,
	[username]           char(20)  NULL ,
	[passwod]            char(20)  NULL ,
	[tip]                char(20)  NULL 
	CONSTRAINT [Validation_Rule_175_794425311]
		CHECK  ( [tip]='ADMIN' OR [tip]='MODERATOR' OR [tip]='KORISNIK' )
)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XPKKorisnik] PRIMARY KEY  CLUSTERED ([id] ASC)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XAK1Korisnik] UNIQUE ([username]  ASC)
go

CREATE TABLE [Pesma]
( 
	[id]                 numeric  NOT NULL ,
	[naziv]              char(40)  NULL ,
	[stanje]             char(20)  NOT NULL ,
	[putanjaDoAkorda]    char(256)  NULL ,
	[idZanr]             numeric  NOT NULL ,
	[idAutor]            numeric  NOT NULL
	CONSTRAINT [Validation_Rule_255_777981155]
		CHECK  ( [stanje]='odobrena' OR [stanje]='neodobrena' )
)
go

ALTER TABLE [Pesma]
	ADD CONSTRAINT [XPKPesma] PRIMARY KEY  CLUSTERED ([id] ASC)
go

CREATE TABLE [Zanr]
( 
	[id]                 numeric  NOT NULL ,
	[tip]                char(20)  NULL 
)
go

ALTER TABLE [Zanr]
	ADD CONSTRAINT [XPKZanr] PRIMARY KEY  CLUSTERED ([id] ASC)
go


ALTER TABLE [Komentar]
	ADD CONSTRAINT [R_4] FOREIGN KEY ([idKor]) REFERENCES [Korisnik]([id])
		ON DELETE SET NULL
		ON UPDATE CASCADE
go

ALTER TABLE [Komentar]
	ADD CONSTRAINT [R_5] FOREIGN KEY ([idPes]) REFERENCES [Pesma]([id])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Pesma]
	ADD CONSTRAINT [R_6] FOREIGN KEY ([idZanr]) REFERENCES [Zanr]([id])
		ON UPDATE CASCADE
go

ALTER TABLE [Pesma]
	ADD CONSTRAINT [R_7] FOREIGN KEY ([idAutor]) REFERENCES [Autor]([id])
		ON UPDATE CASCADE
go
