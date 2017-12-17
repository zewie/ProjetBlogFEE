<?php
/* @var $bdd PDO */
require_once('config/bdd.conf.php');
require_once('config/init.conf.php');
include('include/header.inc.php');        


$sql= "SELECT id, titre, texte, DATE_FORMAT(date, '%d/%m/%Y') as date_fr
FROM articles
WHERE (titre LIKE :recherche or texte LIKE :recherche) 
AND publie=1 
ORDER BY date DESC LIMIT :debut, :nb_articles_par_page";

$sth = $bdd->prepare($sql);
$sth->bindValue(':recherche', '%'.$recherche.'%', PDO::PARAM_STR);
$sth->bindValue(':debut', $index, PDO::PARAM_INT);
$sth->bindValue(':nb_articles_par_page', $nb_articles_par_page, PDO::PARAM_INT);
$sth->execute();
if ($sth->execute() == TRUE) {
    $tab_recherche = $sth->fetchAll(PDO::FETCH_ASSOC);
   
} else {
    echo "Une erreur est apparu";
}
?>



<div class="container">
 
    
</div>



<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/popper/popper.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<?php
include ('include/footer.inc.php');
?>