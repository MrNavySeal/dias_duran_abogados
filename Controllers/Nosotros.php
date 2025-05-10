<?php
    class Nosotros extends Controllers{
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        public function nosotros(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Nosotros";
            $data['app'] = "functions_about.js";
            $data['page_title'] =$data['page']['name']." | ".$company['name'];
            $this->views->getView($this,"nosotros",$data); 
        }
    }
?>