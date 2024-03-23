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
    <?php echo head2("edit") ?>
</head>
<body class="fcc">
    <div class="body fcc">
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM recolte,ruche WHERE id_a=$ident AND id_re=$id GROUP BY id_re";
    $recoltes = ($dbh->query($sql)->fetch());?>
    <form method="POST" action="" class="editrec">
        <input type="number" name="id" value="<?php echo $recoltes['id_re']?>" class="hide"></input>
        <p>Date de récolte :</p>
        <input type ="texte" name='date_re' value="<?php echo $recoltes['date_re']; ?>" class="milieu"></input>
        <p> Quantité récoltée :</p>
        <input type ="texte" name='quantite_re' value="<?php echo $recoltes['quantite_re']; ?>"class="milieu"></input>
        <p> Nombre de hausse :</p>
        <input type ="texte" name='nb_hausses_re' value="<?php echo $recoltes['nb_hausses_re']; ?>"class="milieu"></input>
        <div class="encadre">
            <button > MODIFIER </button>
            <a href="../beetrav.php"> ANNULER </a>
        </div>
    </form>
    <?php } 
    else{
            $id=$_POST['id'];
            $date_re=$_POST['date_re'];
            $quantite_re=$_POST['quantite_re'];
            $nb_hausses_re=$_POST['nb_hausses_re'];

            $errors = [];
            if (strlen($date_re) === 0) {
                $errors[] = 'Le date ne doit pas être vide';
            }
            if ($quantite_re < 0) {
                $errors[] = 'La quantite ne doit pas être vide';
            }
            if ($nb_hausses_re < 0) {
                $errors[] = 'Le date de quantite_re est trop grands';
            }
            if ($date_re && !validateDate($date_re)) {
                $errors[] = 'le format de la date est incorrect.';
            }
            if(empty($errors)){
            $sqlv4 = "UPDATE recolte 
                    SET id_re=:id, date_re=:date_re, quantite_re=:quantite_re, nb_hausses_re=:nb_hausses_re
                    WHERE id_re=:id";
            $stmt = $dbh->prepare($sqlv4);
            $stmt->execute(
                compact('id','date_re','quantite_re','nb_hausses_re')
            );
            header('Location: ./../beetrav.php');
            }
            else{ ?>
                <p>Des données sont <span>incorrectes</span> :</p>
            <ul>
                <?php foreach ($errors as $error) {?>
                    <li><?php echo $error ?></li>
                <?php }?>
            </ul>
            <?php }?>
            <a href="edit.php?id=<?php echo $id ?>">retour vers le formulaire</a>
            <?php }?>
    </div>
</body>
</html>