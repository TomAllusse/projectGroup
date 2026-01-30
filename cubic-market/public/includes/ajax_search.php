<?php

/* Import */
spl_autoload_register(function ($class) {
    // On remplace les \ du namespace par des / pour le chemin
    $class = str_replace('\\', '/', $class);
    
    // On définit le chemin vers le dossier racine (cubic-market)
    // Depuis public/includes, il faut remonter de deux niveaux
    $file = __DIR__ . '/../../' . $class . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
require_once '../../config/db.php';

use src\Managers\BoutiqueManager;

$q = isset($_GET['q']) ? $_GET['q'] : '';

$manager = new BoutiqueManager($db);
$dataProduct = $manager->getAllSearch($q);
$nb = 0;

foreach($dataProduct as $aProduct) {
    ?>
        <div class="aProduct">
            <img src="<?php echo htmlspecialchars($aProduct->getImage()); ?>" alt="<?php echo htmlspecialchars($aProduct->getDesc()); ?>">
            <div class="ligne">
                <h1 class="nameProduct"><?php echo htmlspecialchars($aProduct->getNom()); ?></h1>
                <p class="priceProduct"><?php echo urlencode($aProduct->getPrix()); ?> €</p>
            </div>
            <a href="product.php?idProduct=<?php echo urlencode($aProduct->getId()); ?>">Details</a>
        </div>
    <?php
    $nb = 1;
}

if (empty($dataProduct) || $nb === 0) {
    echo '<p class="message-promotion-container">Aucun produit trouvé...</p>';
    exit;
}

?>
