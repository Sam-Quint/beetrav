<?php 
require '../bootstrap.php';
session_start();
$ident=$_SESSION['id_a'];
$sqlv27="SELECT acess from apiculteur where id_a=:ident";
$stmt = $dbh->prepare($sqlv27);
$stmt->execute(compact('ident'));
$acess = $stmt->fetch();
if($acess['acess']==1){
    $sqlv28="UPDATE apiculteur SET acess=0 WHERE id_a = :ident;";
    $acess1=$dbh->prepare($sqlv28);
    $acess1->execute(compact('ident'));
}
if($acess['acess']==0){
    $sqlv29="UPDATE apiculteur SET acess=1 WHERE id_a = :ident;";
    $acess2=$dbh->prepare($sqlv29);
    $acess2->execute(compact('ident'));
}
header('Location: ./beetrav.php');
?>