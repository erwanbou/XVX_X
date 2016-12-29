<?php

function logIn($dbh) {
    //print_r($_POST);

    if (isset($_POST['nomutilisateur'])) {
        $user = Utilisateur::getUtilisateur($dbh, htmlspecialchars($_POST["nomutilisateur"]));
        if ($user == null) {
            return false;
        }
        if (Utilisateur::testerMdp($user, htmlspecialchars($_POST["password"])) != true) {
            return false;
        }
        $_SESSION['loggedIn'] = true;
        $_SESSION["user"] = $user;
        
        return true;
    } else {
        return false;
    }
}

function logOut() {
    unset($_SESSION['loggedIn']);
    session_unset();
    session_destroy();
    $_SESSION['loggedIn'] = false;
    
}



?>
