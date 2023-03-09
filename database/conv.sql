CREATE TABLE etudiant (
    cne VARCHAR(20) NOT NULL PRIMARY KEY,
	nom VARCHAR(20) NOT NULL,
    prenom VARCHAR(20) NOT NULL,
    cin VARCHAR(10) NOT NULL UNIQUE,
    filiere VARCHAR(10) NOT NULL,
    datenaiss DATE NOT NULL,
    datedebut DATE NOT NULL,
    datefin DATE NOT NULL
);

INSERT INTO etudiant(cne, nom, prenom, cin, filiere, datenaiss, datedebut, datefin)
VALUES
    ("G11223344","BEN-ANAYA", "Mouhcine","Y112233","DEVOWFS",STR_TO_DATE('25/01/1999', '%d/%m/%Y'),"2023-03-07",'2023-03-31');

CREATE TABLE admin (
    emailAdm VARCHAR(50) NOT NULL PRIMARY KEY,
    passAdm VARCHAR(50) NOT NULL
)

INSERT INTO admin(emailAdm, passAdm)
VALUES ("bamouhcine91@gmail.com","admin1234")

CREATE TABLE convention (
    idConvention INT PRIMARY KEY,
    convention BLOB
);

CREATE TABLE entreprise (
    idEntr INT(10) NOT NULL PRIMARY KEY,
    nomEntr VARCHAR(50) NOT NULL,
    AdrEntr VARCHAR(10) NOT NULL,
    telEntr VARCHAR(10) NOT NULL,
    encEntr VARCHAR(10) NOT NULL,
)