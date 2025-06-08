<?php
    require_once("Models/GeneralTrait.php");
    class Faq extends Controllers{
        use GeneralTrait;
        public function __construct(){
            parent::__construct();
            session_start();
            sessionCookie();
        }

        public function faq(){
            setVisita(BASE_URL."/faq");
            $company=getCompanyInfo();
            $data['company']=$company;
            $data['page_tag'] = "FAQ | ".$company['name'];
			$data['page_title'] = "FAQ | ".$company['name'];
			$data['page_name'] = "FAQ";
            $data['app'] = "functions_faq.js";
            $this->views->getView($this,"faq",$data);
        }
        public function getInitialData(){
            $arrResponse = array(
                "areas"=>$this->getAreas(),
                "faq"=>$this->getFaq(),
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
    }
?>