<?php
    
    require_once("Models/BlogTrait.php");
    require_once("Models/LoginModel.php");
    class Blog extends Controllers{
        use BlogTrait;
        private $login;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
            $this->login = new LoginModel();
        }

        /******************************Views************************************/
        public function blog(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_title'] = "Blog | ".$company['name'];
            $data['page_name'] = "blog";
            $data['app'] = "functions_blog.js";
            $this->views->getView($this,"blog",$data);
        }
        public function noticia($params){
            $params = strClean($params);
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_name'] = "Noticia";
            $data['page_title'] =$data['article']['name']." | ".$company['name'];
            $data['app'] = "functions_blog.js";
            $this->views->getView($this,"noticia",$data);
        }
    }
?>