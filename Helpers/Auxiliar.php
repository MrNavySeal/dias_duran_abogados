<?php
    function getLastPrice($id,$variantName){
        require_once('Models/HelpersModel.php');
        $con = new HelpersModel();
        $arrPurchase = $con->selectPurchaseDet($id,$variantName);
        $arrOrder = $con->selectOrderDet($id,$variantName);
        $arrAdjustment = $con->selectAdjustmentDet($id,$variantName);
        $arrData = [];
        $finalPrice = 0;
        if(!empty($arrPurchase)){
            foreach ($arrPurchase as $arrdata) {
                $arrdata['type_move'] = 1;
                $arrdata['input'] = $arrdata['qty'];
                $arrdata['input_total'] = 0;
                $arrdata['output'] = 0;
                $arrdata['output_total'] = 0;
                $arrdata['balance'] = 0;
                $arrdata['move'] ="Entrada por compra";
                array_push($arrData,$arrdata);
            }
        }
        if(!empty($arrAdjustment)){
            foreach ($arrAdjustment as $arrdata) {
                if($arrdata['type'] == 1){
                    $arrdata['type_move'] = 1;
                    $arrdata['input'] = $arrdata['qty'];
                    $arrdata['input_total'] = 0;
                    $arrdata['output'] = 0;
                    $arrdata['output_total'] = 0;
                    $arrdata['balance'] = 0;
                    $arrdata['move'] ="Entrada por ajuste";
                }else{
                    $arrdata['type_move'] = 2;
                    $arrdata['output'] = $arrdata['qty'];
                    $arrdata['output_total'] = 0;
                    $arrdata['input'] = 0;
                    $arrdata['input_total'] = 0;
                    $arrdata['balance'] = 0;
                    $arrdata['move'] ="Salida por ajuste";
                }
                array_push($arrData,$arrdata);
            }
        }
        if(!empty($arrOrder)){
            foreach ($arrOrder as $arrdata) {
                $arrdata['type_move'] = 2;
                $arrdata['output'] = $arrdata['qty'];
                $arrdata['output_total'] = 0;
                $arrdata['input'] = 0;
                $arrdata['input_total'] = 0;
                $arrdata['balance'] = 0;
                $arrdata['move'] ="Salida por venta";
                array_push($arrData,$arrdata);
            }
        }
        if(!empty($arrData)){
            $total = count($arrData);
            usort($arrData,function($a,$b){
                $date1 = strtotime($a['date']);
                $date2 = strtotime($b['date']);
                return $date1 > $date2;
            });
            for ($i=0; $i < $total; $i++) { 
                $totalCostBalance = 0;
                $price = $arrData[$i]['price'];
                $arrData[$i]['last_price'] = $arrData[$i]['price'];
                if($i == 0){
                    $arrData[$i]['balance'] = $arrData[$i]['input'] - $arrData[$i]['output'];
                    $arrData[$i]['balance_total'] = $arrData[$i]['balance']*$price;
                    $arrData[$i]['output_total'] = $arrData[$i]['output'] * $price;
                }else{
                    $lastRow = $arrData[$i-1];
                    $lastBalance = $lastRow['balance'];
                    $totalBalance = $lastBalance+$arrData[$i]['input']-$arrData[$i]['output'];
                    $totalCostBalance = $lastRow['balance_total'];
                    $arrData[$i]['balance'] = $totalBalance;
                    if($arrData[$i]['type_move'] == 1){
                        $totalCostBalance+=$arrData[$i]['input'] * $arrData[$i]['last_price'];
                        $lastPrice = $totalBalance > 0 ? $totalCostBalance/$totalBalance : 0;
                        $arrData[$i]['last_price'] = $lastPrice;
                        $arrData[$i]['balance_total'] = $arrData[$i]['balance']*$lastPrice;
                    }else{
                        $arrData[$i]['last_price'] =  $lastRow['last_price'];
                        $arrData[$i]['output_total'] = $arrData[$i]['output'] * $lastRow['last_price'];
                        $arrData[$i]['balance_total'] = $arrData[$i]['balance']*$lastRow['last_price'];
                    }
                }
                $finalPrice = $arrData[$i]['last_price'];
            }
        }
        return $finalPrice;
    }
    function getOptionPago(){
        $pago="";
        for ($i=0; $i < count(PAGO) ; $i++) { 
            if(PAGO[$i] != "credito"){
                $pago .='<option value="'.PAGO[$i].'">'.PAGO[$i].'</option>';
            }
        }
        return $pago;
    }
    function getPagination($page,$startPage,$totalPages,$limitPages){
        $htmlPages = '
            <li class="page-item">
                <button type="button" class="page-link text-secondary" href="#" onclick="getData(1)" aria-label="First">
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </button>
            </li>
            <li class="page-item">
                <button type="button" class="page-link text-secondary" href="#" onclick="getData('.max(1, $page-1).')" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </button>
            </li>
        ';
        for ($i = $startPage; $i < $limitPages; $i++) {
            $htmlPages .= '<li class="page-item">
                <button type="button" class="page-link  '.($i == $page ? ' bg-primary text-white' : 'text-secondary').'" href="#" onclick="getData('.$i.')">'.$i.'</button>
            </li>';
        }
        $htmlPages .= '
            <li class="page-item">
                <button type="button" class="page-link text-secondary" href="#" onclick="getData('.min($totalPages, $page+1).')" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </button>
            </li>
            <li class="page-item">
                <button type="button" class="page-link text-secondary" href="#" onclick="getData('.($totalPages).')" aria-label="Last">
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </button>
            </li>
        ';
        return $htmlPages;
    }
    function getComponent(string $name, $data=null){
        $file = "Views/Template/Components/{$name}.php";
        require $file;        
    }
    function getPaises(){
        $con = new Mysql();
        $request = $con->select_all("SELECT * FROM countries ORDER BY name");
        return $request;
    }
    function getDepartamentos(int $id){
        $con = new Mysql();
        $request = $con->select_all("SELECT * FROM states WHERE country_id = $id ORDER BY name ");
        return $request;
    }
    function getCiudades(int $id){
        $con = new Mysql();
        $request = $con->select_all("SELECT * FROM cities WHERE state_id = $id ORDER BY name");
        return $request;
    }
    function getTiposDocumento(){
        $con = new Mysql();
        $request = $con->select_all("SELECT * FROM document_type ORDER BY name");
        return $request;
    }
    function setEncriptar($data){
        $encrypted = openssl_encrypt($data, METHOD,KEY);
        //$base64 = base64_encode($encrypted); 
        $safe = str_replace(['/', '+'], ['_', '-'], $encrypted);
        return $safe;
    }
    function setDesencriptar($data){
        $data = str_replace(['_', '-'], ['/', '+'], $data);
        $decrypted = openssl_decrypt($data, METHOD, KEY);
        return $decrypted;
    }
    function getRedesSociales(){
        $social = getSocialMedia();
        $links ="";
        for ($i=0; $i < count($social) ; $i++) { 
            if($social[$i]['link']!=""){
                if($social[$i]['name']=="whatsapp"){
                    $links.='<li><a href="https://wa.me/'.$social[$i]['link'].'" target="_blank"><i class="fab fa-'.$social[$i]['name'].'"></i></a></li>';
                }else{
                    $links.='<li><a href="'.$social[$i]['link'].'" target="_blank"><i class="fab fa-'.$social[$i]['name'].'"></i></a></li>';
                }
            }
        }
        return $links;
    }
?>
