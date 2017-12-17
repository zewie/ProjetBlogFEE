<?php

include ('config/bdd.conf.php');

$is_connect = FALSE;

// vérifie si le cookie "sid" existe et n'est pas vide
if (isset($_COOKIE["sid"]) AND !empty($_COOKIE["sid"])) {
    //on compare le 'sid ' recuperer a celui de la base de donnée
    $select_sid = "SELECT sid, nom, prenom FROM utilisateur WHERE sid = :sid ";
    $sth_sid = $bdd->prepare($select_sid);
    $sth_sid->bindValue(':sid', $_COOKIE["sid"], PDO::PARAM_STR);
    $sth_sid->execute();
    $identite = $sth_sid->fetch(PDO::FETCH_ASSOC);
   
        //fonction pour compter 
        $count = $sth_sid->rowCount();
     
        
        if ($count > 0) { // si le nombre est plus que 0
            
            $is_connect = TRUE;  // on assigne TRUE a is_connect
            $nom = $identite['nom'];
            $prenom = $identite['prenom'];
               
               
            
        } else {
            
        }
    } else {
        $notification = "erreur lors de l'execution de la requete"; // sinon on envoie une noif pour dire qu'il y a une erreur 
    } 

?>
