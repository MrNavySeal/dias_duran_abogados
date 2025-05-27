<?php
    class Noticias extends Controllers{

        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            getPermits(8);
        }
        
        public function noticias(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/noticias"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Noticias";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_noticias.js";
                $this->views->getView($this,"noticias",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function categorias(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/noticias/categorias"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Categorias | Noticias";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_noticias_categorias.js";
                $this->views->getView($this,"categorias",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function setNoticia(){
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
                        $intCategoria = intval($_POST['categoria']);
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
                                    $strImagenNombre = 'blog_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request= $this->model->insertNoticia($strNombre,$strDescripcionCorta,$strDescripcion,$strImagenNombre,$intEstado,$strRuta,$intCategoria);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectNoticia($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'blog_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateNoticia($intId,$strNombre,$strDescripcionCorta,$strDescripcion,$strImagenNombre,$intEstado,$strRuta,$intCategoria);
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
        public function setCategoria(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre'])){
                        $arrResponse = array("status" => false, "msg" => 'Los campos con (*) son obligatorios.');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucfirst(strClean($_POST['nombre']));
                        $intEstado = intval($_POST['estado']);
                        $strRuta = clear_cadena($strNombre);
                        $strRuta = strtolower(str_replace("¿","",$strRuta));
                        $strRuta = str_replace(" ","-",$strRuta);
                        $strRuta = str_replace("?","",$strRuta);
                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;
                                $request= $this->model->insertCategoria($strNombre,$intEstado,$strRuta,);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->updateCategoria($intId,$strNombre,$intEstado,$strRuta);
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
                    if($strTipoBusqueda == "categorias"){
                        $request = $this->model->selectCategorias($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "noticias"){
                        $request = $this->model->selectNoticias($intPorPagina,$intPaginaActual, $strBuscar);
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
                    if($strTipoBusqueda == "categorias"){
                        $request = $this->model->selectCategoria($intId);
                    }else if($strTipoBusqueda == "noticias"){
                        $request = $this->model->selectNoticia($intId);
                    }
                    if(isset($request['picture'])){$request['url'] = media()."/images/uploads/".$request['picture'];}
                    if(!empty($request)){
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
                    if($strTipoBusqueda == "categorias"){
                        $request = $this->model->deleteCategoria($intId);
                    }else if($strTipoBusqueda == "noticias"){
                        $request = $this->model->selectNoticia($intId);
                        if($request['picture']!="category.jpg"){ deleteFile($request['picture']); }
                        $request = $this->model->deleteNoticia($intId);
                    }
                    if($request > 0 || $request == "ok"){
                        $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado correctamente.");
                    }else if($request == "existe"){
                        $arrResponse = array("status"=>false,"msg"=>"Esta categoría contiene noticias asignadas, deberá eliminarlas.");
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getSelectCategorias(){
            if($_SESSION['permitsModule']['r']){
                $request = $this->model->selectCategoriasNoticias();
                echo json_encode($request,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>