<?php
    
    require_once("Models/GeneralTrait.php");
    class Home extends Controllers{
        use GeneralTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }

        public function home(){
            setVisita(BASE_URL."/inicio");
            $company = getCompanyInfo();
            $data['page_tag'] = $company['name'];
            $data['page_title'] = $company['name'];
            $data['page_name'] = "inicio";
            $data['url'] = $this->getPagina("contacto")['url'];
            $data['app'] = "functions_inicio.js";
            $data['company'] = $company;
            $this->views->getView($this,"home",$data);
        }
        public function getInitialData(){
            $arrResponse = array(
                "banners"=>$this->getBanners(),
                "testimonios"=>$this->getTestimonios(),
                "areas"=>$this->getAreas(),
                "servicios"=>$this->getServicios(),
                "noticias"=>$this->getNoticias(),
                "equipo"=>$this->getEquipo(),
                "paises"=>getPaises(),
                "nosotros"=>$this->getPagina("nosotros"),
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>