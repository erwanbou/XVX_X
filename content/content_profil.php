<?php

// ex pour une image jpg

if (!empty($_FILES['fichier']['tmp_name']) && is_uploaded_file($_FILES['fichier']['tmp_name'])) {
// Le fichier a bien été téléchargé
// Par sécurité on utilise getimagesize plutot que les variables $_FILES
list($larg,$haut,$type,$attr) = getimagesize($_FILES['fichier']['tmp_name']);
$pb = false;
$taille_maxi = 500000;
$taille = filesize($_FILES['fichier']['tmp_name']);
if($taille>$taille_maxi){
    $pb = true;
    $erreur = "fichier trop volumineux!";
}
else{
// JPEG => type=2
if ($type == 2) {
   if(file_exists("assets/img/profil/".htmlspecialchars($_SESSION['user']->login.".jpg"))){
        
        if (unlink('assets/img/profil/'.htmlspecialchars($_SESSION['user']->login).'.jpg')  &&  move_uploaded_file($_FILES['fichier']['tmp_name'],'assets/img/profil/'.htmlspecialchars($_SESSION['user']->login).'.jpg')) {
            echo "Copie réussie";
        } 
        else {
            $pb = true;
            $erreur = "Le fichier a un problème";
        }
   }
} 
else
  $pb = true;
  $erreur = "le fichier n'est pas sous le format jpg";
}
}



if (isset($_GET["login"])) {
    $login = htmlspecialchars($_GET["login"]);
    $currentlog = false;
} else {
    $login = $_SESSION["user"]->login;
    $currentlog = true;
}


