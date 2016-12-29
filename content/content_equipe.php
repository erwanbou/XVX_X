

<?php


// On regarde d'abord si l'internaute cherche à voir une équipe avec GET//


if (isset($_GET['team'])) {
    
    if (htmlspecialchars($_GET['team']) == 'supporter') {
        ?>

        <div class="container">
            <div class="row centered">
                <h2>Les Supporters</h2>
            </div>
        </div>

        


        <div class="container">
            <div class="row mt mb">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Promotion</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php
        // On affiche les membre de la X1 avec une requète SQL
        $reponse = $dbh->query('SELECT `login`, `nom`,`prenom`, `promotion` FROM utilisateurs WHERE `team`="supporter" ORDER BY `nom`');

        while ($donnees = $reponse->fetch()) {
            if($_SESSION['loggedIn']){echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>";}
            else{echo "<tr>";}
            echo "<td>" . $donnees['nom'] . "</td>"
            . "<td>" . $donnees['prenom'] . "</td>";
            if($donnees['promotion']==0){
                echo "<td>Non polytechnicien</td>";
            }
            else{ echo "<td>X" . $donnees['promotion'] . "</td>";
            }
            echo "</tr>";
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
    
    
    
    if (htmlspecialchars($_GET['team']) == 'X1') {
        ?>

        <div class="container">
            <div class="row centered">
                <h2>La X1</h2>
            </div>
        </div>

        


        <div class="container">
            <div class="row mt mb">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Poste</th>
                                <th>Promotion</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php
        // On affiche les membre de la X1 avec une requète SQL
        $reponse = $dbh->query('SELECT `login`, `nom`,`prenom`, `poste`, `promotion` FROM utilisateurs WHERE `team`="X1" ORDER BY `poste`');

        while ($donnees = $reponse->fetch()) {
            if($_SESSION['loggedIn']){echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>";}
            else{echo "<tr>";}
            echo "<td>" . $donnees['nom'] . "</td>"
            . "<td>" . $donnees['prenom'] . "</td>"
            . "<td>" . $donnees['poste'] . "</td>";
            if($donnees['promotion']==0){
                echo "<td>Non polytechnicien</td>";
            }
            else{ echo "<td>X" . $donnees['promotion'] . "</td>";
            }
            echo "</tr>";
        }

        $reponse->closeCursor();
        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="container">
            <div class="row mt mb">
                <div class="container">
                    <table class="table table-hover" width=50%>
                        <tbody>

        <?php
        // On affiche les membre de la X1 avec une requète SQL
        $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="entraineur" ORDER BY `nom`');

        while ($donnees = $reponse->fetch()) {
            if($_SESSION['loggedIn']){echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>";}
            else{echo "<tr>";}
            
            echo "<td>Entraîneur</td>"
            . "<td>" . $donnees['nom'] . "</td>"
            . "<td>" . $donnees['prenom'] . "</td>";
            echo "</tr>";
        }

        $reponse->closeCursor();
        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<div class="container">
    <div class="row centered mb">
        <center>
            <h1>Quelques Photos</h1>
             <p style="margin-top:50px">
            </p>
            <div class="galleria" >
                <img src="assets/img/equipe/X1/photo1.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo2.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo3.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo4.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo5.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo6.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo7.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo8.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo9.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo10.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo11.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo12.jpg" alt="photo de la X1">
                <img src="assets/img/equipe/X1/photo13.jpg" alt="photo de la X1">
            </div>
        </center>
        
    </div>
</div>
<script>
    Galleria.loadTheme('utilities/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('.galleria');
</script>



        <?php
    }

    if (htmlspecialchars($_GET['team']) == 'X2') {
        ?>


        <div class="container">
            <div class="row centered ">
                <h2>La X2</h2>
            </div>
        </div>


        <div class="container">
            <div class="row mt mb">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Poste</th>
                                <th>Promotion</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php
        // On affiche les membre de la X2 avec une requète SQL
        $reponse = $dbh->query('SELECT `login` AS login, `nom` AS name,`prenom` AS prenom, `poste` AS poste, `promotion` AS promotion FROM utilisateurs WHERE `team`="X2" ORDER BY `poste`');

        while ($donnees = $reponse->fetch()) {
            if($_SESSION['loggedIn']){echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>";}
            else{echo "<tr>";}          
            echo "<td>" . $donnees['name'] . "</td>"
            . "<td>" . $donnees['prenom'] . "</td>"
            . "<td>" . $donnees['poste'] . "</td>";
            if($donnees['promotion']==0){
                echo "<td>Non polytechnicien</td>";
            }
            else{ echo "<td>X" . $donnees['promotion'] . "</td>";
            }
            echo "</tr>";
        }

        $reponse->closeCursor();
        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>


<div class="container">
    <div class="row centered mb">
        <center>
            <h1>Quelques Photos</h1>
             <p style="margin-top:50px">
            </p>
            <div class="galleria" >
                <img src="assets/img/equipe/X2/photo1.jpg" alt="PhotoX2">
                <img src="assets/img/equipe/X2/photo2.jpg" alt="PhotoX2">
            </div>
        </center>
        
    </div>
</div>
<script>
    Galleria.loadTheme('utilities/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('.galleria');
</script>



        <?php
    }
    if (htmlspecialchars($_GET['team']) == '7X7') {
        ?>


        <div class="container">
            <div class="row centered ">
                <h2>Les 7X7</h2>
            </div>
        </div>

        <div class="container">
            <div class="row mt">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Poste</th>
                                <th>Promotion</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php
        // On affiche les membres des 7X7 avec une requète SQL
        $reponse = $dbh->query('SELECT `login` AS login, `nom` AS name,`prenom` AS prenom, `poste` AS poste, `promotion` AS promotion FROM utilisateurs WHERE `team`="7X7" ORDER BY `poste`');

        while ($donnees = $reponse->fetch()) {
            if($_SESSION['loggedIn']){echo "<tr class='clickable-row' data-href='?page=profil&amp;login=" . $donnees['login'] . "'>";}
            else{echo "<tr>";}
            echo "<td>" . $donnees['name'] . "</td>"
            . "<td>" . $donnees['prenom'] . "</td>"
            . "<td>" . $donnees['poste'] . "</td>";
            if($donnees['promotion']==0){
                echo "<td>Non polytechnicien</td>";
            }
            else{ 
                echo "<td>X".$donnees['promotion']."</td>";
            }
            echo "</tr>";
        }

        $reponse->closeCursor();
        ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

<div class="container">
    <div class="row centered mt">
        <h1>Quelques Photos</h1>
    </div>
</div>
<div class="container">
    <div class="row mb">
        <center>
             <p style="margin-top:50px">
            </p>
            <div class="galleria" >
                <img src="assets/img/equipe/7X7/photo1.jpg" alt="Photo des 7X7">
                <img src="assets/img/equipe/7X7/photo2.jpg" alt="Photo des 7X7">
                <img src="assets/img/equipe/7X7/photo3.jpg" alt="Photo des 7X7">
            </div>
        </center>
    </div>
</div>
<script>
    Galleria.loadTheme('utilities/galleria/themes/classic/galleria.classic.min.js');
    Galleria.run('.galleria');
</script>


        <?php
    }

    if (htmlspecialchars($_GET['team']) != 'X1' && htmlspecialchars($_GET['team']) != 'supporter' && htmlspecialchars($_GET['team']) != 'X2' && htmlspecialchars($_GET['team']) != '7X7') {
        ?>


        <div class="container">
            <div class="row centered mt mb" >
                <h2>Un problème d'équipe peut-être?</h2>
            </div>
        </div>      


        <?php
    }
} else {
    // Si GET['page'] n'est pas défini, on montre les équipes.
    ?>

    <div class="container">
        <div class="row centered mt mb">
            <h1>Les Équipes</h1>
        </div>
    </div>
    
<div class="container centered mb">
    <div class="col-sm-4">
    <div class="grid">
        
        <figure class="effect-sadie">
            <img src="assets/img/equipe/X1/X1.JPG" alt="Équipe X1"/>
            <figcaption>
                <h2>LA <span>X1</span></h2>
                <p>Champion d'Île de France <br>C'est l'équipe favorite</p>
                <a href="?page=equipe&amp;team=X1"></a>
            </figcaption>			
        </figure>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="grid">
        <figure class="effect-sadie">
            <img src="assets/img/equipe/X2/X2.jpg" alt="Équipe X2"/>
            <figcaption>
                <h2>LA <span>X2</span></h2>
                <p>Équipe joyeuse et investie<br>Elle incarne l'esprit rugby</p>
                <a href="?page=equipe&amp;team=X2"></a>
            </figcaption>			
        </figure>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="grid">
        <figure class="effect-sadie">
            <img src="assets/img/equipe/7X7/7X7.jpg" alt="Équipe 7X7"/>
            <figcaption>
                <h2>LES <span>7X7</span></h2>
                <p>Loin d'être dans la dentelle<br>Elles sont particulièrement attachantes</p>
                <a href="?page=equipe&amp;team=7X7"></a>
            </figcaption>			
        </figure>
    </div>
    </div>
    
 </div>

<div class="container mb">
    <div class="col-sm-3">
        
    </div>
    <div class="col-sm-6">
        <div class="grid">
            <figure class="effect-sadie">
            <img src="assets/img/equipe/supporter.jpg" alt="Équipe X1"/>
            <figcaption>
                <h2>Les<span>supporters</span></h2>
                <p>Toujours là, toujours présent <br>Merci à eux</p>
                <a href="?page=equipe&amp;team=supporter"></a>
            </figcaption>			
            </figure>
        </div>
    </div>
    <div class="col-sm-3">
        
    </div>
</div>





    <?php
}
?>



