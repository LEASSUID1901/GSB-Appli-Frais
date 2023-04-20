-- creation de la table type pour les utilisateurs
CREATE TABLE `gsb_frais`.`type` 
(`id` INT NOT NULL AUTO_INCREMENT ,
 `nom` VARCHAR(20) NOT NULL ,
  PRIMARY KEY (`id`))
   ENGINE = InnoDB;

-- insertion dans la table des visiteurs et comptable
INSERT INTO `type` (`id`, `nom`) VALUES (NULL, 'visiteur');
INSERT INTO `type` (`id`, `nom`) VALUES (NULL, 'comptable');

-- ajout dans la table du champ type qui sera en référence 
-- de la table type
ALTER TABLE `visiteur` ADD `type` INT NOT NULL AFTER `dateembauche`;



-- modifier le champ type à 1
UPDATE visiteur SET type = 1 ;

-- mettre la clé étrangère -- a faire apres la modification de la table
ALTER TABLE `visiteur` 
ADD CONSTRAINT `cle_etrangere_type`
 FOREIGN KEY (`type`) 
 REFERENCES `type`(`id`)
  ON DELETE RESTRICT ON UPDATE RESTRICT;

-- inserer de nouveaux comptables
INSERT INTO
 `visiteur` (`id`, `nom`, `prenom`, `login`, `mdp`, `adresse`, `cp`, `ville`, `dateembauche`, `type`)
  VALUES ('c423', 'Axel', 'Dupont', 'adupont', '123456', '45', '94000', 'Creteil', '2022-12-15', '2')


  -- requete MAJ 
  SELECT 
visiteur.id AS id, 
visiteur.nom AS nom,
visiteur.prenom ,
type.id , type.nom
FROM visiteur inner join type on visiteur.type=type.id;

-- script sql a lancer en debut de mois
UPDATE fichefrais
SET idetat	= "CL" 
where idetat='CR'
