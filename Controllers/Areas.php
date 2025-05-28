<?php
    class Areas extends Controllers{
        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            getPermits(4);
        }
        public function areas(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/areas/areas"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Areas | Áreas de asesoría";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_areas.js";
                $this->views->getView($this,"areas",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function servicios(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/areas/servicios"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Servicios | Áreas de asesoría";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_areas_servicios.js";
                $this->views->getView($this,"servicios",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function setArea(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre'])){
                        $arrResponse = array("status" => false, "msg" => 'Los campos con (*) son obligatorios.');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucfirst(strClean($_POST['nombre']));
                        $strDescripcion = $_POST['descripcion'];
                        $strDescripcionCorta = ucfirst(strClean($_POST['descripcion_corta']));
                        $intEstado = intval($_POST['estado']);
                        $strRuta = clear_cadena($strNombre);
                        $strRuta = strtolower(str_replace("¿","",$strRuta));
                        $strRuta = str_replace(" ","-",$strRuta);
                        $strRuta = str_replace("?","",$strRuta);
                        $strImagen="";
                        $strImagenNombre="";

                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = "category.jpg";
                                }else{
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'area_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request= $this->model->insertArea($strNombre,$strDescripcion,$strDescripcionCorta,$intEstado,$strRuta,$strImagenNombre);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectArea($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'area_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateArea($intId,$strNombre,$strDescripcion,$strDescripcionCorta,$intEstado,$strRuta,$strImagenNombre);
                            }
                        }
                        if($request > 0 ){
                            if($strImagen != ""){ uploadImage($strImagen,$strImagenNombre); }
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
        public function setServicio(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre']) || empty($_POST['area'])){
                        $arrResponse = array("status" => false, "msg" => 'Los campos con (*) son obligatorios.');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucfirst(strClean($_POST['nombre']));
                        $strDescripcion = $_POST['descripcion'];
                        $strDescripcionCorta = ucfirst(strClean($_POST['descripcion_corta']));
                        $intArea = intval($_POST['area']);
                        $intEstado = intval($_POST['estado']);
                        $strRuta = clear_cadena($strNombre);
                        $strRuta = strtolower(str_replace("¿","",$strRuta));
                        $strRuta = str_replace(" ","-",$strRuta);
                        $strRuta = str_replace("?","",$strRuta);
                        $strImagen="";
                        $strImagenNombre="";

                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = "category.jpg";
                                }else{
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'servicio_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request= $this->model->insertServicio($strNombre,$strDescripcion,$strDescripcionCorta,$intEstado,$strRuta,$strImagenNombre,$intArea);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectServicio($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'servicio_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateServicio($intId,$strNombre,$strDescripcion,$strDescripcionCorta,$intEstado,$strRuta,$strImagenNombre,$intArea);
                            }
                        }
                        if($request > 0 ){
                            if($strImagen != ""){ uploadImage($strImagen,$strImagenNombre); }
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
                    if($strTipoBusqueda == "areas"){
                        $request = $this->model->selectAreas($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "servicios"){
                        $request = $this->model->selectServicios($intPorPagina,$intPaginaActual, $strBuscar);
                    }
                    if(!empty($request)){
                        foreach ($request['data'] as &$data) { 
                            if(isset($data['picture'])){ $data['url'] = media()."/images/uploads/".$data['picture'];}
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
                    $intId = intval($_POST['id']);
                    $strTipoBusqueda = clear_cadena(strClean($_POST['tipo_busqueda']));
                    if($strTipoBusqueda == "areas"){ $request = $this->model->selectArea($intId);}
                    else if($strTipoBusqueda == "servicios"){$request = $this->model->selectServicio($intId);}
                    if(!empty($request)){
                        if(isset($request['picture'])){$request['url'] = media()."/images/uploads/".$request['picture'];}
                        $arrResponse = array("status"=>true,"data"=>$request);
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Error, intenta de nuevo"); 
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function delDatos(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    $intId = intval($_POST['id']);
                    $strTipoBusqueda = clear_cadena(strClean($_POST['tipo_busqueda']));
                    if($strTipoBusqueda == "areas"){ 
                        $request = $this->model->selectArea($intId);
                        if($request['picture']!="category.jpg"){ deleteFile($request['picture']); }
                        $request = $this->model->deleteArea($intId);
                    }else if($strTipoBusqueda == "servicios"){
                        $request = $this->model->selectServicio($intId);
                        if($request['picture']!="category.jpg"){ deleteFile($request['picture']); }
                        $request = $this->model->deleteServicio($intId);
                    }
                    if($request > 0 || $request == "ok"){
                        $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado correctamente.");
                    }else if($request == "existe"){
                        $arrResponse = array("status"=>false,"msg"=>"Esta área contiene servicios asignados, deberá eliminarlos.");
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getSelectAreas(){
            if($_SESSION['permitsModule']['r']){
                $request = $this->model->selectServiciosAreas();
                echo json_encode($request,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>