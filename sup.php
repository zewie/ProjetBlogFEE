<?php
session_start();

require_once('config/bdd.conf.php');
require_once('config/init.conf.php');
require_once('config/connexion.inc.php');
include 'include/header.inc.php';

if ($is_connect == TRUE) {



// si le cookie existe
    if (!isset($_POST['Supprimer'])) { 
        

        $delete = "DELETE FROM articles WHERE id = :id_article";
        
        $sth = $bdd->prepare($delete); // preparer la requete
        $sth->bindValue(':id_article', $_GET['id'], PDO::PARAM_INT);


        if ($sth->execute() == TRUE) {
            $notification = 'Félicitation votre article est supprimé.';
            $_SESSION['notification_result'] = TRUE;
        } 

        $_SESSION['notification'] = $notification;
    }
    else
    {
   
    }
    ?>


    <br>
    <br>
    

    <?php 
    
    
    
     header("Location: index.php");
    ?>



    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper/popper.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <?php
} else { // sinon on dit a l'utiisateur qu'il doit etre co' 
    include 'include/footer.inc.php';
    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <p class="mt-5">Vous devez être connecté !</p>
        </div>
    </div>
    <?php
}
?>