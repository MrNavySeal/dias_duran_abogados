<?php
    class Clientes extends Controllers{

        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(3);
        }
        public function clientes(){
            if($_SESSION['permitsModule']['r']){
                $data['page_tag'] = "Clientes";
                $data['page_title'] = "Clientes";
                $data['page_name'] = "clientes";
                $data['panelapp'] = "functions_customer.js";
                $this->views->getView($this,"clientes",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
    
        /* Metodos */
        public function getClientes() {
            if (!empty($_POST)) {
                $data = [
                    "searchNombre" => clear_cadena(strClean($_POST["search_nombre"])),
                    "searchDocumento" => (int) clear_cadena(strClean($_POST["search_documento"])),
                    "paginaActual" => $_POST["pagina_actual"],
                    "limitePagina" => $_POST["limite_pagina"]
                ];

                $request = $this->model->getAllClientes($data);
                
                $arrResponse = array(
                    "arr_clientes" => $request["data"],
                );
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>