<?php


// Fonction générant le header de chaque page
function generateHTMLHeader($title) {
    echo <<<CHAINE_DE_FIN
    <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href='https://fonts.googleapis.com/css?family=Rubik' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="assets/ico/favicon.ico">

    <title>$title</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        
    <!-- CSS Perso -->
    <link href="assets/css/perso.css" rel="stylesheet"> 
            
    <script type="text/javascript" src="assets/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="assets/js/perso.js"></script>

    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
            
            
    <!-- Gallery -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
    <script src="utilities/galleria/galleria-1.4.2.js"></script>
    <style>
        .galleria{ width: 700px; height: 400px; background: #000 }
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- [if lt IE 9] -->
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  </head>
        
        
        
        
        
CHAINE_DE_FIN;
}

// FONCTION PERMETTANT DE FAIRE LE BAS DE PAGE
function generateHTMLFooter() {
    echo <<< CHAINE_DE_FIN
    
    <div id="social">
        <div class="container">
            <div class="row centered">

                <div class="col-sm-4">
                    <a href="http://facebook.com/xvdelx/"><i class="fa fa-facebook"></i></a>
                </div>
                <div class="col-sm-4">
                    <a href="https://twitter.com/xvpolytechnique"><i class="fa fa-twitter"></i></a>
                </div>
                <div class="col-sm-4">
                    <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
                </div>



            </div>
        </div>
    </div>
    <div id="footerwrap">
        <div class="container">
            <div class="row centered">
                <div class="col-sm-4">
                    <p><b>École polytechnique</b></p>
                </div>

                <div class="col-sm-4">
                    <p>Route de Saclay</p>
                    <p>91120 Palaiseau</p>
                </div>
                <div class="col-sm-4">
                    <p>erwan.bourceret@polytechnique.edu</p>
                    <p>benjamin.pujol@polytechnique.edu</p>
                </div>
            </div>
        </div>
    </div>



    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-1.11.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".clickable-row").click(function () {
                window.document.location = $(this).data("href");
            });
        });
    </script>

</body>
</html>

CHAINE_DE_FIN;
}

//FONCTION PERMETTANT DE CREER LA LE MENU DE NAVIGATION
function generateMenu($askedpage) {
    echo <<< CHAINE_DE_FIN
    
    <body>

    
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">XVX</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
CHAINE_DE_FIN;

    if ($askedpage != 'equipe' && $askedpage != 'resultat' && $askedpage != 'connexion' && $askedpage != 'inscription') {
        echo <<< FIN
        
                    <li class="active"><a href="index.php">Accueil</a></li>
                    <li><a href="?page=equipe">Équipes</a></li>
                    <li><a href="?page=resultat">Résultats</a></li>
                    <li class="dropdown">
                        

    
FIN;
    } elseif ($askedpage == 'equipe') {
        echo <<< FIN
        
                    <li><a href="index.php">Accueil</a></li>
                    <li class="active"><a href="?page=equipe">Équipes</a></li>
                    <li><a href="?page=resultat">Résultats</a></li>
                    <li class="dropdown">
                        

FIN;
    } elseif ($askedpage == 'resultat') {
        echo <<< FIN
        
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="?page=equipe">Équipes</a></li>
                    <li class="active"><a href="?page=resultat">Résultats</a></li>
                    <li class="dropdown">
                        
    
FIN;
    } elseif ($askedpage == 'connexion' || $askedpage == 'inscription') {
        echo <<< FIN
        
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="?page=equipe">Équipes</a></li>
                    <li><a href="?page=resultat">Résultats</a></li>
                    <li class="active dropdown">
                        

FIN;
    }

    if ($_SESSION['loggedIn']) {
            $prenom = htmlspecialchars($_SESSION["user"]->prenom);
            // Si l'internaute est connecté, on affiche la barre déroulante de navigation pour une personne connectée
            
        echo <<< FIN
            
                            <a class="dropdown-toggle" data-toggle="dropdown" id="navLogin">Bonjour $prenom<span class="caret"></span> </a>
                            <div class="dropdown-menu" style="padding:17px;">
                                    <div class="row">
                                        <div class="col-md-12">
                                                <a href="?page=profil" class="btn btn-primary btn-block" role="button">Ton Profil</a><br>
                                                <a href="?page=combinaison" class="btn btn-primary btn-block" role="button">Combinaisons</a><br>
                           
            
FIN;
        
        if($_SESSION['user']->membre == 'admin'){
            echo <<< FIN
                
            <a href="?page=admin" class="btn btn-primary btn-block" role="button">Administration</a><br>
FIN;
        }
        
        echo <<< FIN
            <a href="?todo=deconnect&amp;page=$askedpage" class="btn btn-primary btn-block" role="button">Deconnexion</a> <br>                                   

                                              
        
                                        </div>
                                    </div>
                            </div>
                    </li>
            </ul>
            </div>
        </div>
    </div>
       
       
FIN;
        
    } else {
        // Si l'internaute n'est pas connecté, on lui propose de se connecter dans le menu déroulant. Si son id ou son mdp n'est pas bon il est redirigé vers connexion
        echo <<< FIN
        
        
    
    <a class="dropdown-toggle" href="#" data-toggle="dropdown" id="navLogin">Connexion<span class="caret"></span></a>
                            <div class="dropdown-menu" style="padding:17px;">
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                        
                                            Connecte Toi! <br> <br>
                                               <form class="form" method="post" action="?todo=login&page=$askedpage" accept-charset="UTF-8" >

    
                                                    <div class="form-group">
                                                             <label>Nom d'utilisateur</label>
                                                             <input type="text" class="form-control" name="nomutilisateur" placeholder="Login" required>
                                                    </div>
                                                    <div class="form-group">
                                                             <label>Mot de Passe</label>
                                                             <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group">
                                                             <button type="submit" class="btn btn-primary btn-block">Connexion</button>
                                                    </div>
                                                </form>
					</div>
                                        <div class="bottom text-center">
								Pas encore inscrit? <a href="?page=inscription"><b>Inscris Toi!</b></a>
					</div>
                                    </div>
                                
                            </div>
                    </li>
        </ul>
            </div>
        </div>
    </div>
    

    
    
FIN;
    }

    if ($askedpage == 'accueil' ) {
        echo <<< FIN
        
        <div id="headerwrap">
        <div class="container">
            <div class="row">
               
                    <h1>XV de l'X</h1>
                    <h4>Subtilité, Sobriété, Sagesse</h4>
            </div>
        </div>
    </div>
        
        
FIN;
    }
}



