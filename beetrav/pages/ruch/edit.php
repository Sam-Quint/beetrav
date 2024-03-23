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
<html lang="en">
<head>
    <?php echo head2("edit") ?>
</head>
<body class="fcc">
    <div class="body fcc">
    <?php 
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = (int)$_GET['id'];
    $sql = "SELECT * FROM ruche WHERE id_a=$ident AND id_ru=$id GROUP BY id_ru  ";
    $ruches = ($dbh->query($sql)->fetch());?>
    <form method="POST" action="" class="edit">
        <input type="number" name="id" value="<?php echo $ruches['id_ru']?>" class="hide"></input>
        <p>Nom:</p>
        <input type ="texte" name='nom' value="<?php echo $ruches['nom_ru']; ?>" class="milieu"></input>
        <p> Date d'installation</p>
        <input type ="date" name='date_instal' value="<?php echo $ruches['date_installation_ru']; ?>"class="milieu"></input>
        <p> latitude :</p>
        <input type ="texte" name='latitude' value="<?php echo $ruches['latitude_ru']; ?>"class="milieu"></input>
        <p> longitude :</p>
        <input type ="texte" name='longitude' value="<?php echo $ruches['longitude_ru']; ?>"class="milieu"></input>
        <div class="encadre"    >
            <button > MODIFIER </button>
            <a href="../beetrav.php"> Annuler </a>
        </div>
    </form>
    <?php } 
    else{
            $id=$_POST['id'];
            $nom=$_POST['nom'];
            $date_instal=$_POST['date_instal'];
            $latitude=$_POST['latitude'];
            $longitude=$_POST['longitude'];

            $errors = [];
            if (strlen($nom) === 0) {
                $errors[] = 'Le nom ne doit pas être vide';
            }
            if (strlen($date_instal) === 0) {
                $errors[] = "La date d'installation ne doit pas être vide";
            }
            if (strlen($latitude) === 0) {
                $errors[] = 'La latitude ne doit pas être vide';
            }
            if (strlen($longitude) > 50) {
                $errors[] = 'Le nom de latitude est trop grands';
            }
            if (strlen($longitude) === 0) {
                $errors[] = 'La longitude ne doit pas être vide';
            }
            if (strlen($longitude) > 50) {
                $errors[] = 'nom de longitude incorrect';
            }
            if ($date_instal && !validateDate($date_instal)) {
                $errors[] = 'le format de la date est incorrect.';
            }
            if(empty($errors)){
            $sqlv4 = "UPDATE ruche 
                    SET id_ru=:id, nom_ru=:nom, date_installation_ru=:date_instal, latitude_ru=:latitude, longitude_ru=:longitude
                    WHERE ruche.id_ru= :id";
            $stmt = $dbh->prepare($sqlv4);
            $stmt->execute([
                'id'=>$id,
                'nom'=>$nom,
                'date_instal'=>$date_instal,
                'latitude'=>$latitude,
                'longitude'=>$longitude,
            ]);
            header('Location: ../beetrav.php');
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