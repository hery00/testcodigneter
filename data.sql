
create table user(
    IDUSER INT UNIQUE NOT NULL AUTO_INCREMENT PRIMARY KEY,
    NOM VARCHAR(20),
    PSEUDO VARCHAR(20),
    PASS VARCHAR(20)
);

insert into user values(null,'Rakoto','Rakoto@gmail.com','rakoto123');
insert into user values(null,'Randria','Randria@gmail.com','randria123');
insert into user values(null,'Rabeza','Rabeza@gmail.com','rabeza123');

CREATE TABLE publication (
  ID_PUB int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  IDUSERPUB int NOT NULL,
  CONTENT TEXT,
  FOREIGN KEY(IDUSERPUB) REFERENCES user(IDUSER)
);
