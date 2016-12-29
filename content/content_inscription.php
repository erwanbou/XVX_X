<?php
// On regarde si le formulaire est valide
// Puis on enregistre les variables ajoutées par la méthode POST par les formulaires


$form_values_valid = false;

if (isset($_POST["nomutilisateur"]) && htmlspecialchars($_POST["nomutilisateur"]) != "" &&
        isset($_POST["email"]) && htmlspecialchars($_POST["email"]) != "" &&
        isset($_POST["prenom"]) && htmlspecialchars($_POST["prenom"]) != "" &&
        isset($_POST["nom"]) && htmlspecialchars($_POST["nom"]) != "" &&
        isset($_POST["password"]) && htmlspecialchars($_POST["password"]) != "" &&
        isset($_POST["naissance"]) && htmlspecialchars($_POST["naissance"]) != "" &&
        isset($_POST["promotion"]) && htmlspecialchars($_POST["promotion"]) != "" &&
        isset($_POST["team"]) && htmlspecialchars($_POST["team"]) != ""
) {
    $form_values_valid = true;
}


if (isset($_POST["nomutilisateur"])) {
    $nomutilisateur = htmlspecialchars($_POST["nomutilisateur"]);
} else {
    $nomutilisateur = "";
}
if (isset($_POST["email"])) {
    $email = htmlspecialchars($_POST["email"]);
} else {
    $email = "";
}
if (isset($_POST["prenom"])) {
    $prenom = htmlspecialchars($_POST["prenom"]);
} else {
    $prenom = "";
}
if (isset($_POST["nom"])) {
    $nom = htmlspecialchars($_POST["nom"]);
} else {
    $nom = "";
}
if (isset($_POST["naissance"])) {
    $naissance = htmlspecialchars($_POST["naissance"]);
} else {
    $naissance = "";
}
if (isset($_POST["promotion"])) {
    $promotion = htmlspecialchars($_POST["promotion"]);
} else {
    $promotion = "";
}
if (isset($_POST["team"])) {
    $team = htmlspecialchars($_POST["team"]);
} else {
    $team = "";
}
if (isset($_POST["entraineur1"])) {
    $entraineur1 = htmlspecialchars($_POST["entraineur1"]);
} else {
    $entraineur1 = "";
}
if (isset($_POST["entraineur2"])) {
    $entraineur2 = htmlspecialchars($_POST["entraineur2"]);
} else {
    $entraineur2 = "";
}
if (isset($_POST["entraineur7"])) {
    $entraineur7 = htmlspecialchars($_POST["entraineur7"]);
} else {
    $entraineur7 = "";
}


