<?php

class Database {

    public static function connect() {
        $dsn = 'mysql:dbname=xvx;host=localhost';
        $user = 'root';
        $password = '';
        $dbh = null;
        try {
            $dbh = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connexion échouée : ' . $e->getMessage();
            exit(0);
        }
        return $dbh;
    }

}

class Utilisateur {

    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $promotion;
    public $naissance;
    public $email;
    public $poste;
    public $team;
    public $entraineur1;
    public $entraineur2;
    public $entraineur3;
    public $poids;
    public $commentaire;
    public $taille;
    public $membre;
    public $essai;

    public function __toString() {
        $date = explode('-', $this->naissance);
        return $this->login . ' ' . $this->prenom . ' ' . $this->nom . ', né le ' . $date[2] . "/" . $date[1] . "/" . $date[0] . ", X" . $this->promotion . ", " . $this->email." ".$this->team." ".$this->entraineur1." ".$this->entraineur2." ".$this->entraineur7." ";
    }

    public static function getUtilisateur($dbh, $login) {
        $query = "SELECT * FROM `utilisateurs` WHERE `login`= ? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Utilisateur');
        $request_succeeded = $sth->execute(array($login));
        if (!$request_succeeded) {
            return null;
        } else {
            $user = $sth->fetch();
            return $user;
        }
    }
    
   

    public static function insererUtilisateur($dbh, $login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $poste, $team, $entraineur1, $entraineur2, $entraineur7) {
        $sth = $dbh->prepare("INSERT INTO `utilisateurs` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `poste`, `team`, `entraineur1`, `entraineur2`, `entraineur7`) VALUES(?,SHA1(?),?,?,?,?,?,?,?,?,?,?)");
        $sth->execute([$login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $poste, $team, $entraineur1, $entraineur2, $entraineur7]);
    }
    
    
    public static function insererCommentaire($dbh, $login, $commentaire) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `commentaire` = ? where `login` = ?");
        $sth->execute([$commentaire, $login]);
        $_SESSION['user']->commentaire = htmlspecialchars($commentaire);
    }
    
    public static function insererPoids($dbh, $login, $poids) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `poids` = ? where `login` = ?");
        $sth->execute([$poids, $login]);
        $_SESSION['user']->poids = htmlspecialchars($poids);
    }
    
    public static function modifPassword($dbh, $login, $mdp) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `mdp` = ? where `login` = ?");
        $sth->execute([sha1($mdp), $login]);
        $_SESSION['user']->mdp = htmlspecialchars(sha1($mdp));
    }
    
    public static function insererTaille($dbh, $login, $taille) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `taille` = ? where `login` = ?");
        $sth->execute(array($taille,$login));
        $_SESSION['user']->taille = htmlspecialchars($taille);
    }
    
    public static function insererEssai($dbh, $login, $essai) {
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET essais = essais + ? where `login` = ?");
        $request_succeeded = $sth->execute(array($essai,$login));
        return $request_succeeded; 
    }

    public static function testerMdp($user, $mdp) {
        $mdp1 = $user->mdp;
        return $mdp1 == sha1($mdp);
    }
    
    public static function supprimerAdmin($dbh, $login){
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `membre` = ? WHERE `login` = ?");
        $sth->execute(array(NULL,$login));
    }
    
    public static function validerAdmin($dbh, $login){
        $sth = $dbh->prepare("UPDATE `utilisateurs` SET `membre` = ? WHERE `login` = ?");
        $sth->execute(array('admin',$login));
    }
    
    public static function supprimerUtilisateur($dbh, $login) {
        $sth = $dbh->prepare("DELETE FROM `utilisateurs` WHERE `login` = ?");
        $sth->execute(array($login));
    }
}

class Demandes {
    
    public $login;
    public $mdp;
    public $nom;
    public $prenom;
    public $promotion;
    public $naissance;
    public $email;
    public $poste;
    public $team;
    public $entraineur1;
    public $entraineur2;
    public $entraineur3;
    
    public function __toString() {
        $date = explode('-', $this->naissance);
        return $this->login . ' ' . $this->prenom . ' ' . $this->nom . ', né le ' . $date[2] . "/" . $date[1] . "/" . $date[0] . ", X" . $this->promotion . ", " . $this->email." ".$this->team." ".$this->entraineur1." ".$this->entraineur2." ".$this->entraineur7." ";
    }
    
