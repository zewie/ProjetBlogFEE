<?php

/* @var $bdd PDO */
session_start();
require_once('include/notification.inc.php');
require_once('config/bdd.conf.php');
require_once('config/init.conf.php');
require_once('config/connexion.inc.php');
require_once('include/function.inc.php');
//Class smarty
require_once('libs/Smarty.class.php');


$tab_articles_recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';  // on determine si elle est different de nul et si elle est definie 
$tab_articles_recherche = isset($_GET['is_connect']) ? $_GET['is_connect'] : '';
$nb_articles_par_page = 2;
$page_courante = isset($_GET['page']) ? $_GET['page'] : 1;

$index = pagination($page_courante, $nb_articles_par_page);

$nb_total_article_publie = nb_total_article_publie($bdd);


$nb_pages = ceil($nb_total_article_publie / $nb_articles_par_page);  // on compare 



$sql = "SELECT id, "
        . "titre, "
        . "texte, "
        . "DATE_FORMAT (date, '%d/%m/%Y') as date_fr "
        . "FROM articles "
        . "WHERE publie = :publie "
        . "LIMIT :index , :nb_articles_par_page ; ";  // requete SQL 

$sth = $bdd->prepare($sql);
$sth->bindValue(':publie', 1, PDO::PARAM_BOOL);
$sth->bindValue(':index', $index, PDO::PARAM_INT);
$sth->bindValue(':nb_articles_par_page', $nb_articles_par_page, PDO::PARAM_INT);
$sth->execute();
if ($sth->execute() == TRUE) {
    $tab_articles = $sth->fetchAll(PDO::FETCH_ASSOC);
    
   
} else {
    echo "Une erreur est apparu";
}



if (isset($_GET['recherche'])) { // on verifie que recherche n'est pas null 
  
    $sql = "SELECT id, "
            . "titre, "
            . "texte, "
            . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
            . "FROM articles "
            . "WHERE (titre LIKE :recherche OR texte LIKE :recherche) "
            . "AND publie=1 "
            . "ORDER BY date DESC "
            . "LIMIT :debut, :message_par_page";  // requete SQL de recherche 

    /* @var $bdd PDO */
    $std = $bdd->prepare($sql);
    $std->bindValue(':recherche', '%' . $_GET['recherche'] . '%', PDO::PARAM_STR);
    $std->bindValue(':publie', 1, PDO::PARAM_BOOL);
    $std->bindValue(':debut', $index, PDO::PARAM_INT);
    $std->bindValue(':message_par_page', $nb_articles_par_page, PDO::PARAM_INT);



    if ($std->execute() == TRUE) { // on execute 
        $tab_articles_recherche = $std->fetchAll(PDO::FETCH_ASSOC);
        
        
        
    } else {
        echo "Une erreur est survenue.. ";
    }
}









$smarty = new Smarty();

$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

$smarty->assign('is_connect', $is_connect);
$smarty->assign('session', $_SESSION);
$smarty->assign('nb_pages', $nb_pages);
$smarty->assign('page_courante', $page_courante);
$smarty->assign('tab_articles', $tab_articles);
$smarty->assign('tab_articles_recherche', $tab_articles_recherche);
$smarty->assign('get', $_GET);



if (isset($_GET['recherche'])) {
    
    $sql = "SELECT id, "
            . "titre, "
            . "texte, "
            . "DATE_FORMAT(date, '%d/%m/%Y') as date_fr "
            . "FROM articles "
            . "WHERE (titre LIKE :recherche OR texte LIKE :recherche) "
            . "AND publie=1 "
            . "ORDER BY date DESC "
            . "LIMIT :debut, :message_par_page";

    /* @var $bdd PDO */
    $std = $bdd->prepare($sql);
    $std->bindValue(':recherche', '%' . $_GET['recherche'] . '%', PDO::PARAM_STR);
    $std->bindValue(':publie', 1, PDO::PARAM_BOOL);
    $std->bindValue(':debut', $index, PDO::PARAM_INT);
    $std->bindValue(':message_par_page', $nb_articles_par_page, PDO::PARAM_INT);



    if ($std->execute() == TRUE) {
        $tab_articles_recherche = $std->fetchAll(PDO::FETCH_ASSOC);
      
         
        
        
    } else {
        echo "Une erreur est survenue.. ";
    }
}


if (isset($_SESSION['notification_connexion'])) {
    $connexion_result = $_SESSION['connexion_result'] == TRUE ? 'success' : 'danger';

    $smarty->assign('connexion_result', $connexion_result);

    unset($_SESSION['notification_connexion']);
    unset($_SESSION['connexion_result']);
}

//** un-comment the following line to show the debug console


include('include/header.inc.php');
$smarty->display('index.tpl');
include ('include/footer.inc.php');
?>