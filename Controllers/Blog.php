<?php
    
    require_once("Models/GeneralTrait.php");
    class Blog extends Controllers{
        use GeneralTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }

        /******************************Views************************************/
        public function blog(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_title'] = "Blog | ".$company['name'];
            $data['page_name'] = "Blog";
            $data['app'] = "functions_blog.js";
            $this->views->getView($this,"blog",$data);
        }
        public function buscar($params){
            $params = strClean($params);
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_title'] = "Blog | ".$company['name'];
            $data['page_name'] = "Blog";
            $data['buscar'] = $params;
            $data['app'] = "functions_blog.js";
            $this->views->getView($this,"buscar",$data);
        }
        public function categoria($params){
            $params = strClean($params);
            $request = $this->selectBlogCategoria($params);
            if(!empty($request)){
                $company=getCompanyInfo();
                $data['company'] = $company;
                $data['page_tag'] = $company['name'];
                $data['page_name'] = $request['name'];
                $data['page_title'] ="$request[name] | ".$company['name'];
                $data['id_categoria'] = $request['id'];
                $data['category'] = ['name'=>"blog",'url'=>base_url()."/blog"];
                $data['app'] = "functions_blog.js";
                $this->views->getView($this,"categoria",$data);
            }
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
        public function getInitialData(){
            $arrResponse = array(
                "categorias"=>$this->getBlogCategorias(),
                "recientes"=>$this->getBlogRecientes(),
                "areas"=>$this->getAreas(),
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getBuscar(){
            if($_POST){
                $intPorPagina = intval($_POST['paginas']);
                $intPaginaActual = intval($_POST['pagina']);
                $strBuscar = clear_cadena(strClean($_POST['buscar']));
                $strCategoria =  clear_cadena(strClean($_POST['categoria']));
                $strTipoBusqueda = clear_cadena(strClean($_POST['tipo_busqueda']));
                $request = $this->getBlogPaginacion($intPorPagina,$intPaginaActual, $strBuscar,$strCategoria);
                echo json_encode($request,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>