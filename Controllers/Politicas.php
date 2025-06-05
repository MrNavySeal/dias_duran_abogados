<?php
    require_once("Models/GeneralTrait.php");
    class Politicas extends Controllers{
        use GeneralTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        public function terminos(){
            $request = $this->getPagina("terminos");
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = $request['title'];
            $data['data'] = $request;
            $data['app'] = "functions_politicas.js";
            $data['page_title'] =$request['title']." | ".$company['name'];
            $this->views->getView($this,"terminos",$data); 
        }
        public function privacidad(){
            $request = $this->getPagina("privacidad");
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = $request['title'];
            $data['data'] = $request;
            $data['app'] = "functions_politicas.js";
            $data['page_title'] =$request['title']." | ".$company['name'];
            $this->views->getView($this,"terminos",$data); 
        }
    }
?>