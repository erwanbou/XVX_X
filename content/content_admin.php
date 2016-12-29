<?php
// Cette page est visible uniquement par les administateurs du site. Elle permet d'ajouter des utilisateurs qui en ont fait la demande.
// Elle permet également de supprimer des utilisateur abusifs du site ou de promouvoir administrateur un autre utilisateur.
// On teste tout d'abord s'il y a des demandes ou des membres à ajouter ou à supprimer
if (isset($_POST['logindemande'])) {
    $login = $_POST['logindemande'];
    $user = Demandes::getDemande($dbh, $login);
    if ($user == null) {
        echo "";
    } else {
        Utilisateur::insererUtilisateur($dbh, $login, $user->mdp, $user->nom, $user->prenom, $user->promotion, $user->naissance, $user->email, $user->poste, $user->team, $user->entraineur1, $user->entraineur2, $user->entraineur7);
        Demandes::supprimerDemande($dbh, $login);
        $done = 'Nouveau membre!';
    }
}

if (isset($_POST['loginsuppression'])) {
    $login = $_POST['loginsuppression'];
    Demandes::supprimerDemande($dbh, $login);
    $done = 'Demande supprimée';
}


if (isset($_POST['loginmembersuppression'])) {
    $login = $_POST['loginmembersuppression'];
    Utilisateur::supprimerUtilisateur($dbh, $login);
    $done = 'Membre supprimé';
}

if (isset($_POST['supprimeradmin'])) {
    $login = $_POST['supprimeradmin'];
    Utilisateur::supprimerAdmin($dbh, $login);
    $done = 'Admin Supprimé';
}

if (isset($_POST['rendreadmin'])) {
    $login = $_POST['rendreadmin'];
    Utilisateur::validerAdmin($dbh, $login);
    $done = 'Nouvel Admin';
}

// On affiche ce que l'on vient de faire (suppression, ajout, promotion)
if (isset($done)) {
    echo '<div class="container">
    <div class="row" align="left">
        <B style="color:red;">' . $done . '</B>
    </div>
</div>';
}
?>



<!-- On affiche les demandes de membre si il y en a -->

<div class="container">
    <div class="row mt centered sb">
        <h1>Gère les demandes de membre</h1>
    </div>
</div>

<?php
if (!Demandes::rechercheDemande($dbh)) {
    // Il n'y a pas de demandes
    ?>


    <div class="container">
        <div class="row centered mt mb">
            <h4>Tu n'as pas de demande de membre</h4>
        </div>
    </div>


    <?php
} else {
    // On affiche les demandes dans un tableau via une requète SQL
    ?>

    <div class="container">
        <div class="row mt">
            <div class="container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Login</th>
                            <th>Mot de Passe</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Promotion</th>
                            <th>Naissance</th>
                            <th>Email</th>
                            <th>Poste</th>
                            <th>Team</th>
                            <th>Entraineur</th>
                            <th>Validation</th>
                            <th>Suppression</th>    
                        </tr>
                    </thead>
                    <tbody>

    <?php
    $reponse = $dbh->query('SELECT `login`, `mdp`, `nom`,`prenom`, `poste`, `promotion`, `naissance`, `email`, `poste`, `team`, `entraineur1`, `entraineur2`, `entraineur7` FROM demandes ORDER BY `login`');

    while ($donnees = $reponse->fetch()) {
        echo "<tr>"
        . "<td>" . htmlspecialchars($donnees['login']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['mdp']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['prenom']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['nom']) . "</td>"
        . "<td>X" . htmlspecialchars($donnees['promotion']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['naissance']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['email']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['poste']) . "</td>"
        . "<td>" . htmlspecialchars($donnees['team']) . "</td>"
        . "<td>";
        if (htmlspecialchars($donnees['entraineur1']) == 'OUI') {
            echo ' X1 ';
        }
        if (htmlspecialchars($donnees['entraineur2']) == 'OUI') {
            echo ' X2 ';
        }
        if (htmlspecialchars($donnees['entraineur7']) == 'OUI') {
            echo ' 7X7 ';
        }
        echo <<< FIN
                        </td>
                        <td> 
                            <form class="form" method="post" action="?page=admin" accept-charset="UTF-8">
                                <div class="form-group">
                                    <button type="submit" name="logindemande" value="
FIN;
        echo htmlspecialchars($donnees['login']) . '"';
        // Rechargement de la page avec une Post demandant d'ajouter un utilisateur
        echo <<< FIN
                        
                                                                                    class="btn btn-primary btn-sm">Valider</button>
                                </div>
                            </form>
                        </td>
                        
                        <td> 
                            <form class="form" method="post" action="?page=admin" accept-charset="UTF-8">
                                <div class="form-group">
                                    <button type="submit" name="loginsuppression" value="
FIN;
        echo htmlspecialchars($donnees['login']) . '"';
        // Rechargement de la page avec une Post demandant de supprimer un utilisateur
        echo <<< FIN
                        
                                                                                    class="btn btn-danger btn-sm">Supprimer</button>
                                </div>
                            </form>
                        </td>
                    </tr>

FIN;
    }

    $reponse->closeCursor();
    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
}
?>

