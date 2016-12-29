<?php


$form_values_valide = false;

    if(isset($_POST["titre"]) && htmlspecialchars($_POST["titre"]) != "" &&
       isset($_POST["team"]) && htmlspecialchars($_POST["team"]) != "" && 
       isset($_POST["date"]) && htmlspecialchars($_POST["date"]) != "" &&
       isset($_POST["adversaire"]) && htmlspecialchars($_POST["adversaire"]) != "" &&
       isset($_POST["lieu"]) && htmlspecialchars($_POST["lieu"]) != "" &&
       isset($_POST["scorex"]) && htmlspecialchars($_POST["scorex"]) != "" &&
       isset($_POST["score2"]) && htmlspecialchars($_POST["score2"]) != ""
       )
        {  $form_values_valide = true;       
    }
    

if(isset($_POST["commentaire"])){
    $commentaire=  htmlspecialchars($_POST['commentaire']);
}


if($form_values_valide){
    if(Match::getMatch($dbh, htmlspecialchars($_POST["titre"]))==null){
        Match::nouveauMatch($dbh, htmlspecialchars($_POST["titre"]), htmlspecialchars($_POST["date"]), htmlspecialchars($_POST["team"]), htmlspecialchars($_POST["adversaire"]), htmlspecialchars($_POST["scorex"]), htmlspecialchars($_POST["score2"]), htmlspecialchars($_POST['commentaire']), htmlspecialchars($_POST["lieu"]));
        $matchinserer  = true;  
    
    if ((isset($_POST['loginessai1']) && $_POST['loginessai1']>0)){Essai::nouvelessai($dbh, htmlspecialchars($_POST["titre"]), $_POST['loginessai1'], htmlspecialchars($_POST['commentaire1']), $_POST['team']);}
    if ((isset($_POST['loginessai2']) && $_POST['loginessai2']>0)){Essai::nouvelessai($dbh, htmlspecialchars($_POST["titre"]), $_POST['loginessai2'], htmlspecialchars($_POST['commentaire2']), $_POST['team']);}
    if ((isset($_POST['loginessai3']) && $_POST['loginessai3']>0)){Essai::nouvelessai($dbh, htmlspecialchars($_POST["titre"]), $_POST['loginessai3'], htmlspecialchars($_POST['commentaire3']), $_POST['team']);}
    if ((isset($_POST['loginessai4']) && $_POST['loginessai4']>0)){Essai::nouvelessai($dbh, htmlspecialchars($_POST["titre"]), $_POST['loginessai4'], htmlspecialchars($_POST['commentaire4']), $_POST['team']);}
    if ((isset($_POST['loginessai5']) && $_POST['loginessai5']>0)){Essai::nouvelessai($dbh, htmlspecialchars($_POST["titre"]), $_POST['loginessai5'], htmlspecialchars($_POST['commentaire5']), $_POST['team']);}
    }
    
    else {$matchinserer = false;}
}






