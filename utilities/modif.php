<?php

function modif($dbh) {
    
    if (isset($_POST['poids']) && htmlspecialchars($_POST['poids']) != "") {
        Utilisateur::insererPoids($dbh, $_SESSION['user']->login, $_POST['poids']);
    }
    
     if (isset($_POST['taille']) && htmlspecialchars($_POST['taille']) != "") {
        Utilisateur::insererTaille($dbh, $_SESSION['user']->login, $_POST['taille']);
    }
    
     if (isset($_POST['commentaire']) && htmlspecialchars($_POST['commentaire']) != "") {
        Utilisateur::insererCommentaire($dbh, $_SESSION['user']->login, $_POST['commentaire']);
    }
    $modifok = false;
     if (isset($_POST['vieuxpassword']) && htmlspecialchars($_POST['vieuxpassword']) != "") {
        if (Utilisateur::testerMdp($_SESSION['user'], $_POST["vieuxpassword"])){
            $modifok = true;
            Utilisateur::modifPassword($dbh, $_SESSION['user']->login, $_POST["password2"]);
            
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

