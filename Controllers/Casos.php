<?php
    class Casos extends Controllers{
        public function __construct(){
            
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(6);
        }

        public function casos(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/casos"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Casos";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_casos.js";
                $this->views->getView($this,"casos",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function transaccion($idTransaction){
            if($_SESSION['permitsModule']['r']){
                $idPerson ="";
                if($_SESSION['userData']['roleid'] == 2 ){
                    $idPerson= $_SESSION['idUser'];
                }
                $data['transaction'] = $this->model->selectTransaction($idTransaction,$idPerson);
                $data['page_tag'] = "Transacción";
                $data['page_title'] = "Transacción | Pedidos";
                $data['page_name'] = "transaccion";
                $data['panelapp'] = "functions_orders.js";
                $this->views->getView($this,"transaccion",$data);
                
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function pdf($params){
            if($_SESSION['permitsModule']['r']){
                $data['page_title'] = " Factura de venta No. ".$params." | "."Pedidos";
                $data['file_name'] = 'factura_venta_'.$params.'_'.rand()*10;
                $data['data'] = $this->model->selectOrder($params);
                $this->views->getView($this,"pedido-pdf",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function setCaso(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['servicio']) || empty($_POST['cliente']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['valor_base'])
                    || empty($_POST['valor_objetivo']) || empty($_POST['moneda_base']) || empty($_POST['moneda_objetivo'])){
                        $arrResponse = array("status" => false, "msg" => 'Los campos con (*) son obligatorios.');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strTitulo = ucfirst(strClean(clear_cadena($_POST['titulo'])));
                        $strDescripcion = $_POST['descripcion'];
                        $intServicio = intval($_POST['servicio']);
                        $intCliente = intval($_POST['cliente']);
                        $strHora = strClean($_POST['hora']);
                        $strFecha = strClean($_POST['fecha']);
                        $strMonedaBase = strtoupper(strClean($_POST['moneda_base']));
                        $strMonedaObjetivo = strtoupper(strClean($_POST['moneda_objetivo']));
                        $strEstado = strtolower(strClean($_POST['estado']));
                        $intValorBase = doubleval($_POST['valor_base']);
                        $intValorObjetivo = doubleval($_POST['valor_objetivo']);
                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;
                                $request= $this->model->insertCaso($strTitulo,$strDescripcion,$intServicio,$intCliente,$strHora,$strFecha,
                                $strMonedaBase,$strMonedaObjetivo,$intValorBase,$intValorObjetivo,$strEstado);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->updateCaso($intId,$strTitulo,$strDescripcion,$intServicio,$intCliente,$strHora,$strFecha,
                                $strMonedaBase,$strMonedaObjetivo,$intValorBase,$intValorObjetivo,$strEstado);
                            }
                        }
                        if($request > 0 ){
                            if($option == 1){ $arrResponse = array('status' => true, 'msg' => 'Datos guardados');	
                            }else{ $arrResponse = array('status' => true, 'msg' => 'Datos actualizados'); }
                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible guardar los datos.');
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
			die();
		}
        public function getBuscar(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $intPorPagina = intval($_POST['paginas']);
                    $intPaginaActual = intval($_POST['pagina']);
                    $strBuscar = clear_cadena(strClean($_POST['buscar']));
                    $strTipoBusqueda = clear_cadena(strClean($_POST['tipo_busqueda']));
                    if($strTipoBusqueda == "casos"){
                        $request = $this->model->selectCasos($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "servicios"){
                        $request = $this->model->selectServicios($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "clientes"){
                        $request = $this->model->selectClientes($intPorPagina,$intPaginaActual, $strBuscar);
                    }
                    if(!empty($request)){
                        foreach ($request['data'] as &$data) { 
                            if(isset($data['picture'])){ $data['url'] = media()."/images/uploads/".$data['picture'];}
                        }
                    }
                    echo json_encode($request,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getDatosIniciales(){
            if($_SESSION['permitsModule']['r']){
                echo json_encode(['currency'=>getCompanyInfo()['currency']['code'],"status"=>STATUS],JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function getConversion(){
            if($_POST){
                $intModo = intval($_POST['modo']);
                $intMonedaBase = strtoupper(strClean($_POST['base']));
                $intMonedaObjetivo = strtoupper(strClean($_POST['objetivo']));
                $intValorBase = doubleval($_POST['valor_base']);
                $intValorObjetivo = doubleval($_POST['valor_objetivo']);
                $intValorConversionObjetivo = 0;
                $reqUrl = "https://v6.exchangerate-api.com/v6/f21b35a9dce0dc9441694e46/pair/$intMonedaBase/$intMonedaObjetivo";
                $request = $this->model->selectConversion($intMonedaBase,$intMonedaObjetivo);
                if(!empty($request)){
                    $strFechaConversion = new DateTime($request['date']);
                    $strFechaActual = new DateTime();
                    $intDias = $strFechaActual->diff($strFechaConversion)->days;
                    
                    $intValorConversionObjetivo = $request['target'];
                    if($intDias >=15){
                        $strFechaActual = date_format($strFechaActual,"Y-m-d");
                        $responseJson = file_get_contents($reqUrl);
                        if(false !== $responseJson) {
                            try {
                                $response = json_decode($responseJson);
                                if('success' === $response->result) {
                                    $intValorConversionObjetivo = $response->conversion_rate;
                                    $this->model->updateConversion($request['id'],$intValorConversionObjetivo,$strFechaActual);
                                    $intValorObjetivo = round(($intValorBase * $intValorConversionObjetivo));
                                    $arrResponse = array("status"=>true,"data"=>$intValorObjetivo);
                                }
                            }
                            catch(Exception $e) {
                                $arrResponse = array("status"=>false,"msg"=>$e);
                            }
        
                        }
                    }
                    if(!$intModo){
                        $intValorObjetivo =  round(($intValorBase*$intValorConversionObjetivo));
                    }else{
                        $intValorObjetivo =  round(($intValorObjetivo/$intValorConversionObjetivo));
                    }
                    $arrResponse = array("status"=>true,"data"=>$intValorObjetivo);
                }else{
                    $responseJson = file_get_contents($reqUrl);
                    if(false !== $responseJson) {
                        try {
                            $response = json_decode($responseJson);
                            if('success' === $response->result) {
                                $intValorConversionObjetivo = $response->conversion_rate;
                                $this->model->insertConversion($intMonedaBase,$intMonedaObjetivo,$intValorConversionObjetivo);
                                $intValorObjetivo = round(($intValorBase * $intValorConversionObjetivo));
                                $arrResponse = array("status"=>true,"data"=>$intValorObjetivo);
                            }
                        }
                        catch(Exception $e) {
                            $arrResponse = array("status"=>false,"msg"=>$e);
                        }
    
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>