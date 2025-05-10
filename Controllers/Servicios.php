<?php
    class Servicios extends Controllers{
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        public function areas(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Áreas de Asesoría";
            $data['page_title'] ="Áreas de Asesoría | ".$company['name'];
            $data['app'] = "functions_servicios.js";
            $this->views->getView($this,"areas",$data); 
        }
        public function area(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Áreas de Asesoría";
            $data['page_title'] ="Áreas de Asesoría | ".$company['name'];
            $data['app'] = "functions_servicios.js";
            $this->views->getView($this,"area",$data); 
        }
    }
?>