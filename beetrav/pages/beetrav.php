<?php
require './../bootstrap.php';
$dats = null;
$datsup = null;
$reco = null;
$rech = null;
$categ_ru = "nom_ru";
$categ_re = "date_re";
$tim = date('Y-m-d');
$years = date('Y');
session_start();
$ident = $_SESSION['id_a'];
if (empty($_POST['passhide'])) {
    $passhide = 1;
} else {
    $passhide = $_POST['passhide'];
}
if (empty($_POST['ruch'])) {
    $sqlV9 = "SELECT id_ru,nom_ru FROM ruche WHERE id_a=:ident";
    $sti = $dbh->prepare($sqlV9);
    $sti->execute(compact('ident'));
    $ss = $sti->fetch();
    $ruch = $ss['id_ru'];
} else {
    $ruch = $_POST['ruch'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['categ_ru'])) {
        $categ_ru = "nom_ru";
    } else {
        $categ_ru = $_POST['categ_ru'];
    }
    if (empty($_POST['datinf'])) {
        $datinf = $tim;
    } else {
        $datinf = $_POST['datinf'];
    }
    if (empty($_SESSION['categ_re'])) {
        if (empty($_POST['categ_re'])) {
            $categ_re = null;
        } else {
            $categ_re = $_POST['categ_re'];
        }
    } else {
        $categ_re = $_SESSION['categ_re'];
    }
    if (empty($_POST['rech'])) {
        $rech = null;
    } else {
        $rech = $_POST['rech'];
    }
    if (empty($_SESSION['reco'])) {
        if (empty($_POST['reco'])) {
            $reco = null;
        } else {
            $reco = (int)$_POST['reco'];
        }
    } else {
        $reco = (int)$_SESSION['reco'];
    }

    if (empty($_SESSION['dats'])) {
        if (empty($_POST['dats'])) {
            $dats = null;
        } else {
            $dats = $_POST['dats'];
        }
    } else {
        $dats = $_SESSION['dats'];
    }
    if (empty($_POST['datsup'])) {
        $datsup = null;
    } else {
        $datsup = $_POST['datsup'];
    };
};
$pass = true;
$pass2 = true;
if (empty($_SESSION['errors'])) {
    $errors = null;
} else {
    $errors = $_SESSION['errors'];
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php echo head("Beetrave") ?>
</head>

<body class="fcc">
    <script>
        let ctx;
        let listea;
        let listeb;
        let listec;
        let listed;
        let yeahr;
    </script>
    <h1>Beetrav</h1>
    <div class="body">
        <header class="fcc">
            <div class="ruches <?php if ($passhide == 2) {
                                    echo "hide";
                                } ?>">
                <form class="fcc" id="ruches" action="" method="POST">
                    <select name="categ_ru">
                        <?php if ($categ_ru != null) { ?>
                            <option <?php if ($categ_ru == "nom_ru") {
                                        echo "selected" ?> <?php } ?> value="nom_ru"> Nom </option>
                            <option <?php if ($categ_ru == "date_installation_ru") {
                                        echo "selected" ?> <?php } ?>value="date_installation_ru"> Date d'installation </option>
                            <option <?php if ($categ_ru == "latitude_ru") {
                                        echo "selected" ?> <?php } ?>value="latitude_ru"> latitude </option>
                            <option <?php if ($categ_ru == "longitude_ru") {
                                        echo "selected" ?> <?php } ?>value="longitude_ru"> longitude </option>
                        <?php } else { ?>
                            <option value="nom_ru"> Nom </option>
                            <option value="date_installation_ru"> Date d'installation </option>
                            <option value="latitude_ru"> latitude </option>
                            <option value="longitude_ru"> longitude </option>
                        <?php } ?>
                    </select>
                    <div class="hide" id="datdi">
                        <input type="date" name="datinf" value="<?php echo $datinf ?>">
                        <input type="date" name="datsup" value="<?php echo $datsup ?>">
                    </div>
                    <input type="texte" class="show" name="rech" placeholder="recherche" value="<?php echo $rech ?>">
                    <button id="btn">trier</button>
                    <input name="passhide" class="hide" value="1">
                </form>
            </div>
            <div class="recoltes <?php if ($passhide == 1) {
                                        echo "hide";
                                    } ?>">
                <form class="fcc" id="recolte" action="" method="POST">
                    <select name="ruch">
                        <?php $sqlv6 = "SELECT id_ru,nom_ru FROM ruche WHERE id_a=:ident";
                        $stg = $dbh->prepare($sqlv6);
                        $Nrus = $stg->execute(compact('ident'));
                        $Nrus = $stg->fetchAll();
                        foreach ($Nrus as $Nru) { ?>
                            <option <?php if ($ruch == $Nru['id_ru']) {
                                        echo "selected" ?> <?php } ?> value="<?php echo $Nru['id_ru'] ?>"> <?php echo $Nru['nom_ru'] ?> </option>
                        <?php } ?>
                    </select>
                    <select name="categ_re">
                        <?php if ($categ_re != null) { ?>
                            <option <?php if ($categ_re == "date_re") {
                                        echo "selected" ?> <?php } ?> value="date_re"> Date </option>
                            <option <?php if ($categ_re == "quantite_re") {
                                        echo "selected" ?> <?php } ?>value="quantite_re"> Quantité </option>
                            <option <?php if ($categ_re == "nb_hausses_re") {
                                        echo "selected" ?> <?php } ?>value="nb_hausses_re"> Nombre de hausses </option>
                        <?php } else { ?>
                            <option value="nom_re"> Date </option>
                            <option value="quantite_re"> Quantité </option>
                            <option value="nb_hausses_re"> Nombre de hausse </option>
                        <?php } ?>
                    </select>
                    <input type="date" name="dats" value="<?php echo $dats ?>">
                    <input type="number" class="hide" name="reco" value="<?php echo $reco ?>">
                    <button id="btn">trier</button>
                    <?php if (empty($reco)) {
                    } else {
                        $_SESSION['reco'] = $reco;
                    }
                    if (empty($dats)) {
                    } else {
                        $_SESSION['dats'] = $dats;
                    }
                    if (empty($categ_re)) {
                    } else {
                        $_SESSION['categ_re'] = $categ_re;
                    }
                    if (empty($ruch)) {
                    } else {
                        $_SESSION['ruch'] = $ruch;
                    } ?>
                    <input name="passhide" class="hide" value="2">
                </form>
            </div>
        </header>
        <main>
            <div class="tiers ruches <?php if ($passhide == 2) {
                                            echo "hide";
                                        } ?>">
                <div class="catego">
                    <?php
                    if (empty($test) == true) {
                        echo `<h5 class="error"> $errors </h5>`;
                    };
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $rech != null && $categ_ru != "date_installation_ru") {
                        $sql = "SELECT * FROM ruche WHERE $categ_ru=:rech AND id_a=:ident";
                        $sth = $dbh->prepare($sql);
                        $sth->execute(compact('rech', 'ident'));
                        $ruche = ($sth->fetch());
                        if ($ruche == false) { ?>
                            <p class="error"> aucune ruche trouvée </p>
                        <?php } else { ?>
                            <div class="fcc case1">
                                <h4>Nom:</h4>
                                <p> <?php echo $ruche['nom_ru']; ?> </p>
                                <h4> Date d'installation</h4>
                                <p><?php echo $ruche['date_installation_ru']; ?> </p>
                                <h4> latitude :</h4>
                                <p><?php echo $ruche['latitude_ru']; ?> </p>
                                <h4> longitude :</h4>
                                <p><?php echo $ruche['longitude_ru']; ?> </p>
                                <a href="graphique.php?id=<?php echo $ruche['id_ru']?>">STATISTIQUES</a>
                        <div class="encadre">
                            <a href="ruch/edit.php?id=<?php echo $ruche['id_ru'] ?>">EDITER </a>
                            <a href="ruch/suppression.php?id=<?php echo $ruche['id_ru'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
                        </div>
                    <?php
                        }
                        $pass = false;
                    }
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && $datinf != null && $categ_ru == "date_installation_ru") {
                        $sqlv3 = "SELECT * FROM ruche WHERE id_a=:ident AND date_installation_ru BETWEEN :datinf AND :datsup ;";
                        $stmt = $dbh->prepare($sqlv3);
                        $stmt->execute(compact('datinf', 'datsup', 'ident'));
                        $ruches = ($stmt->fetchAll());
                        if ($ruches == false) { ?>
                        <p class="error"> aucune ruche trouvée </p>
                        <?php } else {
                            foreach ($ruches as $index => $ruche) {
                        ?>
                            <div class="fcc case1">
                                <h4>Nom:</h4>
                                <p> <?php echo $ruche['nom_ru']; ?> </p>
                                <h4> Date d'installation</h4>
                                <p><?php echo $ruche['date_installation_ru']; ?> </p>
                                <h4> latitude :</h4>
                                <p><?php echo $ruche['latitude_ru']; ?> </p>
                                <h4> longitude :</h4>
                                <p><?php echo $ruche['longitude_ru']; ?> </p>
                        <div class="encadre">
                            <a href="ruch/edit.php?id=<?php echo $ruche['id_ru'] ?>">EDITER </a>
                            <a href="ruch/suppression.php?id=<?php echo $ruche['id_ru'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
                        </div>
                </div>
            <?php }
                        }
                        $pass = false;
                    }
                    if ($pass == true) {
                        $sqlv10 = "SELECT * FROM ruche WHERE id_a=:ident GROUP BY id_ru ORDER BY :categ_ru ";
                        $stp = $dbh->prepare($sqlv10);
                        $stp->execute(compact('ident', 'categ_ru'));
                        $ruches = $stp->fetchAll();
                        foreach ($ruches as $index => $ruche) { ?>
            <div class="fcc case1">
                <h4>Nom:</h4>
                <p> <?php echo $ruche['nom_ru']; ?> </p>
                <h4> Date d'installation</h4>
                <p><?php echo $ruche['date_installation_ru']; ?> </p>
                <h4> latitude :</h4>
                <p><?php echo $ruche['latitude_ru']; ?> </p>
                <h4> longitude :</h4>
                <p><?php echo $ruche['longitude_ru']; ?> </p>
                <a href="graphique.php?id=<?php echo $ruche['id_ru']?>">STATISTIQUES</a>
        <div class="encadre">
            <a href="ruch/edit.php?id=<?php echo $ruche['id_ru'] ?>">EDITER </a>
            <a href="ruch/suppression.php?id=<?php echo $ruche['id_ru'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
        </div>
            </div>
    <?php
                        }
                    } ?>
            </div>
            <div class="cadd hide">
                <form method="POST" action="./ruch/ajout.php" id="ajout" class="fcc case2">
                    <p>Nom:</p>
                    <input type="texte" name='nom' class="milieu"></input>
                    <p> Date d'installation</p>
                    <input type="date" name='date_instal' class="milieu"></input>
                    <p> latitude :</p>
                    <input type="texte" name='latitude' class="milieu"></input>
                    <p> longitude :</p>
                    <input type="texte" name='longitude' class="milieu"></input>
                    <div class="encadre">
                        <button id="add"> AJOUTER </button>

                    </div>
                </form>
            </div>
            <button class="btnn" id="btnaddru">
                <p id="plus"> + </p>
                <p id="moins" class="hide">-</p>
            </button>
    </div>
    <div class="tiers recoltes <?php if ($passhide == 1) {
                                    echo "hide";
                                } ?>">
        <div class="catego">
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $reco != null && $categ_re != 'date_re') {
                $sqlv7 = "SELECT * FROM recolte,ruche WHERE $categ_re=:reco AND recolte.id_ru=:ruch AND id_a=:ident ORDER BY $categ_re";
                //$sqlv7 = "SELECT * FROM recolte,ruche WHERE quantite_re=26 AND recolte.id_ru=1 AND id_a=1 ORDER BY quantite_re";
                $stk = $dbh->prepare($sqlv7);
                $stk->execute(compact('reco', 'ident', 'ruch'));
                $Mehs = ($stk->fetchAll());
                if ($Mehs == false) { ?>
                    <p class="error"> Aucune recolte trouvée </p>
                    <?php } else {
                    $gandalph = 0;
                    foreach ($Mehs as $Meh) {
                        if ($gandalph == $Meh['id_re']) {
                        } else { ?>
                            <div class="fcc case1">
                                <h4>Date:</h4>
                                <h4> <?php echo $Meh['date_re']; ?> </h4>
                                <p> Quantité (KG) :</p>
                                <p><?php echo $Meh['quantite_re']; ?> </p>
                                <p> Hausse :</p>
                                <p><?php echo $Meh['nb_hausses_re']; ?> </p>
                                <div class="encadre">
                                    <a href="recol/edit.php?id=<?php echo $Meh['id_re'] ?>">EDITER </a>
                                    <a href="recol/suppression.php?id=<?php echo $Meh['id_re'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
                                </div>
                            </div>
                    <?php $gandalph = $Meh['id_re'];
                        }
                    }
                }
                $pass2 = false;
            }
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && $dats != null && $categ_re == 'date_re') {
                $sqlv11 = "SELECT * FROM recolte,ruche WHERE $categ_re=:dats AND recolte.id_ru=:ruch AND id_a=:ident ORDER BY $categ_re";
                $stk = $dbh->prepare($sqlv11);
                $stk->execute(compact('dats', 'ruch', 'ident'));
                $recol = ($stk->fetch());
                if ($recol == false) { ?>
                    <p class="error"> aucune recolte trouvée </p>
                <?php } else { ?>
                    <div class="fcc case1">
                        <h4>Date :</h4>
                        <h4> <?php echo $recol['date_re']; ?> </h4>
                        <p> Quantité (KG) :</p>
                        <p><?php echo $recol['quantite_re']; ?> </p>
                        <p> Hausse :</p>
                        <p><?php echo $recol['nb_hausses_re']; ?> </p>
                        <a href="graphique.php?id=<?php echo $ruche['id_ru']?>">STATISTIQUES</a>
                        <div class="encadre">
                            <a href="recol/edit.php?id=<?php echo $recol['id_re'] ?>">EDITER </a>
                            <a href="recol/suppression.php?id=<?php echo $recol['id_re'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
                        </div>
                    </div>
                <?php }
                $pass2 = false;
            }
            if ($pass2 == true) {
                $sqlv8 = 'SELECT * FROM recolte,ruche WHERE recolte.id_ru=:ruch AND id_a=:ident GROUP BY id_re ORDER BY :categ_re';
                $stm = $dbh->prepare($sqlv8);
                $stm->execute(compact('categ_re', 'ruch', 'ident'));
                $recoltes = $stm->fetchAll();
                if ($recoltes == false) { ?>
                    <p class="error"> aucune recolte trouvée </p>
                    <?php } else {
                    foreach ($recoltes as $recolte) { ?>
                        <div class="fcc case1">
                            <h4>Date :</h4>
                            <h4> <?php echo $recolte['date_re']; ?> </h4>
                            <p> Quantité (KG) :</p>
                            <p><?php echo $recolte['quantite_re']; ?> </p>
                            <p> Hausse :</p>
                            <p><?php echo $recolte['nb_hausses_re']; ?> </p>
                            <a href="graphique.php?id=<?php echo $ruche['id_ru']?>">STATISTIQUES</a>
                            <div class="encadre">
                                <a href="recol/edit.php?id=<?php echo $recolte['id_re'] ?>">EDITER</a>
                                <a href="recol/suppression.php?id=<?php echo $recolte['id_re'] ?>" class="supp btn btn-link text-danger"> SUPPRIMER</a>
                            </div>
                        </div>
            <?php }
                }
            } ?>
        </div>
        <div class="cadd hide" id="cadd3">
            <form method="POST" action="./recol/ajout.php" id="ajout" class="fcc case2">
                <h4>Ruche :</h4>
                <select name="idru">
                    <?php foreach ($Nrus as $Nru) { ?>
                        <option <?php if ($ruch == $Nru['id_ru']) {
                                    echo "selected" ?> <?php } ?> value="<?php echo $Nru['id_ru'] ?>"> <?php echo $Nru['nom_ru'] ?> </option>
                    <?php } ?>
                </select>
                <p>Date :</p>
                <input type="date" name='date' class="milieu"></input>
                <p> Quantité (KG) :</p>
                <input type="texte" name='quantite' class="milieu"></input>
                <p> Hausse :</p>
                <input type="texte" name='nb_hausses' class="milieu"></input>
                <div class="encadre">
                    <?php if (empty($reco)) {
                    } else {
                        $_SESSION['reco'] = $reco;
                    }
                    if (empty($dats)) {
                    } else {
                        $_SESSION['dats'] = $dats;
                    }
                    if (empty($categ_re)) {
                    } else {
                        $_SESSION['categ_re'] = $categ_re;
                    }
                    if (empty($ruch)) {
                    } else {
                        $_SESSION['ruch'] = $ruch;
                    } ?>
                    <button id="add"> AJOUTER </button>
                </div>

            </form>
        </div>
        <button class="btnn" id="btnaddre">
            <p id="plus3"> + </p>
            <p id="moins3" class="hide">-</p>
        </button>
    </div>
    <div class="parametre fcc hide">
        <p>Mon Compte</p>
        <p>Paramètres avancés</p>
        <a href="acess.php" class="acess btn btn-link text-danger">Mode accessible</a>
        <a href="deconnexion.php">Deconnexion</a>
        <h5>Beetrav © 2023</h5>
        <h5>Tout droit réservé</h5>
    </div>
    </main>
    <footer>
        <div>
            <a id="pruche" selected name="page">
                <div><img src="../assets/image/svg/beehive-honey-svgrepo-com (1).svg" alt="HONEY">
                    <p>Mes ruches</p>
                </div>
            </a>
            <a id="precolte" name="page">
                <div><img src="../assets/image/svg/honey-2-svgrepo-com.svg" alt="HONEY">
                    <p>Mes récoltes</p>
                </div>
            </a>
            <a id="pparametre" name="page">
                <div><img src="../assets/image/svg/settings-future-svgrepo-com.svg" alt="HONEY">
                    <p>Paramètres</p>
                </div>
            </a>
            <div>
    </footer>
    </div>
    <script src="./../assets/js/script.js"></script>