if (!$form_values_valid && !$_SESSION['loggedIn']) {
    // Si l'utilisateur n'est pas connecté, il peut s'inscrire, on affiche le formulaire avec la méthode POST
    ?>

    <p style="margin-top:100px">
    </p>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-0" style="#00ff00">
                <div class="container mb">
                    <div class="login">
                        <h1>Inscris toi!</h1>
                    </div>
                </div>
            </div>
        </div> <!--/row -->
    </div> <!-- /container -->




    <div class="container">
        <div class="container-fluid">
            <section class="container">
                <form action="?page=inscription" method=post
                      accept-charset="" oninput="password2.setCustomValidity(password2.value != password.value ? 'Les mots de passe diffèrent.' : '')">				
                    <div class="container-page">


                        <div class="col-md-6">

                            <div class="form-group col-md-12">
                                <label>Nom d'utilisateur (Kroman, GNK, Burger, El Brackmad)</label>
                                <?php
                                echo <<< FIN

                                <input type="text" name="nomutilisateur" class="form-control" id="nomutilisateur" placeholder="le croqueur" value="$nomutilisateur">

                
                            </div>
                            <div class="form-group col-md-6">
                                <label>Prénom</label>
                                <input type="text" name="prenom" class="form-control" id="prenom" placeholder="Erwan" value="$prenom">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nom</label>
                            <input type="text" name="nom" class="form-control" id="nom" placeholder="Bourceret" value="$nom">
FIN;
                                ?>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mot de passe</label>
                                <input type="password" name="password" class="form-control" placeholder="Mot de passe" id="password" value="">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Mot de passe (confirmation)</label>
                                <input type="password" name="password2" class="form-control" placeholder="Mot de passe" id="password2" value="">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Adresse email</label>

                                <?php
                                echo <<< FIN
                            <input type="email" name="email" class="form-control" placeholder="Email" id="email" value="$email">
                            </div>

                            <div class="form-group col-md-6">
                                <label>Date de naissance</label>

                            <input type="date" name="naissance" class="form-control" value="$naissance">
FIN;
                                ?>
                            </div>




                            <div class="form-group col-md-6">
                                <label>Promotion</label>
                                <p>
                                    <select name="promotion">
                                        <option value="NULL">Non polytechnicien      </option>
                                        <option value="2015">X2015        </option>
                                        <option value="2014">X2014        </option>
                                        <option value="2013">X2013        </option>
                                        <option value="2012">X2012        </option>
                                        <option value="2011">X2011        </option>

                                    </select>
                                </p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Quelle est ta Team?</label>
                                <p>
                                    <select name="team">
                                        <option value="supporter">Supporter</option>
                                        <option value="entraineur">Entraîneur</option>
                                        <option value="X1">X1        </option>
                                        <option value="X2">X2        </option>
                                        <option value="7X7">7X7        </option>
                                    </select>
                                </p>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Es-tu un entraineur? </label>
                                <p>

                                    <input type="checkbox" name = "entraineur1" value="OUI"> X1
                                    <input type="checkbox" name = "entraineur2" value="OUI"> X2
                                    <input type="checkbox" name = "entraineur7" value="OUI"> 7X7

                                </p>
                            </div>









                            <div class="form-group col-md-6">
                                <label id="baba">Poste de prédiléction</label>

                                <script src="http://code.jquery.com/jquery.js"></script>

                                <script>
                                    var credits = 15,
                                            range = '\
                                <input type="range"  min="1" max="' + credits + '" value="' + credits + '" name="poste" id="discount_credits" />\
                                <span><center>' + credits + '</center></span>\
                                ';

                                    $("#baba").append(range);

                                    $('#discount_credits').on("change mousemove", function () {
                                        $(this).next().html('<center>' + $(this).val() + '</center>');
                                    });
                                </script>

                            </div>






                        </div>

                        <div class="col-md-6">
                            <h3 class="dark-grey">Pour la Patrie, les Sciences et la Gloire</h3>
                            <p>
                                Si c'est la première fois que tu arrives sur ce site, que tu sois joueur, supporter, matteur ou un geek, sache que tu es le bienvenue!
                            </p>
                            <p>
                                Tu trouveras sur ce site toutes les actualités, les photos, les résumés des matchs et l'âme du rugby polytechnicien.
                            </p>

                            <p>
                                Tu peux d'ailleurs contribuer à la rédaction de ces actualités!
                            </p>

                            <p>
                                Profite en bien :)

                            </p>
                            <p>
                                Petit oiseau et grosse pintade
                            </p>



                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>

                    </div>  
                </form>
            </section>
        </div>

    </div>

    <p style="margin-top:100px">
    </p>

    <?php
}

//Si la personne est connecté
elseif ($_SESSION['loggedIn']) {
    ?>


    <p style='margin-top:100px'> </p>
    <div class="row centered mt mb">
        <h2>Mais vous êtes déjà connecté!</h2>
    </div>
    <p style='margin-top:300px'> </p>;

    <?php
} elseif ($form_values_valid) {

    if (Utilisateur::getUtilisateur($dbh, $nomutilisateur) != NULL) {
        ?>

        <p style='margin-top:100px'> </p>
        <div class="row centered mt mb">
            <h2>Désolé ce Nom d'utilisateur est déjà pris...</h2>
        </div>
        <p style='margin-top:100px'> </p>;
        <div class="row centered mt mb">
            <a href="index.php?page=inscription" class="btn btn-primary">Inscription</a>   
        </div>
        <p style='margin-top:200px'> </p>;

        <?php
    } else {
        if ($entraineur1 != "OUI") {
            $entraineur1 = "NON";
        }
        if ($entraineur2 != "OUI") {
            $entraineur2 = "NON";
        }
        if ($entraineur7 != "OUI") {
            $entraineur7 = "NON";
        }

        Demandes::demandeUtilisateur($dbh, $nomutilisateur, $_POST["password"], $nom, $prenom, $promotion, $naissance, $email, $_POST['poste'], $team, $entraineur1, $entraineur2, $entraineur7);
        ?>




        <p style='margin-top:100px'> </p>
        <div class="row centered mt mb">
            <h2>L'administrateur du site doit à présent valider votre compte</h2>
        </div>
        <p style='margin-top:300px'> </p>;

        <?php
        logIn($dbh);
    }
}
?>

