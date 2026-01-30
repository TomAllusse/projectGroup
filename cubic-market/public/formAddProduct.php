<!DOCTYPE html>
<?php 
    session_start(); 
    $oAdmin = isset($_SESSION['ROLE_ADMIN']) ? unserialize($_SESSION['ROLE_ADMIN']) : null;

    if($oAdmin === NULL)
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

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['desc']) && isset($_POST['price']) && isset($_FILES['addProduct']) && $_FILES['addProduct']['error'] === UPLOAD_ERR_OK && isset($_POST['host']))
    {
        $uploadDir = 'src/uploads/';

        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        // Récupérer l'extension d'origine
        $extension = strtolower(pathinfo($_FILES['addProduct']['name'], PATHINFO_EXTENSION));

        // Nom final : defaultLogo + extension du fichier source
        $tempPath = $uploadDir . 'temp.png';

        $manager = new BoutiqueManager($db);
        $produit = new Produit();
        $produit->setNom($_POST['name']);
        $produit->setDesc($_POST['desc']);
        $produit->setPrix($_POST['price']);
        $produit->setImage($tempPath);

        $lastId = $manager->add($produit, null);
        $produit->setId($lastId);
        
        switch (htmlspecialchars($_POST['host'])) {
            case 'grade':
                $grade = new Grade();
                $grade->setDuree($_POST['duree']);
                $lastId = $manager->add($grade, $lastId);
                $grade->setId($lastId);
                break;
            case 'arme':
                $arme = new Arme();
                $arme->setDegat($_POST['degat']);
                $arme->setDurabilite($_POST['durabilite']);
                $lastId = $manager->add($arme, $lastId);
                $arme->setId($lastId);
                break;
            case 'armure':
                $armure = new Armure();
                $armure->setprotection($_POST['protection']);
                $armure->setDurabilite($_POST['durabilite']);
                $lastId = $manager->add($armure, $lastId);
                $armure->setId($lastId);
                break;
        }

        $targetPath = $uploadDir . 'product'. $lastId . '.' . $extension;
        $produit->setImage($targetPath);

        $tmpName = $_FILES['addProduct']['tmp_name'];
    
        if (move_uploaded_file($tmpName, $targetPath)) {
            $manager->update($produit);
            echo 'Upload réussi !';
            header('location:formAddProduct.php?success=1');
            exit;
        } else {
            echo 'Erreur lors de la sauvegarde du fichier.';
            header('location:formAddProduct.php?error=1');
            exit;
        }
    }    
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout de produit</title>
    <link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/styleAddProduct.css">
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
    <!-- DIV "ADD PRODUCT" -->
    <div class="productContainer">
        <div class="productBoxForm">
            <h1 class="productTitleForm">Produit</h1>
            <form class="productForm" enctype="multipart/form-data" method="post"  action="">
                <div>
                    <label for="name" class="labelName">nom</label>
                    <input type="text" name="name" id="name" required class="nameInp" placeholder="Entrez le nom du produit">
                </div>
                <div>
                    <label for="desc" class="labelDesc">description</label>
                    <textarea name="desc" id="desc" required></textarea>
                </div>
                <div>
                    <label for="price" class="labelPrice">Prix</label>
                    <input type="text" name="price" id="price" required class="priceInp" placeholder="Entrez le prix du produit">
                </div>
                <div class="checkbox">
                    <input type="radio" name="host" value="grade" checked /> GRADE
                    <input type="radio" name="host" value="arme" /> ARME
                    <input type="radio" name="host" value="armure" /> ARMURE
                </div>
                <div id="content-grade" class="toggle-content">
                    <label for="duree" class="labelDuree">Durée</label>
                    <input type="text" name="duree" id="duree" class="dureeInp" placeholder="Entrez la durée du grade" required>
                </div>
                <div id="content-arme" class="toggle-content" style="display:none;">
                    <label for="degat" class="labelDegat">Dégat</label>
                    <input type="text" name="degat" id="degat" class="degatInp" placeholder="Entrez les dégats de l'arme">
                    <label for="durabilite_arme" class="labelDurabilite">Durabilité</label>
                    <input type="text" name="durabilite" id="durabilite_arme" class="durabiliteInp" placeholder="Entrez la durabilité de l'arme">
                </div>
                <div id="content-armure" class="toggle-content" style="display:none;">
                    <label for="protection" class="labelProtection">Protection</label>
                    <input type="text" name="protection" id="protection" class="protectionInp" placeholder="Entrez la protection de l'armure">
                    <label for="durabilite_armure" class="labelDurabilite">Durabilité</label>
                    <input type="text" name="durabilite" id="durabilite_armure" class="durabiliteInp" placeholder="Entrez la durabilité de l'armure">
                </div>
                <div class="addAndDisplayProduct">
                    <div class="addProduct">
                        <h2 class="TitlePicture">Image</h2>
                        <div class="container-file-upload-product">
                            <label class="custom-file-upload">
                                <img src="src/svg/imgAdd.svg" alt="logo add image in the site">
                                <span>Ajouter le fichier de l'image du produit </span>
                                <input type="file" accept="image/*" name="addProduct" id="addPicture" class="addProduct2" required>
                            </label>
                        </div>
                        <div class="container-desc-product">
                            <label for="descImgProduct1" class="visually-hidden">Description caché utiliser pour le lecteur d'écran</label>
                            <textarea name="descImgProduct1" id="descImgProduct1" class="descImgProductInp" placeholder="Donner une petite description pour les personnes qui utilise le narateur google (lecteur d'écran utilisé par les personnes malvoyantes ...)" rows="2" required></textarea>
                        </div>
                    </div>
                    <div class="displayProduct">
                        <img src="src/uploads/choiceProduct.png?rand=<?php echo time(); ?>" alt="add product image" id="displayImg1">
                    </div>
                </div>
                <button type="submit" class="sendProduct">Envoyer</button>
                <div class="message-validate-product"></div><!--Ajout du produit effectué-->
            </form>
        </div>
    </div>
    <!-- FOOTER -->
    <footer>
        © 2025 cubic market. Tous droits réservés.
    </footer>
    <script src="src/js/app.js"></script>
</body>
</html>