</body>
<script>
    function fermeture() {
        const cls1 = document.querySelector("#cls1<?php echo $compte ?>");
        const pop = document.querySelector("#pop<?php echo $compte ?>");

        if (pop.className == "pop inddown") {
            pop.classList.add("indup");
            pop.classList.remove('inddown');
        } else {
            pop.classList.remove("indup");
            pop.classList.add('inddown');
        }

    };
</script>

</html>
<?php
$sqlv30 = "SELECT acess FROM apiculteur WHERE id_a=:ident";
$tulipe = $dbh->prepare($sqlv30);
$tulipe->execute(compact('ident'));
$acce = $tulipe->fetch();
if ($acce['acess'] == 1) { ?>
    <script>
        const h4 = document.querySelectorAll('h4');
        const p = document.querySelectorAll('p');
        const a = document.querySelectorAll('a');
        const buttton = document.querySelectorAll('button');
        const input = document.querySelectorAll('input');
        const option = document.querySelectorAll('select');
        h4.forEach(par => par.classList.add('modeacces'));
        p.forEach(para => para.classList.add('modeacces'));
        a.forEach(par => par.classList.add('modeacces'));
        buttton.forEach(para => para.classList.add('modeacces'));
        input.forEach(par => par.classList.add('modeacces'));
        option.forEach(para => para.classList.add('modeacces'));
    </script>
<?php } ?>