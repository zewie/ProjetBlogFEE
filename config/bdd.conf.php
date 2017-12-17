<?php
try
{
/* @var $bdd PDO */
$bdd = new PDO('mysql:host=localhost;dbname=blogtp;charset=utf8', 'root', 'root'); // connection a la BDD( en local ) 
$bdd->exec("set names utf8");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
die('Erreur : ' . $e->getMessage());// si la connection ne fonctionne pas on coupe 
}
?>

