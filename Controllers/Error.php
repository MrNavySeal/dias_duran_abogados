<?php
    Class Errors extends Controllers{
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }

        public function notFound(){

            $data['page_tag'] = "Error";
            $data['company'] = getCompanyInfo();
            $data['page_title'] = "Error";
            $data['page_name'] = "error";
            $data['app'] = "functions_pago.js";
            $this->views->getView($this,"error",$data);
        }
    }
    $error = new Errors();
    $error->notFound();
?>