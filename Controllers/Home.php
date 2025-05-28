<?php
    require_once("Models/GeneralTrait.php");
    require_once("Models/BlogTrait.php");
    class Home extends Controllers{
        use GeneralTrait,BlogTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }

        public function home(){
            $company = getCompanyInfo();
            $data['page_tag'] = $company['name'];
            $data['page_title'] = $company['name'];
            $data['page_name'] = "inicio";
            $data['app'] = "functions_inicio.js";
            $data['company'] = $company;
            $this->views->getView($this,"home",$data);
        }
        public function getInitialData(){
            $arrResponse = array(
                "banners"=>$this->getBanners(),
                "testimonios"=>$this->getTestimonios(),
                "areas"=>$this->getAreas(),
                "noticias"=>$this->getNoticias(),
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>