<?php
    require_once("Models/GeneralTrait.php");
    class Servicios extends Controllers{
        use GeneralTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        public function areas(){
            setVisita(BASE_URL."/servicios/areas");
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Áreas de Asesoría";
            $data['page_title'] ="Áreas de Asesoría | ".$company['name'];
            $data['app'] = "functions_servicios.js";
            $this->views->getView($this,"areas",$data); 
        }
        public function area($params){
            $params = strClean($params);
            $request = $this->selectArea($params);
            if(!empty($request)){
                setVisita(BASE_URL."/servicios/area/$params");
                $company=getCompanyInfo();
                $data['company'] = $company;
                $data['page_tag'] = $company['name'];
                $data['page_name'] = $request['name'];
                $data['page_title'] ="$request[name] | ".$company['name'];
                $data['id']= $request['id'];
                $data['url'] = $request['url']; 
                $data['tipo'] = "area";
                $data['app'] = "functions_servicios.js";
                $this->views->getView($this,"area",$data); 
            }else{
                header("location: ".BASE_URL."/errors");
                die();
            }
        }
        public function servicio($params){
            $params = strClean($params);
            $request = $this->selectServicio($params);
            if(!empty($request)){
                setVisita(BASE_URL."/servicios/servicio/$params");
                $company=getCompanyInfo();
                $data['company'] = $company;
                $data['page_tag'] = $company['name'];
                $data['page_name'] = $request['name'];
                $data['page_title'] ="$request[name] | ".$company['name'];
                $data['tipo'] = "servicio";
                $data['url'] = $request['url']; 
                $data['category'] = ['name'=>$request['category'],'url'=>$request['category_route']];
                $data['id']= $request['id'];
                $data['app'] = "functions_servicios.js";
                $this->views->getView($this,"servicio",$data); 
            }else{
                header("location: ".BASE_URL."/errors");
                die();
            }
        }
        public function getInitialData(){
            if($_POST){
                $intId = intval($_POST['id']);
                $strTipo = strtolower(strClean($_POST['tipo']));
                if($strTipo=="area"){
                    $request = $this->selectArea($intId);
                }else{
                    $request = $this->selectServicio($intId);
                }
                $arrResponse = array(
                    "areas"=>$this->getAreas(),
                    "noticias"=>$this->getNoticias(),
                    "data"=>$request
                );
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>