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
        public function paginas(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/paginas"."','','');mypop.focus();"],
                    "guardar" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"setDatos()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Paginas | Secciones";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_secciones_paginas.js";
                $this->views->getView($this,"paginas",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function banners(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/banners"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Banners | Secciones";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_secciones_banners.js";
                $this->views->getView($this,"banners",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function testimonios(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/testimonios"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Testimonios | Secciones";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_secciones_testimonios.js";
                $this->views->getView($this,"testimonios",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function equipo(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/equipo"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Equipo | Secciones";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_secciones_equipo.js";
                $this->views->getView($this,"equipo",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function faq(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/secciones/faq"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "FAQ | Secciones";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_secciones_faq.js";
                $this->views->getView($this,"faq",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function setPagina(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $strPagina = strtolower(strClean($_POST['nosotros_pagina']));
                    $strDescripcion = "";
                    $strDescripcionCorta ="";
                    $strTitulo = "";
                    $strSubtitulo ="";
                    $strImagen="";
                    $strImagenNombre="";
                    if($strPagina =="nosotros"){
                        $strImagen="";
                        $strDescripcion=$_POST['nosotros_descripcion'];
                        $strDescripcionCorta=ucfirst(strClean($_POST['nosotros_descripcion_corta']));
                        $strTitulo=ucfirst(strClean($_POST['nosotros_titulo']));
                        $strSubtitulo=ucfirst(strClean($_POST['nosotros_subtitulo']));
                        $request = $this->model->selectPagina($strPagina);
                        if($_FILES['nosotros_imagen']['name'] == ""){
                            $strImagenNombre = $request['picture'];
                        }else{
                            if($request['picture'] != "category.jpg"){deleteFile($request['picture']);}
                            $strImagen = $_FILES['nosotros_imagen'];
                            $strImagenNombre = $strPagina.'_'.bin2hex(random_bytes(6)).'.png';
                        }
                        $request = $this->model->updatePagina($strPagina,$strTitulo,$strSubtitulo,$strDescripcionCorta,$strDescripcion,$strImagenNombre);
                        if($strImagen != ""){ uploadImage($strImagen,$strImagenNombre); }
                    }

                    $strPagina = strtolower(strClean($_POST['contacto_pagina']));
                    if($strPagina =="contacto"){
                        $strImagen="";
                        $strTitulo=ucfirst(strClean($_POST['contacto_titulo']));
                        $strSubtitulo=ucfirst(strClean($_POST['contacto_subtitulo']));
                        $request = $this->model->selectPagina($strPagina);
                        if($_FILES['contacto_imagen']['name'] == ""){
                            $strImagenNombre = $request['picture'];
                        }else{
                            if($request['picture'] != "category.jpg"){deleteFile($request['picture']);}
                            $strImagen = $_FILES['contacto_imagen'];
                            $strImagenNombre = $strPagina.'_'.bin2hex(random_bytes(6)).'.png';
                        }
                        $request = $this->model->updatePagina($strPagina,$strTitulo,$strSubtitulo,"","",$strImagenNombre);
                        if($strImagen != ""){ uploadImage($strImagen,$strImagenNombre); }
                    }

                    $strPagina = strtolower(strClean($_POST['terminos_pagina']));
                    if($strPagina =="terminos"){
                        $strTitulo=ucfirst(strClean($_POST['terminos_titulo']));
                        $strDescripcion=$_POST['terminos_descripcion'];
                        $request = $this->model->updatePagina($strPagina,$strTitulo,"","",$strDescripcion,"");
                    }

                    $strPagina = strtolower(strClean($_POST['privacidad_pagina']));
                    if($strPagina =="privacidad"){
                        $strTitulo=ucfirst(strClean($_POST['privacidad_titulo']));
                        $strDescripcion=$_POST['privacidad_descripcion'];
                        $request = $this->model->updatePagina($strPagina,$strTitulo,"","",$strDescripcion,"");
                    }
                    if($request > 0 ){
                        $arrResponse = array('status' => true, 'msg' => 'Datos guardados');	
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible guardar los datos.');
                    }
                    
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
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
        public function setTestimonio(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre']) || empty($_POST['descripcion'])){
                        $arrResponse = array("status" => false, "msg" => 'Error de datos');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucwords(strClean($_POST['nombre']));
                        $strDescripcion = strClean($_POST['descripcion']);
                        $strProfesion = ucwords(strClean($_POST['profesion']));
                        $intEstado = intval($_POST['estado']);
                        $photo = "";
                        $photoCategory="";

                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;

                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = "category.jpg";
                                }else{
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'testimonio_'.bin2hex(random_bytes(6)).'.png';
                                }

                                $request= $this->model->insertTestimonio($photoCategory,$strNombre,$intEstado,$strProfesion,$strDescripcion);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectTestimonio($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'testimonio_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateTestimonio($intId,$photoCategory,$strNombre,$intEstado,$strProfesion,$strDescripcion);
                            }
                        }
                        if($request > 0 ){
                            if($photo!=""){ uploadImage($photo,$photoCategory); }
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
        public function setEquipo(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre'])){
                        $arrResponse = array("status" => false, "msg" => 'Error de datos');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucwords(strClean($_POST['nombre']));
                        $strProfesion = ucwords(strClean($_POST['profesion']));
                        $intEstado = intval($_POST['estado']);
                        $photo = "";
                        $photoCategory="";

                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;

                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = "category.jpg";
                                }else{
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'equipo_'.bin2hex(random_bytes(6)).'.png';
                                }

                                $request= $this->model->insertEquipo($photoCategory,$strNombre,$intEstado,$strProfesion);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->selectEquipo($intId);
                                if($_FILES['imagen']['name'] == ""){
                                    $photoCategory = $request['picture'];
                                }else{
                                    if($request['picture'] != "category.jpg"){
                                        deleteFile($request['picture']);
                                    }
                                    $photo = $_FILES['imagen'];
                                    $photoCategory = 'equipo_'.bin2hex(random_bytes(6)).'.png';
                                }
                                $request = $this->model->updateEquipo($intId,$photoCategory,$strNombre,$intEstado,$strProfesion);
                            }
                        }
                        if($request > 0 ){
                            if($photo!=""){ uploadImage($photo,$photoCategory); }
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
        public function setFaq(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['respuesta']) || empty($_POST['pregunta'])){
                        $arrResponse = array("status" => false, "msg" => 'Error de datos');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strRespuesta = ucfirst(strClean($_POST['respuesta']));
                        $strPregunta = ucfirst(strClean($_POST['pregunta']));
                        $intEstado = intval($_POST['estado']);
                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
                                $option = 1;
                                $request= $this->model->insertFaq($strPregunta,$strRespuesta,$intEstado);
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
                                $option = 2;
                                $request = $this->model->updateFaq($intId,$strPregunta,$strRespuesta,$intEstado);
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
                    if($strTipoBusqueda == "banners"){
                        $request = $this->model->selectBanners($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "testimonios"){
                        $request = $this->model->selectTestimonios($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "faq"){
                        $request = $this->model->selectFaqs($intPorPagina,$intPaginaActual, $strBuscar);
                    }else if($strTipoBusqueda == "equipo"){
                        $request = $this->model->selectEquipos($intPorPagina,$intPaginaActual, $strBuscar);
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
                    if($strTipoBusqueda == "banners"){ $request = $this->model->selectBanner($intId);}
                    else if($strTipoBusqueda == "testimonios"){$request = $this->model->selectTestimonio($intId);}
                    else if($strTipoBusqueda == "faq"){$request = $this->model->selectFaq($intId);}
                     else if($strTipoBusqueda == "equipo"){$request = $this->model->selectEquipo($intId);}
                    else if($strTipoBusqueda == "paginas"){
                        $arrNosotros = $this->model->selectPagina("nosotros");
                        $arrContacto = $this->model->selectPagina("contacto");
                        $arrTerminos = $this->model->selectPagina("terminos");
                        $arrPrivacidad = $this->model->selectPagina("privacidad");
                        $arrNosotros['url'] = media()."/images/uploads/".$arrNosotros['picture'];
                        $arrContacto['url'] = media()."/images/uploads/".$arrContacto['picture'];
                        $request = array(
                            "nosotros"=>$arrNosotros,
                            "contacto"=>$arrContacto,
                            "terminos"=>$arrTerminos,
                            "privacidad"=>$arrPrivacidad,
                        );
                        
                    }
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
                    if($strTipoBusqueda == "banners"){ 
                        $request = $this->model->selectBanner($intId);
                        if($request['picture']!="category.jpg"){ deleteFile($request['picture']); }
                        $request = $this->model->deleteBanner($intId);
                    }else if($strTipoBusqueda == "testimonios"){
                        $request = $this->model->selectTestimonio($intId);
                        if($request['picture']!="category.jpg"){ deleteFile($request['picture']); }
                        $request = $this->model->deleteTestimonio($intId);
                    }else if($strTipoBusqueda == "faq"){
                        $request = $this->model->deleteFaq($intId);
                    }else if($strTipoBusqueda == "equipo"){
                        $request = $this->model->deleteEquipo($intId);
                    }
                    if($request > 0 || $request == "ok"){
                        $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado correctamente.");
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
    }
?>