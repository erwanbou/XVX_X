				

<div class="container">
    <div class="row centered mt mb">
        <h1>Bienvenue!</h1>
    </div>
</div>


    
<?php

    if (!$_SESSION[('loggedIn')]){
    ?>

<div class="container">
    <div class="row centered  mb">
    
    
        <h3><a href="?page=connexion">Connecte toi!</a></h3>
        <h5><a href="?page=inscription">Ou alors inscris toi!</a></h5>

   
    </div>
</div>
    
    <?php
   
    }
    
    else{
        $datenaissance = explode('-', htmlspecialchars($_SESSION['user']->naissance));
        $today = explode('-', date("Y-m-d"));
        if($datenaissance[1] == $today[1] && $datenaissance[2]==$today[2]){
            ?>
<div class="container">
    <div class="row centered  mb">
    
    
        <h3><a href="?page=connexion">****  JOYEUX ANNIVERSAIRE  <?php echo htmlspecialchars($_SESSION['user']->prenom); ?> **** </a></h3>


   
    </div>
</div>
            



<?php
        }
    }
   
   ?>



