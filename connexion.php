<?php
/* @var $bdd PDO */
session_start();
require_once('config/bdd.conf.php');
require_once('config/init.conf.php');
include('include/header.inc.php');
require_once('include/function.inc.php');
require_once('config/connexion.inc.php');

if (isset($_POST['submit'])) {
    print_r($_POST);

    $notification = "Erreur dans l'insertion";
    $_SESSION['inscription_result'] = FALSE;

    if (!empty($_POST['email']) AND !empty($_POST['password'])) {
        
        $mdp_hash = cryptPassword($_POST['password']);   // on crypte le mdp 

    
        $select_user = "SELECT email, mdp FROM utilisateur WHERE email = :email AND mdp = :password"; // requete SQL 
        $sth = $bdd->prepare($select_user);
        $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR); // on post l'email
        $sth->bindValue(':password', $mdp_hash, PDO::PARAM_STR); // on post le mot de passe crypté
        if ($sth->execute() == TRUE) {
            $count = $sth->rowCount();
            if ($count > 0) {
                $sid = sid($_POST['email']);
                
                $update_sid = "UPDATE utilisateur SET sid= :sid WHERE email = :email";  // requete pour update le SID
                $sth_update = $bdd->prepare($update_sid);
                $sth_update->bindValue(':sid', $sid, PDO::PARAM_STR);
                $sth_update->bindValue(':email', $_POST['email'], PDO::PARAM_STR);

                
                if ($sth_update->execute() == TRUE) { // on execute la requête 
                    
                    setcookie('sid', $sid, time() + 86400); // on crée un cookie 
                    $notification = "Félicitation vous êtes connecté";

                    $_SESSION['notification_connexion'] = $notification;
                    $_SESSION['connexion_result'] = TRUE;
                    header("Location: index.php");
                    exit();
                }
            } else {
                $notification = "Login ou mdp invalide";
                $_SESSION['connexion_result'] = FALSE;
            }
        } else {
            $notification = "Erreur technique survenue";
            $_SESSION['connexion_result'] = FALSE;
        }
    } else {
        $notification = "veuillez renseigner tout les champs";
        $_SESSION['connexion_result'] = FALSE;
    }


    $_SESSION['notification_connexion'] = $notification;
    header('Location:connexion.php');
    exit();
} else {
    ?>



<div class="container">
    <div class="container col-md-6">
    <?php
require_once('include/notification.inc.php')
    ?>
</div>
</div>



    <div class="container">
        <div class="container col-md-6">
            <h1 class="mt-5">Connexion </h1>
            <form action="connexion.php" method="POST">  
                <div class="form-group">
                    <label for="email" class="col-form-label">email</label>
                    <input type="email" class="form-control" id="nom" name="email" placeholder="exemple@mail.com">
                </div>
                <div class="form-group">
                    <label for="password" class="col-form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">valider</button>    
                </div>
            </form>
        </div>



        <!-- Bootstrap core JavaScript -->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/popper/popper.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <?php
    include ('include/footer.inc.php');
}
?>