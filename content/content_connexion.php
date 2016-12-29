<?php
if ($_SESSION['loggedIn']) {
    if (isset($_GET['todo']) && htmlspecialchars($_GET['todo']) == 'login') {
        ?>

        <div class="container">
            <div class="row centered mt mb">
                Tu es connecté!
            </div>
        </div>


        <?php
    } else {
        ?>

        <div class="container">
            <div class="row centered mt mb">
                <h1>Mais que fais tu ici?</h1>
            </div>
        </div>

        <?php
    }
} else {
    ?>



    <div class="container">
        <div class="row centered mt mb">
            <h1>Connecte Toi!</h1>
        </div>
    </div>
    <div class="container">
        <div class="row centered mb">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">

                <?php
                
                if (isset($_GET['todo']) && htmlspecialchars($_GET['todo']) == 'login') {
                    echo '<p><B style="color:red;">Le login ou le mot de passe est incorrect</B></p>';
                }
                
                ?>

                <form method="post" action ="?todo=login&page=connexion" accept-charset="UTF-8" id="login-nav">

                    <p><label class="sr-only" for="nomutilisateur">Nom d'utilisateur</label>
                        <input type="text" class="form-control" name="nomutilisateur" placeholder="Nom d'utilisateur" required>
                    </p>

                    <label class="sr-only" for="password">Mot de Passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Mot de passe" required>
                    <br>
                    <p class="remember_me">
                        <label>
                            <input type="checkbox" name="remember_me" id="remember_me">
                            Remember me on this computer
                        </label>

                    </p>
                    <p class="submit"><input type="submit" name="commit" value="Login"></p>

                </form>
                <p><a href="?page=inscription">Si tu n'est pas encore inscrit, clique ici</a></p>
            </div>
            <div class="col-md-4">
            </div>



        </div>
    </div>

    <?php
}