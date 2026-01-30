<?php

$q = isset($_GET['q']) ? $_GET['q'] : '';
$p = isset($_GET['p']) ? $_GET['p'] : '';

// On appelle une méthode de recherche (à créer dans ta classe)
if($p === "listProduct"){
    $dataProduct = Cproducts::getSearchProducts($q);
}else if($p === "listPromotion" || $p === "addPromotion"){
    $dataProduct = Cproducts::getSearchTitlePromotionProducts($q);
}
$nb = 0;

foreach($dataProduct as $aProduct) {
    if($p === "listProduct"){
    ?>
        <div id="productDiv">
            <?php
                        
                echo '  <div class="nameProduct">
                            <h2 class="titleProduct">'.htmlspecialchars($aProduct['nameProduct']).'</h2>
                        </div>
                            <div class="detailsProduct">
                                <a href="detailsProduct.php?idProduct='.urlencode($aProduct['idProduct']).'" class="btn-details-product">Details</a>
                            </div>';
            ?>
        </div>
    <?php
    $nb = 1;
    }else if($p === "listPromotion"){
        if(urlencode($aProduct['discount']) !=null){
    ?>
            <div id="productDiv">
                <div class="nameProduct">
                    <?php
                        echo '  <h2 id="nameProduct">'.htmlspecialchars($aProduct['nameProduct']).'</h2>';
                    ?>
                </div>
                <div class="promotionProduct">
                    <input type="number" name="promotionProduct" id="promotionProduct" class="promotionProductInp" min="0" placeholder="<?php echo urlencode($aProduct['discount']) ?> %" readonly>
                </div>
                <div class="btn-promotion-container" role="button">
                    <img src="src/svg/add/cross.svg" alt="bouton delete" id="delete-promotion"  class="<?php echo 'idProduct'.urlencode($aProduct['idProduct']).' idPromotion'.urlencode($aProduct['idPromotion']); ?>" >
                </div>
            </div>
        <?php
            $nb ++;
        }
    }else if($p === "addPromotion"){
        if(urlencode($aProduct['discount']) == null){
    ?>
            <div id="productDiv">
                <div class="nameProduct">
                    <?php
                        echo '  <h2 id="nameProduct">'.htmlspecialchars($aProduct['nameProduct']).'</h2>';
                    ?>
                </div>
                <div class="promotionProduct">
                    <input type="number" name="promotionProduct" id="promotionProduct<?php echo urlencode($aProduct['idProduct']) ?>" class="promotionProductInp" min="0" placeholder="0%">
                </div>
                <div class="btn-promotion-container" role="button">
                    <img src="src/svg/add/valid.svg" alt="bouton valider" id="validate-promotion" class="<?php echo urlencode($aProduct['idProduct']); ?>" >
                </div>
            </div>
            <?php
            $nb ++;
        }
    }
}

if (empty($dataProduct) || $nb === 0) {
    echo '<p class="message-promotion-container">Aucun produit trouvé...</p>';
    exit;
}