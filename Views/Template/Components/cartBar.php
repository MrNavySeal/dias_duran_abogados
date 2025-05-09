<?php
    $qtyCart = 0;
    $total = 0;
    $arrProducts = array();
    if(isset($_SESSION['arrCart']) && !empty($_SESSION['arrCart'])){
        $arrProducts = $_SESSION['arrCart'];
        foreach ($arrProducts as $product) {
            $qtyCart += $product['qty'];
            $total+=$product['price']*$product['qty']; 
        }
    }
?>
<div class="cartbar">
    <div class="cartbar--mask"></div>
    <div class="cartbar--elements">
        <div class="cartbar--header">
            <div class="cartbar--title">
                Mi carrito <span id="qtyCartbar"><?=$qtyCart?></span>
            </div>
            <span id="closeCart"><i class="fas fa-times"></i></span>
        </div>
        <div class="cartbar--inner">
            <ul class="cartlist--items"></ul>
        </div>
        <div class="cartbar--info">
            <div class="info--total">
                <span>Total</span>
                <span id="totalCart"><?=formatNum($total)?></span>
            </div>
            <div id="btnsCartBar" class="d-none">
                <a href="<?=base_url()?>/carrito" class="btn btn-bg-2 d-block w-100 mb-3"> Ver carrito</a>
                <button type="button" class="btn d-block btn-bg-1 btnCheckoutCart w-100"> Pagar</a>
            </div>
        </div>
    </div>
</div>