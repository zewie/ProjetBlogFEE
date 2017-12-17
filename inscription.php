<?php
/* @var $bdd PDO */
session_start();
require_once('config/bdd.conf.php');
require_once('config/init.conf.php');
include('include/header.inc.php');
require_once('include/function.inc.php');
require_once('config/connexion.inc.php');

 if ($is_connect == TRUE)
            {

//verification formulaire
if (isset($_POST['submit'])) {
    if (!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['password'])) { 
        
// on verifie que le formulaire a était rempli
        
        
        $insert = "INSERT INTO utilisateur (nom, prenom, email, mdp) "
                . "VALUES (:nom, :prenom, :email, :password)";   // requete permettant d'inserrer dans la base de données
 
        //on lie les differents case de la bdd a une valeur ( bind )
        $sth = $bdd->prepare($insert);
        $sth->bindValue(':nom', $_POST['nom'], PDO::PARAM_STR);
        $sth->bindValue(':prenom', $_POST['prenom'], PDO::PARAM_STR);
        $sth->bindValue(':email', $_POST['email'], PDO::PARAM_STR);
        $sth->bindValue(':password', cryptPassword($_POST['password']), PDO::PARAM_STR);
        if ($sth->execute() == TRUE) {
            $notification = "inscription effectué";
            $_SESSION['inscription_result'] = TRUE; // si cela a fonctionner on envoie une notif pour dire que c'est ok 
        }
       else{
           $notification = "Erreur dans l'insertion";
           $_SESSION['inscription_result'] = FALSE;      // si les champs sont pas correctement remplis on envoie une notif    
           }
    }
    else
    {
        $notification = "veuillez renseigner tout les champs";
        $_SESSION['inscription_result'] = FALSE;  // si il y a des champs vide 
    }

        $_SESSION['notification_inscription'] = $notification;               
        header ('Location:inscription.php');   // si l'inscription est ok on renvoie sur la page inscription si on veux encore inscrire des gens 
        exit();
}
else{

?>

<?php

        if(isset($_SESSION['notification_inscription'])) // on affiche les différentes notifs 
        {
            $inscription_result = $_SESSION['inscription_result'] == TRUE ? 'success' : 'danger';
            
            ?>
        <div class="alert alert-<?= $inscription_result ?> alert-dismissible fade show col-md-6" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <strong>
    <?php     
        echo $_SESSION['notification_inscription'];
        ?>
        </strong>
        </div>
        <?php
        unset($_SESSION['notification_inscription']);
        unset($_SESSION['inscription_result']);    // on detruit les variables 
        }
        ?>

<div class="container col-md-6">
        <h1 class="mt-5">Inscription </h1>
        <form action="inscription.php" method="POST">            
            <div class="form-group">
                <label for="nom" class="col-form-label">nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <label for="prenom" class="col-form-label">prenom</label>
                <input type="text" class="form-control" id="nom" name="prenom" placeholder="Prenom">
            </div>
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
            }
            else
{
    header("Location: connexion.php");
}
?>