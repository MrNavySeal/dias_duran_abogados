<?php
    require_once("Models/GeneralTrait.php");
    class Nosotros extends Controllers{
        use GeneralTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        public function nosotros(){
            setVisita(BASE_URL."/nosotros");
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Nosotros";
            $data['url'] = $this->getPagina("nosotros")['url'];
            $data['app'] = "functions_nosotros.js";
            $data['page_title'] ="Nosotros | ".$company['name'];
            $this->views->getView($this,"nosotros",$data); 
        }
    }
?>