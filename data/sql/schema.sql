CREATE TABLE adresse (id BIGINT AUTO_INCREMENT, numerorue BIGINT NOT NULL, complement VARCHAR(10), nblogementsmax BIGINT NOT NULL, infoscomplementaires VARCHAR(75), idrue BIGINT NOT NULL, INDEX idrue_idx (idrue), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE archive (id BIGINT AUTO_INCREMENT, nomnaissance VARCHAR(60) NOT NULL, nomusage VARCHAR(60) NOT NULL, prenoms VARCHAR(100) NOT NULL, titre VARCHAR(4) NOT NULL, sexe VARCHAR(255) NOT NULL, datenaissance DATE, idvillenaissance BIGINT, situationfamiliale VARCHAR(255) NOT NULL, nomrueant VARCHAR(50) NOT NULL, typerueant VARCHAR(50) NOT NULL, numerorueant BIGINT NOT NULL, complementnumant VARCHAR(10), nomruepost VARCHAR(50) NOT NULL, typeruepost VARCHAR(50) NOT NULL, numeroruepost BIGINT, complementnumpost VARCHAR(10), datearchivage DATE NOT NULL, motifdepart VARCHAR(255) NOT NULL, infoscomplementaires VARCHAR(100), INDEX idvillenaissance_idx (idvillenaissance), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE decoupage (id BIGINT AUTO_INCREMENT, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE famille (id BIGINT AUTO_INCREMENT, idlogement BIGINT, infoscomplementaires VARCHAR(75), INDEX idlogement_idx (idlogement), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE individu (id BIGINT AUTO_INCREMENT, nomnaissance VARCHAR(60) NOT NULL, nomusage VARCHAR(60), prenoms VARCHAR(100) NOT NULL, titre VARCHAR(4) NOT NULL, sexe VARCHAR(255) NOT NULL, datenaissance DATE, idvillenaissance BIGINT, anciennevillenaiss VARCHAR(250), situationfamiliale VARCHAR(255) NOT NULL, cheffamille TINYINT(1) NOT NULL, profession VARCHAR(75), email VARCHAR(75), datearrivee DATE, idfamille BIGINT, INDEX idvillenaissance_idx (idvillenaissance), INDEX idfamille_idx (idfamille), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE logement (id BIGINT AUTO_INCREMENT, typebatiment VARCHAR(255) DEFAULT 'Inconnu' NOT NULL, typecomplement VARCHAR(255) DEFAULT NULL, valeurcomplement VARCHAR(30), infoscomplementaires VARCHAR(75), idadresse BIGINT NOT NULL, INDEX idadresse_idx (idadresse), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE rue (id BIGINT AUTO_INCREMENT, coderivoli VARCHAR(8) NOT NULL UNIQUE, nom VARCHAR(150) NOT NULL, motdirecteur VARCHAR(50) NOT NULL, premiernumero BIGINT NOT NULL, derniernumero BIGINT NOT NULL, idtyperue BIGINT NOT NULL, INDEX idtyperue_idx (idtyperue), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE secteur (id BIGINT AUTO_INCREMENT, libelle VARCHAR(50) NOT NULL, iddecoupage BIGINT NOT NULL, INDEX iddecoupage_idx (iddecoupage), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE troncon (id BIGINT AUTO_INCREMENT, idrue BIGINT NOT NULL, idsecteur BIGINT NOT NULL, numdebutpair BIGINT NOT NULL, numdebutimpair BIGINT NOT NULL, numfinpair BIGINT NOT NULL, numfinimpair BIGINT NOT NULL, infoscomplementaires VARCHAR(75), INDEX idrue_idx (idrue), INDEX idsecteur_idx (idsecteur), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE type_rue (id BIGINT AUTO_INCREMENT, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE utilisateur (id BIGINT AUTO_INCREMENT, login VARCHAR(30) NOT NULL, password VARCHAR(50) NOT NULL, nom VARCHAR(50) NOT NULL, prenom VARCHAR(50) NOT NULL, etatcompte VARCHAR(255) DEFAULT 'En attente' NOT NULL, typeutilisateur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE ville (id BIGINT AUTO_INCREMENT, cp VARCHAR(5) CHARACTER SET utf8 NOT NULL, ville VARCHAR(50) CHARACTER SET utf8 NOT NULL, region VARCHAR(40) CHARACTER SET utf8 NOT NULL, departement VARCHAR(60) CHARACTER SET utf8 NOT NULL, pays VARCHAR(40) CHARACTER SET utf8, PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE adresse ADD CONSTRAINT adresse_idrue_rue_id FOREIGN KEY (idrue) REFERENCES rue(id) ON DELETE CASCADE;
ALTER TABLE archive ADD CONSTRAINT archive_idvillenaissance_ville_id FOREIGN KEY (idvillenaissance) REFERENCES ville(id);
ALTER TABLE famille ADD CONSTRAINT famille_idlogement_logement_id FOREIGN KEY (idlogement) REFERENCES logement(id);
ALTER TABLE individu ADD CONSTRAINT individu_idvillenaissance_ville_id FOREIGN KEY (idvillenaissance) REFERENCES ville(id);
ALTER TABLE individu ADD CONSTRAINT individu_idfamille_famille_id FOREIGN KEY (idfamille) REFERENCES famille(id) ON DELETE CASCADE;
ALTER TABLE logement ADD CONSTRAINT logement_idadresse_adresse_id FOREIGN KEY (idadresse) REFERENCES adresse(id) ON DELETE CASCADE;
ALTER TABLE rue ADD CONSTRAINT rue_idtyperue_type_rue_id FOREIGN KEY (idtyperue) REFERENCES type_rue(id) ON DELETE CASCADE;
ALTER TABLE secteur ADD CONSTRAINT secteur_iddecoupage_decoupage_id FOREIGN KEY (iddecoupage) REFERENCES decoupage(id) ON DELETE CASCADE;
ALTER TABLE troncon ADD CONSTRAINT troncon_idsecteur_secteur_id FOREIGN KEY (idsecteur) REFERENCES secteur(id) ON DELETE CASCADE;
ALTER TABLE troncon ADD CONSTRAINT troncon_idrue_rue_id FOREIGN KEY (idrue) REFERENCES rue(id) ON DELETE CASCADE;