$user = Utilisateur::getUtilisateur($dbh, $login);
if ($user == NULL) {
    echo <<< FIN
            
<div class="container">
    <div class="row centered mt mb">
        <h3>Cet utilisateur n'existe pas</h3>
    </div>
</div>
FIN;
} else {

    echo <<< FIN
<div class="container">
    <div class="row centered mt mb">
    
FIN;
    
    

    if ($currentlog == false) {
        if(file_exists('assets/img/profil/'.htmlspecialchars($user->login).'.jpg')){
            echo '<p><img src="assets/img/profil/'.htmlspecialchars($user->login).'.jpg" class="img-circle" width=200 alt="image profil"></p>';
        }
        
        
        echo '<h3>' . htmlspecialchars($user->prenom) . ' ' . htmlspecialchars($user->nom) . '</h3>';
        if (htmlspecialchars($user->team) == 'entraineur') {
            echo '<h5> Entraîneur </h5>';
        }

        echo <<< FIN
        
        </div>
</div>
<div class="container">   
    <div class="row mb">
        <div class="col-md-6">
            <div class="form-group col-md-12">
        
FIN;
        if (htmlspecialchars($user->team) == 'supporter') {
            echo "C'est un supporter du XV de l'X. Il dit jouer en tant que " . $user->poste . " mais il ne joue pas."
            . "Il aime le pâté, le saucisson et les jours de match";
        } else {

            echo <<< FIN
            
            <table>         
       
FIN;
            if (htmlspecialchars($user->team) == 'X1' OR htmlspecialchars($user->team) == 'X2' OR htmlspecialchars($user->team) == '7X7') {
                echo '<tr>                 
                        <td class="fc_inf_lib"> Équipe : </td><td> </td>  ';
                echo '<td>' . htmlspecialchars($user->team) . '</td>'
                . '</tr>';
            }
            
            echo "<tr> <td> Nombre d'essais marqués</td><td> </td> <td>".Essai::getessailogin($dbh, htmlspecialchars($user->login))['COUNT(*)']."</td></tr>" ;
            if(htmlspecialchars($user->team) == 'X1' OR htmlspecialchars($user->team) == 'X2'){
                echo "<tr><td></td><td></td><td>".Essai::getessailoginequipe($dbh,htmlspecialchars($user->login) , 'X1')['COUNT(*)']." en X1 et ".Essai::getessailoginequipe($dbh,htmlspecialchars($user->login) , 'X2')['COUNT(*)']." en X2 </td></tr>";
            }
            
            if (htmlspecialchars($user->entraineur1) == 'OUI' OR htmlspecialchars($user->entraineur2) == 'OUI' OR htmlspecialchars($user->entraineur7) == 'OUI') {
                echo '<tr><td class="fc_inf_lib">Équipe entraînée : </td>  <td>   </td> <td>';

                if (htmlspecialchars($user->entraineur1) == 'OUI') {
                    echo ' X1 ';
                }
                if (htmlspecialchars($user->entraineur2) == 'OUI') {
                    echo ' X2 ';
                }
                if (htmlspecialchars($user->entraineur7) == 'OUI') {
                    echo ' 7X7 ';
                }
                echo '</td> </tr>';
            }
            
            
            
            
            
            $date = explode('-', $user->naissance);
            
            
            
            echo '<tr><td colspan="3"> <hr /> </td> </tr>'
            . '<tr>'
            . '<td class="fc_inf_lib">Date de naissance : </td> <td>  &nbsp; &nbsp;  </td> '
            . '<td>' . $date[2] . "/" . $date[1] . "/" . $date[0] . '</td>';
            if ($date[1] == date('m') && $date[0] == date('Y')) {
                echo "c'est sont anniversaire!";
            }

            if (htmlspecialchars($user->taille) != 0) {
                echo '<tr>                 
                        <td class="fc_inf_lib">Taille : </td> <td>   </td>';
                echo '<td>' . htmlspecialchars($user->taille) . ' cm</td>'
                . '</tr>';
            }


            if (htmlspecialchars($user->poids) != 0) {
                echo '<tr>                 
                        <td class="fc_inf_lib">Poids : </td><td>   </td>';
                echo '<td>' . htmlspecialchars($user->poids) . ' kg</td>'
                . '</tr>';
            }

            echo '<tr>                 
                        <td class="fc_inf_lib">Poste Préféré : </td><td>   </td>';
            echo '<td>n°'. htmlspecialchars($user->poste) . '</td>' . '</tr>';

            echo '<tr>                 
                        <td class="fc_inf_lib">Promotion : </td><td>   </td>';
            if (htmlspecialchars($user->promotion) != 0) {
                echo "<td>X" . htmlspecialchars($user->promotion) . "</td>";
            } else {
                echo "<td>Non polytechnicien</td>";
            }

            echo '<tr>                 
                        <td class="fc_inf_lib">Adresse email : </td><td>   </td>';
            echo '<td>' . htmlspecialchars($user->email) . '</td>' . '</tr>';




            if (htmlspecialchars($user->entraineur1) == 'OUI') {
                
            }
        }



        echo <<< FIN
        
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <h4> Commentaires </h4>
            <p style="text-align:left;">
FIN;
        echo htmlspecialchars($user->commentaire);
        echo <<< FIN
            
            </p>
        </div>        
    </div>
</div>
        
FIN;
    } else {
        echo '<h3>Bienvenu sur ton profil</h3>';
        echo <<< FIN
            
    </div>
</div>
    
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group col-md-12">      
              
                

FIN;

        if ($_SESSION['user']->poids != 0) {
            echo '<span style="color:green;"> Ton Poids : ' . htmlspecialchars($_SESSION['user']->poids) . 'kg </span><br>';
            echo '<form method="post" action ="?todo=modif&page=profil" accept-charset="UTF-8">'
            . 'Tu as grossi? Modifie ton poids : ';
        } else {
            echo '<form method="post" action ="?todo=modif&page=profil" accept-charset="UTF-8">'
            . 'Enregistre ton Poids : ';
        }

        echo <<< FIN

   
              
              <input type="number" name="poids" placeholder ="en kg">
          <br> <br>
                
          
FIN;

        if ($_SESSION['user']->taille != 0) {
            echo '<span style="color:green;"> Ta Taille : ' . htmlspecialchars($_SESSION['user']->taille) . 'cm </span><br>';
            echo 'Tu as grandi? Modifie ta taille :';
        } else {
            echo 'Enregistre ta taille :';
        }

        echo <<< FIN
        
                <input type="number" name="taille" placeholder ="en cm"> 
                    <br> <br>
                

FIN;

        if ($_SESSION['user']->commentaire != "") {
            
            echo 'Modifie ton commentaire : <br> <br>';
        } else {
            echo 'Enregistre un commentaire sur toi! <br>';
        }

       
            
            echo '<textarea name="commentaire" rows="10" cols="43" placeholder ="Insère un commentaire">'. htmlspecialchars($_SESSION['user']->commentaire).'</textarea>';
        
        echo <<< FIN
            
          
          <br> <br>
          
                <button type="submit" class="btn btn-primary">Enregistrer</button>
          
              </form>
              

            </div>
        </div>
            
        
            
        <div class="form-group col-md-6"> 
            <div class="form-group col-md-12">
FIN;
        
        if(file_exists("assets/img/profil/".htmlspecialchars($_SESSION['user']->login.".jpg"))){
            echo 'Modifie ta photo de profil : <br> ';
        }    
        else{
            echo 'Ajoute une photo de profil! <br>';
        }        
        if (isset($pb) && $pb){
            echo '<B style="color:red;"><I>'.$erreur.'</I></B> <br>';
        }
        echo <<< FIN
        
            <br>
            <form action="index.php?page=profil" method="post" enctype="multipart/form-data">
            <input type="file" name="fichier"/>
                <br>
            <button type="submit" class="btn btn-primary">Envoyer</button>
            </form>
            
            </div>
            
            <div class="form-group col-md-12 mt mb"> 
                <form method="post" action ="?todo=modif&amp;page=profil" accept-charset="UTF-8" oninput="password2.setCustomValidity(password2.value != password1.value ? 'Les mots de passe diffèrent.' : '')">
                <span id="ZoneDeClic"></span>
                <div id="TexteAAfficher" style="text-align:left;font-size: small">
                    <table>
                    <tr><td><p>Ancien mot de passe : </td> <td> </td><td><input type="password" name="vieuxpassword" class="form-control" id="vieuxpassword" value=""></td></tr>
                    <tr><td><p>Nouveau mot de passe : </td> <td> </td> <td><input type="password" name="password1" class="form-control" id="password1" value=""></td></tr>
                    <tr><td><p>Nouveau mot de passe (confirmation) : </td> <td> </td> <td><input type="password" name="password2" class="form-control" id="password2" value=""></td></tr>
                    </table>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                
                </form>
            </div>
        </div>
              
    </div>
</div>           
              
              
              
              
FIN;



        echo <<< FIN
          
<div class="container">
    <div class="row centered mt mb">
    
FIN;

        echo '<h3><a href="?page=profil&amp;login=' . $user->login . '">Regarde ta fiche joueur publique</a></h3> ';



        
    
    echo <<< FIN
    </div>
</div>
    
    
FIN;
    }
} 



/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

