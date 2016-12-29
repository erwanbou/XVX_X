<?php
require('utilities/sql.php');
session_start();
require('utilities/utils.php');
require('utilities/logInOut.php');
require('utilities/modif.php');

if (!isset($_SESSION['initiated'])) {
    session_regenerate_id();
    $_SESSION['initiated'] = true;
    $_SESSION['loggedIn'] = false;
}

// On lance la connexion avec la base de données.
$dbh = Database::connect();



if (isset($_GET['todo'])) {
    if (htmlspecialchars($_GET['todo']) == 'login') {
        $log = logIn($dbh);
    }
    if (htmlspecialchars($_GET['todo']) == 'deconnect') {
        logOut();
    }
    if (htmlspecialchars($_GET['todo']) == 'modif') {
        modif($dbh);
    }
}



//Vérification du paramètre page et accès à la page.
if (isset($_GET['page'])) {
    $askedpage = htmlspecialchars($_GET['page']);
    $authorized = checkPage($askedpage);
    if (!$authorized && isset($_GET['todo']) && htlmspecialchars($_GET['todo']) = 'deconnect') {
        $askedpage = 'accueil';
    }
    if ($authorized) {
        $pagetitle = getPageTitle(htlmspecialchars($_GET['page']))[0];
        $pagemenutitle = getPageTitle(htlmspecialchars($_GET['page']))[1];
    } else {
        $pagetitle = 'ERREUR';
        $pagemenutitle = 'ERREUR';
    }
} else {
    $authorized = true;
    $pagetitle = "XV de l'X";
    $askedpage = 'accueil';
}

if(isset($log) && !$log) {$askedpage = 'connexion';}





generateHTMLHeader($pagetitle);
generateMenu($askedpage);
?>

<div id ='content'>
    <?php
    
        if (!$authorized) {
            if (isset($_GET['todo']) && $_GET['todo'] = 'deconnect') {
                require 'content/content_accueil.php';
            } else {
                echo <<< FIN
    
    
    <p style='margin-top:100px'> </p>
    <div class="row centered mt mb">
    <h2>Désolé, la page demandée n'existe pas ou n'est accessible qu'aux gentlemen.</h2>
    </div>
    <p style='margin-top:300px'> </p>;

FIN;
            }
        } else {
            require 'content/content_' . $askedpage . '.php';
        }
    
    ?>

</div>


<?php
generateHTMLFooter();
?>
