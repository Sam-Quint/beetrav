<?php 
require "../bootstrap.php";
if(isGetMethod()==true){
    $years=date('Y');
    $id_ru=$_GET['id'];
}
if(isPostMethod()==true){
    $errors=null;
    $years=$_POST['annee'];
    if(strlen($years) > 4 || strlen($years) < 4){
        $erros="la date doit être 4 chiffre";
    }
    $id_ru=$_POST['id_ru'];
    $years=$_POST['annee'];
}
?>
<script>let ctx; </script>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./../assets/css/stylegraph.css">
  <title>Grahpique</title>
</head>
<?php if(empty($erros)){}
else{echo $erros;}?>
<form method="POST">
        <labels>Rentrez l'année désirée</labels>
        <input name="annee" type="number" min="1900" value="<?php echo $years ?>">
        <input name="id_ru" class="hide" value='<?php echo $id_ru ?>'>
        <button>recherche</button>
</form>
<body>
    <div id="graph1" class="pop">
        <canvas id="myChart1"></canvas>
    </div>
        <?php 
            $sqlv26="SELECT SUM(quantite_re) as sumquantite,MONTH(date_re) as mois, YEAR(date_re) as ans FROM recolte WHERE id_ru=:id_ru AND YEAR(date_re)=:years GROUP BY mois";
            $stf = $dbh->prepare($sqlv26);
            $stf->execute(compact('years','id_ru'));
            $bilans = ($stf->fetchAll());
            if(empty($bilans)){
                echo "<h6> Il n'y a pas de récolte pour cette ruche </h6> </div>";
            }
            else{ ?>
                
                <?php 
            $listeC=array();
            $listeD=array();
            foreach($bilans as $bilan){
                $compt = $getmois[$bilan['mois'] -1];
                $listeC[] = '"'.$compt.'"';
                $listeD[] =$bilan['sumquantite'];
                $years2=$bilan['ans'];
            } ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                ctx = document.querySelector('#myChart1');
                listec = [<?php  echo implode(',', $listeC); ?>];
                listed = [<?php echo implode(',', $listeD); ?>];
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: listec ,
                        datasets: [{
                            label: "récolte de l'année <?php echo $years2 ?>",
                            data: listed,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
          </script>
        <?php } ?>
        <div id="graph2" class="pop">
        <canvas id="myChart2"></canvas>
    </div>
        <?php 
            $sqlv25="SELECT SUM(quantite_re) as sumquantite,MONTH(date_re) as mois FROM recolte WHERE id_ru=:id_ru GROUP BY mois";
            $stf = $dbh->prepare($sqlv25);
            $stf->execute(compact('id_ru'));
            $bils = ($stf->fetchAll());
            if(empty($bils)){
                echo "<h6> Il n'y a pas de récolte pour cette ruche </h6> </div>";
            }
            else{ ?>
                
                <?php 
            $listeC=array();
            $listeD=array();
            foreach($bils as $bil){
                $com = $getmois[$bil['mois'] -1];
                $listeA[] = '"'.$com.'"';
                $listeB[] =$bil['sumquantite'];
            } ?>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                ctx = document.querySelector('#myChart2');
                let listea = [<?php  echo implode(',', $listeA); ?>];
                let listeb = [<?php echo implode(',', $listeB); ?>];
                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: listea ,
                        datasets: [{
                            label: "récolte totale par mois",
                            data: listeb,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
          </script>
        <?php } ?>
    <a href="beetrav.php">retour</a>
<body>