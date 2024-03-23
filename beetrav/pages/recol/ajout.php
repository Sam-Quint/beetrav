<?php
require './../../bootstrap.php';
session_start();
$idru=(int)$_POST['idru'];
$dates=$_POST['date'];
$quantite=(int)$_POST['quantite'];
$nb_hausses=(int)$_POST['nb_hausses'];
$valide=true;
$_SESSION['errors']=null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if (strlen($dates) === 0) {
        $valide = false;
    }
    if ($quantite < 0) {
        $valide = false;
    }
    if ($nb_hausses > 200) {
        $valide = false;
    }
    if ($nb_hausses < 0) {
        $valide = false;
    }
    if ($nb_hausses > 200) {
        $valide = false;
    }
    if ($dates && !validateDate($dates)) {
        $valide = false;
    }
    if($valide===true){ 
        $sqlv4 = "INSERT INTO `recolte` (`date_re`, `quantite_re`, `nb_hausses_re`, `id_ru`) 
        VALUES  (:dates, :quantite, :nb_hausses, :idru)";
            $stmt = $dbh->prepare($sqlv4);
            $stmt->execute(compact('dates','quantite','nb_hausses','idru'));
            header('Location: ../beetrav.php');
    }
    else {
        $_SESSION['errors']="La ruche n'a pas pu être ajouté, un champ est incorrecte";
        header('Location: ../beetrav.php');
    }
}    
?>