<?php

/**
 * Secteur
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    population
 * @subpackage model
 * @author     Flament Guillaume
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Secteur extends BaseSecteur
{
    public function __toString() {
        return $this->getLibelle();
    }

    public function getNomComplet() {
        return $this->getDecoupage() . " - " . $this->getLibelle();
    }

    public function getNbHabitants() {

        // get Doctrine_Connection object
        $con = Doctrine_Manager::getInstance()->connection();
        // execute SQL query, receive Doctrine_Connection_Statement
    
                        $sql = "SELECT count(i.id) as nb
                        FROM secteur s
                        INNER JOIN troncon t ON t.idsecteur = s.id
                        INNER JOIN rue r ON t.idrue = r.id
                        INNER JOIN adresse a ON a.idrue = r.id
                        INNER JOIN logement l ON l.idadresse = a.id
                        INNER JOIN famille f ON f.idlogement = l.id
                        INNER JOIN individu i ON i.idfamille = f.id
                        WHERE (
                        (
                        s.id =".$this->getId()." AND mod( a.numerorue, 2 ) =0
                        AND t.numdebutpair <= a.numerorue
                        AND t.numfinpair >= a.numerorue
                        )
                        OR (
                        s.id =".$this->getId()." AND mod( a.numerorue, 2 ) != 0
                        AND t.numdebutimpair <= a.numerorue
                        AND t.numfinimpair >= a.numerorue
                        )
                        ) group by s.libelle";
        
                           $st = $con->execute($sql);
        
        /*$st = $con->execute("Select count(*) as nombre from individu i where idFamille IN (
                    Select id From famille where idLogement IN (
                        Select id From logement Where idAdresse IN (
                            Select id From adresse Where idRue IN (
                                Select idRue From troncon Where idSecteur =".$this->getId()."
                            )
                        )
                    ))"
                );
         * 
         */
        
        
        
        // fetch query result
        $r = $st->fetch();
        return $r[0];
    }
    
        public function getNbFamilles() {

        // get Doctrine_Connection object
        $con = Doctrine_Manager::getInstance()->connection();
        
        
        /*
        // execute SQL query, receive Doctrine_Connection_Statement
        $st = $con->execute("Select count(*) as nombre From famille where idLogement IN (
                        Select id From logement Where idAdresse IN (
                            Select id From adresse Where idRue IN (
                                Select idRue From troncon Where idSecteur =".$this->getId()."
                            )
                        ))"
                    );
         * */
        
              
                        $sql = "SELECT count(distinct(f.id)) as nb
                        FROM secteur s
                        INNER JOIN troncon t ON t.idsecteur = s.id
                        INNER JOIN rue r ON t.idrue = r.id
                        INNER JOIN adresse a ON a.idrue = r.id
                        INNER JOIN logement l ON l.idadresse = a.id
                        INNER JOIN famille f ON f.idlogement = l.id
                        INNER JOIN individu i ON i.idfamille = f.id
                        WHERE (
                        (
                        s.id =".$this->getId()." AND mod( a.numerorue, 2 ) =0
                        AND t.numdebutpair <= a.numerorue
                        AND t.numfinpair >= a.numerorue
                        )
                        OR (
                        s.id =".$this->getId()." AND mod( a.numerorue, 2 ) != 0
                        AND t.numdebutimpair <= a.numerorue
                        AND t.numfinimpair >= a.numerorue
                        )
                        ) group by s.libelle";
        
                           $st = $con->execute($sql);
        
   
        // fetch query result
        $r = $st->fetch();
        return $r[0];
    }
    
    
        
    
    
    
}
