<?php
    class Faq extends Controllers{
        public function __construct(){
            parent::__construct();
            session_start();
            sessionCookie();
        }

        public function faq(){
            $company=getCompanyInfo();
            $data['company']=$company;
            $data['page_tag'] = "FAQ | ".$company['name'];
			$data['page_title'] = "FAQ | ".$company['name'];
			$data['page_name'] = "FAQ";
            $data['app'] = "functions_faq.js";
            $this->views->getView($this,"faq",$data);
        }
    }
?>