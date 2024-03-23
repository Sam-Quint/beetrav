<?php
require './../../bootstrap.php';
session_start();
$id_a=$_SESSION['id_a'];
$nom=$_POST['nom'];
$date_instal=$_POST['date_instal'];
$latitude=$_POST['latitude'];
$longitude=$_POST['longitude'];
$latitude=floatval(str_replace(',', '.', $latitude));
$longitude=floatval(str_replace(',', '.', $longitude));
$valide=true;
$_SESSION['errors']=null;
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    if (strlen($nom) === 0) {
        $valide = false;
    }
    if (strlen($date_instal) === 0) {
        $valide = false;
    }
    if (strlen($latitude) <= -200) {
        $valide = false;
    }
    if (strlen($longitude) > 200) {
        $valide = false;
    }
    if (strlen($longitude) <= -200) {
        $valide = false;
    }
    if (strlen($longitude) > 200) {
        $valide = false;
    }
    if ($date_instal && !validateDate($date_instal)) {
        $valide = false;
    }
    if($valide == true){
        var_dump("hello3"); 
        $sqlv4 = "INSERT INTO ruche (`nom_ru`,`date_installation_ru`,`latitude_ru`,`longitude_ru`,`id_a`)
                    VALUES (:nom, :date_instal, :latitude, :longitude, :id_a);";
            $stmt = $dbh->prepare($sqlv4);
            $stmt->execute(compact('nom','date_instal','latitude','longitude','id_a'));
            header('Location: ../beetrav.php');
    }
    else {
        $_SESSION['errors']="La ruche n'a pas pu être ajouté, un champ est incorrecte";
        header('Location: ../beetrav.php');
    }
}    
?>