if (isset($_GET['team'])) {
    if (htmlspecialchars($_GET['team']) == 'X1' || htmlspecialchars($_GET['team']) == 'X2' || htmlspecialchars($_GET['team']) == '7X7') {
        $team = htlmspecialchars($_GET['team']);
        if(isset($_GET['title'])){
            $titre = htmlspecialchars($_GET['title']);
            $match = Match::getMatch($dbh, $titre);
            if ($match == NULL) {
            echo <<< FIN
            
<div class="container">
    <div class="row centered mt mb">
        <h3>Ce match n'a jamais eu lieu</h3>
    </div>
</div>
                    
FIN;
                }
                else {

?>
    <div class="container">
    <div class="row centered mt mb">

<?php
                
                echo '<h1>' . htmlspecialchars($match->titre).'</h1>';
        
                echo '<h3>'.htmlspecialchars($match->team).' VS '.htmlspecialchars($match->adversaire).'</h3>';
                if($match->scorex > $match->score2){
                    echo '<h3> Victoire : '.$match->scorex.' - '.$match->score2.'</h3>';
                }
                elseif($match->scorex == $match->score2){
                    echo '<h3> Match Nul : '.$match->scorex.' à '.$match->score2.'</h3>';
                }
                elseif($match->scorex < $match->score2){
                    echo '<h3> Défaite : '.$match->scorex.' à '.$match->score2.'</h3>';
                }
                $date = explode('-',$match->date);
                echo '<h5>le '.$date[2].'/'.$date[1].'/'.$date[0].' à '.htmlspecialchars($match->lieu).'</h5>';
?>        
        
    </div>
</div>
        
<div class="container"> 
    <div class="row mt mb" align = "left">
       <div class="col-md-4">
           <h3>Essai(s) Marqué(s)</h3>
           
<?php
    if(Essai::rechercheessai($dbh, htmlspecialchars($match->titre))){
        $reponse = $dbh->query("SELECT `login`, `commentaire` FROM `essai` WHERE `titre`='".htmlspecialchars($match->titre)."' ");
        while($donnees = $reponse->fetch()){
            
                $user = Utilisateur::getUtilisateur($dbh, $donnees['login']);
                    if ($user==null){
                        echo "<p>Essai d'une personne non renseignée.".$donnees['commentaire']."</p>";
                    }
                    else{
                        echo '<p>Essai de <a href="?page=profil&amp;login='.$donnees['login'].'" > '.$user->prenom." ".$user->nom."</a>. ".$donnees['commentaire']."</p>";
                    }
            
        } 
        $reponse->closeCursor();
        
    }
    else{
        echo "<p> Auncun essai enregistré </p>";
    }
        
        
        
        
       
?>
               
               
           
           
           
           
       </div>
       <div class="col-md-8">
           <h3>Commentaire</h3>
       <p>   
           
           
     <?php      
           echo $match->commentaire;
        
     ?>
            </p>
            </div>
     </div>
</div>

<?php
                }
        }
        else{
            
        

        echo '<div class="container">
            <div class="row centered">';
        echo"<h2> Matchs disputés par l'équipe ".$team.'</h2> </div>
        </div>';
        
?>

        <div class="container">
            <div class="row mt mb">
                <div class="container">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Adversaire</th>
                                <th>Lieu</th>
                                <th>Issue du match</th>
                                <th>Score</th>
                            </tr>
                        </thead>
                        <tbody>

        <?php
        $reponse = $dbh->query("SELECT `titre`, `adversaire`,`lieu`, `date`, `scorex`, `score2` FROM `match` WHERE `team`='".$team."' ORDER BY `date` DESC");

        while ($donnees = $reponse->fetch()) {
            echo "<tr class='clickable-row' data-href='?page=resultat&amp;team=".$team."&amp;title=".$donnees['titre']."'>"
            . "<td>" . $donnees['date'] . "</td>"
            . "<td>" . $donnees['adversaire'] . "</td>"
            . "<td>" . $donnees['lieu'] . "</td>";
            if($donnees['scorex'] > $donnees['score2']){
                echo '<td> Victoire </td>';
            }
            elseif($donnees['scorex'] < $donnees['score2']){
                echo '<td> Défaite </td>';
            }
            elseif($donnees['scorex'] == $donnees['score2']){
                echo '<td> Match Nul </td>';
            }
            else{echo '<td></td>';}
            echo "<td>" . $donnees['scorex'] . " - " . $donnees["score2"] . "</td>"
            . "</tr>";
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
    }
    else{
        
        echo <<< FIN
    
<div class="container">
    <div class="row centered mt mb">
        <h3>Ce match n'a jamais eut lieu</h3>
    </div>
</div>
        
FIN;
        
    }
                
}

else{
    
    if(isset($matchinserer)){
        if($matchinserer){
            echo '<div class="container">
                        <div class="row centered">
                        <h3>Ton match a été enregistré</h3>
                        <h5>Regarde le <a href="?page=equipe&amp;title='.htmlspecialchars($_POST['titre']).'">ici</a></h5>
                        </div>
                 </div>';
        }
        else{
            echo '<div class="container">
                        <div class="row centered">
                        <h3>Ton titre a déjà été utilisé pour un match... Change le!</h3>
                        </div>
                 </div>';
            
        }
    }
    
?>


    <div class="container">
        <div class="row centered mt mb">
            <h1>Match par équipe</h1>
        </div>
    </div>
    
<div class="container">
    <div class="col-sm-4">
    <div class="grid">
    
        <figure class="effect-sadie">
            <img src="assets/img/equipe/X1/X1.JPG" alt="Équipe X1"/>
            <figcaption>
                <h2>LA <span>X1</span></h2>
                <p>Championnat d'Île de France</p>
                <a href="?page=resultat&amp;team=X1"></a>
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
                <p>Honneur Île de France</p>
                <a href="?page=resultat&amp;team=X2"></a>
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
                <p>Tournois par-ci par-là</p>
                <a href="?page=resultat&amp;team=7X7"></a>
            </figcaption>			
        </figure>
    </div>
    </div>
    
 </div>

<div class="container">
    <div class="row centered mt mb">
        <?php
        
        if($_SESSION['loggedIn']){
        ?>
            
            <form method="post" action="?page=resultat" accept-charset="UTF-8">
                <span id="ZoneDeCliq"></span>
                <div id="Creerunmatch" style="text-align:left;font-size: small" >

                   

                
                    <table style="width:100%;">
                    <tr><td>Équipe concernée : </td> <td> </td><td><p>
                               <select name="team">
                                    <option value="X1">X1     </option>
                                    <option value="X2">X2        </option>
                                    <option value="7X7">7X7        </option>
                                </select>
                            </p></td></tr>
                    <tr><td>Date : </td> <td> </td><td><p><input type="date" name="date" class="form-control" value=""></p></td></tr>
                    <tr><td>Adversaire : </td> <td> </td> <td><p><input type="text" name="adversaire" class="form-control" value=""></p></td></tr>
                    <tr><td>Lieu : </td> <td> </td><td><p>
                               <select name="lieu">
                                    <option value="Domicile">Domicile      </option>
                                    <option value="Extérieur">Extérieur       </option>
                                </select>
                            </p></td></tr>
                    
                    
                    
                    <tr><td>Score du XV de l'X : </td> <td> </td><td><p><input type='number' name="scorex" class="form-control" value=""></p></td></tr>
                    <tr><td></td><td> </td><td> <span id="ZoneDeClique"></span>
                            <div id="ajouteressai" style="text-align:left;font-size: small">
                                <p>Essai de
                                <select name="loginessai1">
                                    <option value="">Choisis un joueur </option>
                                    <?php
                                            // On affiche les membres avec une requète SQL
                                            $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="X1" OR `team`="X2" OR team="7X7" ORDER BY `prenom`');
                                            
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="'.$donnees['login'].'">'.$donnees['prenom']." ".$donnees['nom']." </option>";
                                            }

                                            $reponse->closeCursor();
                                            ?>
                                </select>
                                    Un commentaire? <input type="text" name="commentaire1" value="">
                                </p>
                                <p>Essai de
                                <select name="loginessai2">
                                    <option value=""> Choisis un joueur </option>
                                    <?php
                                            // On affiche les membres avec une requète SQL
                                            $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="X1" OR `team`="X2" OR team="7X7" ORDER BY `prenom`');
                                            
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="'.$donnees['login'].'">'.$donnees['prenom']." ".$donnees['nom']." </option>";
                                            }

                                            $reponse->closeCursor();
                                            ?>
                                </select>
                                    Un commentaire? <input type="text" name="commentaire2" value="">
                                </p>
                                
                                <p>Essai de
                                <select name="loginessai3">
                                    <option value="">Choisis un joueur </option>
                                    <?php
                                            // On affiche les membres avec une requète SQL
                                            $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="X1" OR `team`="X2" OR team="7X7" ORDER BY `prenom`');
                                            
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="'.$donnees['login'].'">'.$donnees['prenom']." ".$donnees['nom']." </option>";
                                            }

                                            $reponse->closeCursor();
                                            ?>
                                </select>
                                    Un commentaire? <input type="text" name="commentaire3" value="">
                                </p>
                                <p>Essai de
                                <select name="loginessai4">
                                    <option value="">Choisis un joueur </option>
                                    <?php
                                            // On affiche les membres avec une requète SQL
                                            $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="X1" OR `team`="X2" OR team="7X7" ORDER BY `prenom`');
                                            
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="'.$donnees['login'].'">'.$donnees['prenom']." ".$donnees['nom']." </option>";
                                            }

                                            $reponse->closeCursor();
                                            ?>
                                </select>
                                   Un commentaire? <input type="text" name="commentaire4" value="">
                                </p>
                                <p>Essai de
                                <select name="loginessai5">
                                    <option value=""> Choisis un joueur </option>
                                    <?php
                                            // On affiche les membres avec une requète SQL
                                            $reponse = $dbh->query('SELECT `login`, `nom`,`prenom` FROM utilisateurs WHERE `team`="X1" OR `team`="X2" OR team="7X7" ORDER BY `prenom`');
                                            
                                            while ($donnees = $reponse->fetch()) {
                                                echo '<option value="'.$donnees['login'].'">'.$donnees['prenom']." ".$donnees['nom']." </option>";
                                            }

                                            $reponse->closeCursor();
                                            ?>
                                </select>
                                Un commentaire? <input type="text" name="commentaire5" value="">
                                </p>
                                <p> Il n'y a que 5 champs car s'il y en a plus, c'est que le match était trop facile et donc que les essais ont trop peu de valeur.
                                </p>
                            </div> 
                        </td>
                    </tr>
                            
                    <tr><td>Score adversaire : </td> <td> </td><td><p><input type='number' name="score2" class="form-control" value=""></p></td></tr>
                    <tr><td>Titre du match : </td> <td> </td><td><p><input type='text' name="titre" class="form-control" value=""></p></td></tr>
                    <tr><td>Commentaire : </td> <td> </td><td><p><textarea name="commentaire" rows="10" cols="43" 
                     <?php if(isset($commentaire)){echo 'value = "'.$commentaire.'" ';}
                     else{ echo 'placeholder ="Décrit le match (essai, pénalité, blessés, carton, anecdotes)"';}
                     ?>
                                                                           ></textarea></p></td></tr>
                    <tr><td></td><td> </td><td><button type="submit" name="commit" class="btn btn-primary">Enregistrer</button></td></tr>

                    </table>
                
                </div>
                
                </form>
            
            
        <?php
            
        }
        
        
        
        
        
        ?>
    </div>
</div>




<?php
    
    
}
            




