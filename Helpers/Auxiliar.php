<?php
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
    function getFooterServicios(){
        $con = new Mysql();
        $sql="SELECT * FROM category ORDER BY name";
        $request = $con->select_all($sql);
        $total = count($request);
        for ($i=0; $i < $total ; $i++) { 
            $request[$i]['route'] = base_url()."/servicios/area/".$request[$i]['route'];
        }
        return $request;
    }
    function notificacionMensajes(){
        $con = new Mysql();
        $request = $con->select_all("SELECT * FROM contact WHERE status != 1");
        $total = count($request);
        return $total;
    }
    function getError($codigo){
        throw new Exception(ERRORES[$codigo]);
    }
    function setVisita($route){
        $con = new Mysql();
        $location = new IpServiceProvider(new IpProvider,getIp());
        $location = $location->getLocation();
        if($location['status']=="success"){
            $ip = $location['query'];
            $sql = "SELECT * FROM locations WHERE ip = '$ip' AND route = '$route'";
            $request = $con->select_all($sql);
            if(empty($request)){
                $sql = "INSERT INTO locations(route,country,state,city,zip,lat,lon,timezone,isp,org,aso,ip) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                $arrData = [
                    $route,
                    $location['country'],
                    $location['regionName'],
                    $location['city'],
                    $location['zip'],
                    $location['lat'],
                    $location['lon'],
                    $location['timezone'],
                    $location['isp'],
                    $location['org'],
                    $location['as'],
                    $location['query'],
                ];
                $con->insert($sql,$arrData);
            }
        }
    }

?>
