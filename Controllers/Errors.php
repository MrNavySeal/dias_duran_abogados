<?php
    Class Errors extends Controllers{
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }

        public function errors(){
            $data['page_tag'] = "Error";
            $data['company'] = getCompanyInfo();
            $data['page_title'] = "Error";
            $data['page_name'] = "error";
            $data['app'] = "functions_contacto.js";
            $this->views->getView($this,"error",$data);
        }
    }
?>