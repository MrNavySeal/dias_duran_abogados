<?php
    
    require_once("Models/CustomerTrait.php");
    require_once("Models/BlogTrait.php");
    require_once("Models/CategoryTrait.php");
    class Home extends Controllers{
        use CustomerTrait,BlogTrait,CategoryTrait;
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
            $data['posts'] = $this->getArticlesT(3);
            $this->views->getView($this,"home",$data);
        }
        public function getInitialData(){
            $arrResponse = array(
                "banners"=>$this->getBanners()
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>