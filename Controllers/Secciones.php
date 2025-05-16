<?php
    
    class Secciones extends Controllers{
        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            getPermits(7);
        }
        public function banners(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/banners"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Secciones | Banners";
                $data['page_name'] = "inicio";
                $data['panelapp'] = "functions_banners.js";
                $this->views->getView($this,"banners",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function setBanner(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre'])){
                        $arrResponse = array("status" => false, "msg" => 'Error de datos');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucwords(strClean($_POST['nombre']));
                        $strEnlace = strClean($_POST['enlace']);
                        $intEstado = intval($_POST['estado']);
                        $strBoton = strClean($_POST['boton']);
                        $strDescripcion = strClean($_POST['descripcion']);
                        $photo = "";
                        $photoCategory="";

                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;

                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = "category.jpg";
                                }else{
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'banner_'.bin2hex(random_bytes(6)).'.png';
                                }

                                $request= $this->model->insertBanner(
                                    $photoCategory, 
                                    $strNombre,
                                    $intEstado,
                                    $strEnlace,
                                    $strBoton,
                                    $strDescripcion
                                );
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectBanner($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'banner_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateBanner(
                                    $intId, 
                                    $photoCategory,
                                    $strNombre,
                                    $intEstado,
                                    $strEnlace,
                                    $strBoton,
                                    $strDescripcion
                                );
                            }
                        }
                        if($request > 0 ){
                            if($photo!=""){
                                uploadImage($photo,$photoCategory);
                            }
                            if($option == 1){
                                $arrResponse = array('status' => true, 'msg' => 'Datos guardados');	
                            }else{
                                $arrResponse = array('status' => true, 'msg' => 'Datos actualizados');	
                            }
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
                    if($strTipoBusqueda == "banners"){
                        $request = $this->model->selectBanners($intPorPagina,$intPaginaActual, $strBuscar);
                        foreach ($request['data'] as &$data) { 
                            $data['url'] = media()."/images/uploads/".$data['picture'];
                            $data['edit'] = $_SESSION['permitsModule']['u'];
                            $data['delete'] = $_SESSION['permitsModule']['d'];
                        }
                    }
                    echo json_encode($request,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getDatos(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST)){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $intId = intval($_POST['id']);
                        $request = $this->model->selectBanner($intId);
                        if(!empty($request)){
                            $request['url'] = media()."/images/uploads/".$request['picture'];
                            $arrResponse = array("status"=>true,"data"=>$request);
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"Error, intenta de nuevo"); 
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function delDatos(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    if(empty($_POST['id'])){
                        $arrResponse=array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $intId = intval($_POST['id']);
                        $request = $this->model->selectBanner($intId);
                        if($request['picture']!="category.jpg"){
                            deleteFile($request['picture']);
                        }
                        $request = $this->model->deleteBanner($intId);
                        if($request=="ok"){
                            $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado correctamente.");
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
    }
?>