<?php 
require './../../bootstrap.php';
$tim=date('Y-m-d');
$pass=true;
session_start();
$ident=$_SESSION['id_a'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php echo head2("suppresion") ?>
</head>
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id_re = (int)$_GET['id'];
    $sqlv2 = "DELETE FROM recolte WHERE id_re=:id_re";
    $stmt = $dbh->prepare($sqlv2);
    $stmt->execute(compact('id_re'));
    header('Location: ../beetrav.php');
    };
?>