<?php 
require './../../bootstrap.php';
?>
 <link rel="stylesheet" href="./../../assets/css/style.css">
<?php
$tim=date('Y-m-d');
$pass=true;
session_start();
$ident=$_SESSION['id_a'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php echo head("suppresion") ?>
</head>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_ru = (int)$_GET['id'];
    $sqlv2 = "DELETE FROM ruche WHERE id_ru=:id_ru";
    $stmt = $dbh->prepare($sqlv2);
    $stmt->execute(compact('id_ru'));
    header('Location: ./../beetrav.php');
     };
?>