// Pour savoir si une page est accessible par l'internaute, on utilise une fonction 'checkPage' qui renvoit true si l'internaute est autorisé
// Et false sinon
// elle étudie le cas ou la page est accessible par tout le monde et le cas ou elle est restreinte.

$match_list = array(
    array(
    "date" => "04-02-2016",
    "adversaire" => "HEC",
    "equipe" => "X1",
        ),  
);

$page_list = array(
    array(
        "name" => "accueil",
        "title" => "XV de l'X",
        "menutitle" => "Accueil"),
    array(
        "name" => "resultat",
        "title" => "Voici nos résultats",
        "menutitle" => "Admire et imite"),
    array(
        "name" => "equipe",
        "title" => "Voici notre équipe",
        "menutitle" => "team"),
    array(
        "name" => "connexion",
        "title" => "Connectes Toi!",
        "menutitle" => "Connexion"),
    array(
        "name" => "inscription",
        "title" => "Inscris Toi!",
        "menutitle" => "Inscription"),
   
    
);

$page_restreinte = array(
    array(
        "name" => "combinaison",
        "title" => "Liste des Combinaison",
        "menutitle" => "Private",
        "membre" => NULL,
        "team" => NULL,
        "promotion" => NULL,
        "entraineur1" => NULL,
        "entraineur2" => NULL,
        "entraineur7" => NULL),
    array(
        "name" => "profil",
        "title" => "Ton Profil",
        "menutitle" => "Profil",
        "membre" => NULL,
        "team" => NULL,
        "promotion" => NULL,
        "entraineur1" => NULL,
        "entraineur2" => NULL,
        "entraineur7" => NULL),
    array(
        "name" => "admin",
        "title" => "Administration",
        "menutitle" => "Administration",
        "membre" => "admin",
        "team" => NULL,
        "promotion" => NULL,
        "entraineur1" => NULL,
        "entraineur2" => NULL,
        "entraineur7" => NULL),
    
    
);

function printPages($page_lis) {
    foreach ($page_lis as $page) {
        echo $page["name"];
    }
}

function checkMatch($date, $adversaire, $equipe){
    global $match_list;
    foreach ($match_list as $match) {
        if ($match["adversaire"] == $adversaire && $match["date"] == $date && $match["equipe"] == $equipe) {
            return true;
        }
    }
    return false;
}

function checkPage($askedPage) {
    global $page_list;
    global $page_restreinte;
    foreach ($page_list as $page) {
        if ($page["name"] == $askedPage) {
            return true;
        }
    }
    if (isset($_SESSION['loggedIn'])) {
        if ($_SESSION['loggedIn']) {
            foreach ($page_restreinte as $page) {
                if ($page["name"] == $askedPage && 
                    ( ( ($page["membre"] == NULL OR $page["membre"] == $_SESSION["user"]->membre) &&
                        ($page["team"] == NULL OR $page["team"] == $_SESSION["user"]->team) &&
                        ($page["promotion"] == NULL OR $page["promotion"] == $_SESSION["user"]->promotion) &&
                        ($page["entraineur1"] == NULL OR $page["entraineur1"] == $_SESSION["user"]->entraineur1) &&
                        ($page["entraineur2"] == NULL OR $page["entraineur2"] == $_SESSION["user"]->entraineur2) &&
                        ($page["entraineur7"] == NULL OR $page["entraineur7"] == $_SESSION["user"]->entraineur7)
                      )
                            OR $_SESSION["user"]->membre == 'admin'))
                    
                    
                    
                    {
                    return true;
                }
            }
        }
    }
    return false;
}

function getPageTitle($name) {
    global $page_list;
    global $page_restreinte;
    foreach ($page_list as $page) {
        if ($name == $page['name']) {
            return array($page["title"], $page["menutitle"]);
        }
    }
    foreach ($page_restreinte as $page) {
        if ($name == $page['name']) {
            return array($page["title"], $page["menutitle"]);
        }
    }
}
?>

