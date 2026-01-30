<?php
    session_start(); 
    $oAdmin = isset($_SESSION['ROLE_ADMIN']) ? unserialize($_SESSION['ROLE_ADMIN']) : null;
    $oUser  = isset($_SESSION['ROLE_USER'])  ? unserialize($_SESSION['ROLE_USER'])  : null;

    if($oAdmin === NULL && $oUser === NULL)
    {
        header('location:index.php');
        exit;
    } 

    /* Import */
    require_once 'includes/autoloader.php';
    require_once '../config/db.php';
    
    use src\Managers\BoutiqueManager;

    use src\Entities\Produit;
    use src\Entities\Arme;
    use src\Entities\Armure;
    use src\Entities\Grade;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boutique</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/styleShop.css">
    <link href="https://fonts.googleapis.com/css2?family=Alice&display=swap" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <nav>
        <ul class="list-nav">
            <li class="item-nav"><a href="index.php" class="link-nav">Connexion / Deconnexion</a></li>
            <li class="item-nav"><a href="boutique.php" class="link-nav">Boutique</a></li>
            <li class="item-nav"><a href="formAddProduct.php" class="link-nav">Formulaire</a></li>
        </ul>
        <div class="btn-toggle-container" role="button">
            <img src="src/svg/hamburger.svg" class="inactive" alt="icon menu hamburger">
            <img src="src/svg/hamburger.svg" class="active" alt="icon menu hamburger">
        </div>
    </nav>
    <!-- FILTER / RESEARCH -->
    <div class="shopBoxSearch">
        <input type="search" name="q" id="shopSearch" placeholder="Rechercher sur le site…">
    </div>
    <!-- CLOTHING -->
    <div class="cloth">
        <?php
            $manager = new BoutiqueManager($db);
            $dataAll = $manager->getAll();

            foreach($dataAll as $aProduct){
                ?>
                    <div class="aCloth">
                        <img src="<?php echo htmlspecialchars($aProduct->getImage()); ?>" alt="<?php echo htmlspecialchars($aProduct->getDesc()); ?>">
                        <div class="ligne">
                            <h1 class="nameProduct"><?php echo htmlspecialchars($aProduct->getNom()); ?></h1>
                            <p class="priceProduct"><?php echo urlencode($aProduct->getPrix()); ?> €</p>
                        </div>
                        <a href="product.php?idProduct=<?php echo urlencode($aProduct->getId()); ?>">Details</a>
                    </div>
                <?php
            }
        ?>
    </div>
    <!-- FOOTER -->
    <footer>
        © 2025 cubic market. Tous droits réservés.
    </footer>
    <script src="src/js/app.js"></script>
    <script src="src/js/appSearch.js"></script>
</body>
</html>