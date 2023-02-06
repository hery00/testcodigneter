CREATE DATABASE test_vanilla;
USE test_vanilla;

CREATE TABLE membre (  
    id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50),
    nom VARCHAR(100),
    pwd VARCHAR(100)
);



CREATE TABLE publication (
  ID_PUB int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  ID_MEMBRE int NOT NULL,
  CONTENT TEXT,
  FOREIGN KEY(ID_MEMBRE) REFERENCES membre(id)
) ENGINE=InnoDB;

CREATE TABLE commentaire (
  `id_P` int NOT NULL,    --publication asina commentaire
  `id_C` int NOT NULL AUTO_INCREMENT PRIMARY KEY,    --commentaire
  `id_M` int NOT NULL,    --membre nametaka commentaire
  `dateCom` DATETIME NOT NULL,
  `com` TEXT,             --contenu
  FOREIGN KEY(id_M) REFERENCES membre(id),
  FOREIGN KEY(id_P) REFERENCES publication(id_Pub)
) ENGINE=InnoDB;

CREATE OR REPLACE VIEW publi_member as select * from membre join publication p on p.id_Membre = membre.id;
CREATE OR REPLACE VIEW com_member as select * from membre join commentaire c on c.id_M = membre.id;