<?php
require './../bootstrap.php';
$sql = "SELECT * FROM apiculteur, recolte, ruche";
session_start();
?>


<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./../assets/css/styleacceuil.css">
  <title>Connexion</title>
</head>
<script type="text/javascript" src="../assets/js/script.js"></script>

<body>
    <header>
        <h1>Beetrav</h1>

    </header>

    <?php
    // Si des données ont été soumises, traiter les données
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lire les données
        $pseudo_a = trim($_POST['pseudo_a']);
        $mdp_a = md5($_POST['mdp_a']);

        // Tester la cohérence des données en PHP
        $ERRORS = [];
        /*
        if (empty($pseudo_a)) {
            $ERRORS['pseudovide'] = 'Veuillez saisir un pseudonyme';
        }

        if (empty($mdp_a)) {
            $ERRORS['mdpvide'] = 'Veuillez saisir un mot de passe';
        }

        if (strlen($pseudo_a) > 50) {
            $ERRORS['pseudolimit'] = 'Veuillez saisir un pseudonyme inférieur à 50 caractères';
        }

        if (strlen($mdp_a) > 50) {
            $ERRORS['mdplimit'] = 'Veuillez saisir un mot de passe inférieur à 50 caractères';
        }
*/
        if (empty($ERRORS)) {
            try {
                $sqlv2 = "SELECT * FROM apiculteur WHERE pseudo_a = :pseudo_a AND mdp_a = :mdp_a ";
                $stmt = $dbh->prepare($sqlv2);

                $stmt->bindParam(':pseudo_a', $pseudo_a);
                $stmt->bindParam(':mdp_a', $mdp_a);

                $stmt->execute();
                $user = $stmt->fetch();

                if ($user) {
                    // Mettre en place les variables de SESSION
                    $_SESSION['pseudo_a'] = $pseudo_a;
                    $_SESSION['mdp_a'] = $mdp_a;
                    $_SESSION['id_a'] = $user['id_a'];
                    header('Location: beetrav.php');
                    exit();
                } else {
                    $ERRORS['auth'] = '<p>Identifiant ou mot de passe incorrect</p>';
                }
            } catch (Exception $e) {
                echo 'Oups, un problème est survenu : ' . $e->getMessage();
            }
        }

        if (!empty($ERRORS)) {
            $_SESSION['errors'] = $ERRORS;
            header('Location: index.php');
            echo $ERRORS;
            exit();
        }
    }
    ?>

    <form class="fcc" action="./index.php" method="POST">
        <h1>Connexion</h1>

        <?php
        if (isset($_SESSION['errors'])) {
            $errors = $_SESSION['errors'];
            foreach ($errors as $error) {
                echo '<div>' . $error . '</div>';
            }
            unset($_SESSION['errors']);
        }
        ?>
        <label>Identifiant</label>
        <input class="shadow" name="pseudo_a" type="text" maxlength="50" required placeholder="Nom d'utilisateur">
        <label>Mot de passe</label>
        <input class="shadow" name="mdp_a" type="password" maxlenght="50" required placeholder="Mot de passe">
        <button type="submit" class="shadow">Connexion</button>
        <h5>Mot de passe oublié</h5>

    </form>
    <footer>
        <!-- <div>
        <img src="../assets/image/svg/honey-2-svgrepo-com.svg" alt="HONEY">
        <p>Mes récoltes</p>
        </div>
        <div>
        <img src="../assets/image/svg/beehive-honey-svgrepo-com (1).svg" alt="HONEY">
        <p>Mes ruches</p>
        </div>
        <div>
        <img src="../assets/image/svg/settings-future-svgrepo-com.svg" alt="HONEY">
        <p>Paramètres</p>
        </div> -->

        <p>Mention légales</p>
        <p>© Beetrav 2023</p>
        <p class="modeacces">Mode accessible</p>
        <script>
            // Sélection de la balise
            var balise = document.querySelector('.modeacces');

            // Ajout de l'événement au clic sur la balise
            balise.addEventListener('click', function() {
                // Sélection de tous les éléments de la page
                var elements = document.querySelectorAll('*');

                // Changement de la police pour chaque élément, en excluant <h1>Beetrav</h1>
                for (var i = 0; i < elements.length; i++) {
                    if (elements[i].tagName !== 'H1' || elements[i].textContent !== 'Beetrav') {
                        elements[i].style.fontFamily = 'Helvetica, Arial, sans-serif';
                    }
                }
            });
        </script>

    </footer>

</body>

</html>