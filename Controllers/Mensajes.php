<?php
    class Mensajes extends Controllers{
        public function __construct(){
            session_start();
            
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(9);
        }

        /*************************Views*******************************/
        
        public function mensajes(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>true, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/mensajes"."','','');mypop.focus();"],
                ];
                $data['tipo_pagina']=3;
                $data['page_tag'] = "Mensajes";
                $data['page_title'] = "Mensajes";
                $data['page_name'] = "mensajes";
                $data['panelapp'] = "functions_contacto.js";
                $this->views->getView($this,"mensajes",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function mensaje($params){
            if($_SESSION['permitsModule']['r']){
                if(is_numeric($params)){
                    $id = intval($params);
                    $data['botones'] = [
                        "atras" => ["mostrar"=>true, "evento"=>"onClick","funcion"=>"window.location.href='".BASE_URL."/mensajes'"],
                        "duplicar" => ["mostrar"=>true, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/mensajes/mensaje/".$id."','','');mypop.focus();"],
                    ];
                    $data['tipo_pagina']=1;
                    $data['id'] = $id;
                    $data['page_tag'] = "Mensaje";
                    $data['page_title'] = "Mensaje";
                    $data['page_name'] = "mensaje";
                    $data['panelapp'] = "functions_contacto.js";
                    $this->views->getView($this,"mensaje",$data);
                }else{
                    header("location: ".base_url()."/mensajes");
                    die();
                }
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function enviado($params){
            if($_SESSION['permitsModule']['r']){
                if(is_numeric($params)){
                    $id = intval($params);
                    $data['botones'] = [
                        "atras" => ["mostrar"=>true, "evento"=>"onClick","funcion"=>"window.location.href='".BASE_URL."/mensajes'"],
                        "duplicar" => ["mostrar"=>true, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/mensajes/enviado/".$id."','','');mypop.focus();"],
                    ];
                    $data['message'] = $this->model->selectSentMail($id);
                    $data['page_tag'] = "Enviados";
                    $data['page_title'] = "Enviados";
                    $data['page_name'] = "enviados";
                    $this->views->getView($this,"enviado",$data);
                }else{
                    header("location: ".base_url()."/mensajes");
                    die();
                }
            }else{
                header("location: ".base_url());
                die();
            }
        }
        
        public function getBuscar(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $intPorPagina = intval($_POST['paginas']);
                    $intPaginaActual = intval($_POST['pagina']);
                    $strBuscar = clear_cadena(strClean($_POST['buscar']));
                    $strTipoBusqueda = strtolower(strClean($_POST['tipo_busqueda']));
                    if($strTipoBusqueda == "recibidos"){
                        $request = $this->model->selectMensajes($intPorPagina,$intPaginaActual, $strBuscar);
                    }else{
                        $request = $this->model->selectEnviados($intPorPagina,$intPaginaActual, $strBuscar);
                    }
                    if(!empty($request)){
                        foreach ($request['data'] as &$data) { 
                            if(isset($data['image'])){ $data['url'] = media()."/images/uploads/".$data['image'];}
                            $data['read'] = $_SESSION['permitsModule']['r'];
                            $data['edit'] = $_SESSION['permitsModule']['u'];
                            $data['delete'] = $_SESSION['permitsModule']['d'];
                        }
                    }
                    echo json_encode($request,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function setMensaje(){
            if($_SESSION['permitsModule']['w']){
                if($_POST){
                    if((empty($_POST['mensaje']) ||  empty($_POST['correo'])) && $_POST['id'] == "0" ){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else if(empty($_POST['mensaje'])  && $_POST['id'] == "0" ){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $intId = intval($_POST['id']);
                        $strMessage = strClean($_POST['mensaje']);
                        $strEmail = strClean(strtolower($_POST['correo']));
                        $strEmailCC = strClean(strtolower($_POST['correo_copia']));
                        $strSubject ="";
                        if($intId == 0){
                            $strSubject = $_POST['asunto'] !="" ? strClean(($_POST['asunto'])) : "Has enviado un mensaje.";
                            $request = $this->model->insertMessage($strSubject,$strEmail,$strMessage);
                        }else{
                            $strSubject = "Respondiendo tu mensaje.";
                            $arrMensaje =  $this->model->selectMail($intId);
                            $strEmail = $arrMensaje['email'];
                            $strEmailCC ="";
                            $request = $this->model->updateMessage($strMessage,$intId);
                        }
                        $company = getCompanyInfo();
                        if($request>0){
                            $dataEmail = array('email_remitente' => $company['email'], 
                                                    'email_copia'=>$strEmailCC,
                                                    'email_usuario'=>$strEmail,
                                                    'asunto' =>$strSubject,
                                                    'company'=>$company,
                                                    "message"=>$strMessage);
                            sendEmail($dataEmail,'email_sent');
                            $arrResponse = array("status"=>true,"msg"=>"Mensaje enviado."); 
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"Ha ocurrido un error, intenta de nuevo.");
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }   
            }
            die();
        }
        public function getMensaje(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $intId = intval($_POST['id']);
                    $request = $this->model->selectMail($intId);
                    if(!empty($request)){
                        $arrResponse = array("status"=>true,"data"=>$request);
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Datos no encontrados");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function delDatos(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    $id = intval($_POST['id']);
                    $option = strtolower(strClean($_POST['tipo_busqueda']));
                    
                    $request = $this->model->delEmail($id,$option);
                    
                    if($request=="ok"){
                        $arrResponse = array("status"=>true,"msg"=>"El mensaje ha sido eliminado."); 
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Ha ocurrido un error, intenta de nuevo.");
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>