    public static function rechercheDemande($dbh) {
        $query = "SELECT * FROM `demandes`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Demandes');
        $sth->execute();
        $user = $sth->fetch();
        if ($user==null) {
            return false;
        } else {
            return true;
        }
    }
    
    public static function getDemande($dbh, $login) {
        $query = "SELECT * FROM `demandes` WHERE `login`= ? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Demandes');
        $request_succeeded = $sth->execute(array($login));
        if (!$request_succeeded) {
            return null;
        } else {
            $user = $sth->fetch();
            return $user;
        }
    }
    
    public static function supprimerDemande($dbh, $login) {
        $sth = $dbh->prepare("DELETE FROM `demandes` where `login` = ?");
        $sth->execute(array($login));
    }
    
    public static function demandeUtilisateur($dbh, $login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $poste, $team, $entraineur1, $entraineur2, $entraineur7) {
        $sth = $dbh->prepare("INSERT INTO `demandes` (`login`, `mdp`, `nom`, `prenom`, `promotion`, `naissance`, `email`, `poste`, `team`, `entraineur1`, `entraineur2`, `entraineur7`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
        $sth->execute([$login, $mdp, $nom, $prenom, $promotion, $naissance, $email, $poste, $team, $entraineur1, $entraineur2, $entraineur7]);
    }
    
}


class Match {
    
    public $titre;
    public $date;
    public $team;
    public $adversaire;
    public $scorex;
    public $score2;
    public $commentaire;
    public $lieu;
    
    public static function nouveauMatch($dbh, $titre, $date, $team, $adversaire, $scorex, $score2, $commentaire, $lieu) {
        $sth = $dbh->prepare("INSERT INTO `match` (`titre`, `date`, `team`, `adversaire`, `scorex`, `score2`, `commentaire`, `lieu`) VALUES(?,?,?,?,?,?,?,?)");
        $sth->execute([$titre, $date, $team, $adversaire, $scorex, $score2, $commentaire, $lieu]);
    }
    
    public static function getMatch($dbh, $titre) {
        $query = "SELECT * FROM `match` WHERE `titre`= ? ";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Match');
        $request_succeeded = $sth->execute(array($titre));
        if (!$request_succeeded) {
            return null;
        } else {
            $match = $sth->fetch();
            return $match;
        }
    }
}

class Essai {
    
    public $titre;
    public $login;
    public $commentaire;




    public static function nouvelessai($dbh, $titre, $login, $commentaire, $team){
        $sth = $dbh->prepare("INSERT INTO `essai` (`titre`, `login`, `commentaire`, `team`) VALUES(?,?,?,?)");
        $sth->execute([$titre, $login, $commentaire, $team]);
    }
    
    public static function getessailogin($dbh, $login) {
        $sth = $dbh->prepare("SELECT COUNT(*) FROM `essai` WHERE `login`= ?");
        $request_succeeded = $sth->execute([$login]);
        if (!$request_succeeded) {
            return null;
        } else {
            $nbessai = $sth->fetch();
            return $nbessai;
        }
    }
    
    public static function getessailoginmatch($dbh, $login, $titre){
        $sth = $dbh->prepare("SELECT COUNT(*) FROM `essai` WHERE `login`= ? AND `titre`= ?");
        $request_succeeded = $sth->execute([$login, $titre]);
        if (!$request_succeeded) {
            return null;
        } else {
            $nbessaim = $sth->fetch();
            return $nbessaim;
        }
    }
    
    public static function getessailoginequipe($dbh, $login, $team){
        $sth = $dbh->prepare("SELECT COUNT(*) FROM `essai` WHERE `login`= ? AND `team`= ?");
        $request_succeeded = $sth->execute([$login, $team]);
        if (!$request_succeeded) {
            return null;
        } else {
            $nbessaim = $sth->fetch();
            return $nbessaim;
        }
    }
    
    public static function getessaimatch($dbh, $titre){
        $sth = $dbh->prepare("SELECT * FROM `essai` WHERE `titre` = ?");
        $request_succeeded = $sth->execute([$titre]);
        if (!$request_succeeded) {
            return null;
        } else {
            $nbessaim = $sth->fetch();
            return $nbessaim;
        }
    }
    
    public static function rechercheessai($dbh, $titre) {
        $query = "SELECT * FROM `essai` WHERE `titre`= ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'Demandes');
        $sth->execute([$titre]);
        $essai = $sth->fetch();
        if ($essai==null) {
            return false;
        } else {
            return true;
        }
    }
    
    
}