<!-- On affiche les utilisateurs pour les gérer toujours via une requète SQL-->

<div class="container">
    <div class="row centered sb">
        <h1>Gère tes membres</h1>
    </div>
</div>

<div class="container">
    <div class="row mt mb">
        <div class="container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Promotion</th>
                        <th>Administrateur</th> 
                        <th>Suppression</th>
                    </tr>
                </thead>
                <tbody>


<?php
$reponse = $dbh->query('SELECT `login`, `nom`,`prenom`, `promotion`, `membre` FROM utilisateurs ORDER BY `login`');

while ($donnees = $reponse->fetch()) {
    echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>"
    . "<td>" . htmlspecialchars($donnees['login']) . "</td>"
    . "<td>" . htmlspecialchars($donnees['prenom']) . "</td>"
    . "<td>" . htmlspecialchars($donnees['nom']) . "</td>";


    if ($donnees['promotion'] != 0) {
        echo "<td>X" . htmlspecialchars($donnees['promotion']) . "</td>";
    } else {
        echo "<td>Non polytechnicien</td>";
    }


    echo <<< FIN
                        

        <td> 
            <form class="form" method="post" action="?page=admin" accept-charset="UTF-8">
                <div class="form-group">
                                    
FIN;
    if ($donnees['membre'] == NULL) {
        echo '<button type="submit" name="rendreadmin" value="' . htmlspecialchars($donnees['login']) . '" class="btn btn-info btn-sm">Promouvoir Admin</button>';
    }

    // Un administrateur ne peut pas supprimer son grade d'administrateur, cela évite un site laissé à l'abandon.

    if ($donnees['membre'] == 'admin') {
        if ($donnees['login'] == htmlspecialchars($_SESSION['user']->login)) {
            echo ' ';
        } else {
            echo '<button type="submit" name="supprimeradmin" value="' . htmlspecialchars($donnees['login']) . '" class="btn btn-warning btn-sm">Supprimer Admin</button>';
        }
    }


    echo <<< FIN

            </div>
        </form>
    </td> 
    <td> 
        <form class="form" method="post" action="?page=admin" accept-charset="UTF-8">
            <div class="form-group">
FIN;
    
    
        if ($donnees['login'] == htmlspecialchars($_SESSION['user']->login)) {
            echo ' ';
        } else {
            echo '<button type="submit" name="loginmembersuppression" value="' . htmlspecialchars($donnees['login']) . '" class="btn btn-danger btn-sm">Supprimer</button>';
        }
    
                

    

    
    echo <<< FIN
                                
            </div>
        </form>
    </td>
 </tr>         

FIN;

}

$reponse->closeCursor();
?>

                </tbody>
            </table>
        </div>
    </div>
</div>





