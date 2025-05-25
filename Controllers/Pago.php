<?php
    require_once("Models/CustomerTrait.php");
    class Pago extends Controllers{
        use CustomerTrait;
        public function __construct(){
            session_start();
            parent::__construct();
            sessionCookie();
        }
        /******************************Views************************************/
        public function pago($params){
            $company=getCompanyInfo();
            if($params !=""){
                $intId = setDesencriptar($params);
                $request = $this->selectCaso($intId);
                if(!empty($request) && $request['status'] != "approved"){
                    $data['id_encrypt'] = $params;
                    $data['company'] = $company;
                    $data['page_tag'] = $company['name'];
                    $data['page_title'] = "Pago | ".$company['name'];
                    $data['page_name'] = "Pago";
                    $data['data'] = $request;
                    $data['app'] = "functions_pago.js";
                    $this->views->getView($this,"pago",$data);
                }else{
                    header("location: ".BASE_URL."/error");
                    die();
                }
            }else{
                header("location: ".BASE_URL."/error");
                die();
            }
        }
        public function confirmado($params){
             if($params !=""){
                $company=getCompanyInfo();
                $intId = setDesencriptar($params);
                $request = $this->selectCaso($intId);
                if(!empty($request)){
                    $data['company'] = $company;
                     $data['id_orden'] = openssl_encrypt($intId,METHOD,KEY);
                    $data['id_transaction'] = openssl_encrypt($request['idtransaction'],METHOD,KEY);
                    $data['page_tag'] = $company['name'];
                    $data['page_title'] ="Pago confirmado | ".$company['name'];
                    $data['page_name'] = "Pago confirmado";
                    $data['app'] = "functions_pago.js";
                    $this->views->getView($this,"confirmado",$data); 
                }
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function error(){
            $company=getCompanyInfo();
            $data['company'] = $company;
            $data['page_tag'] = $company['name'];
            $data['page_title'] ="Error | ".$company['name'];
            $data['page_name'] = "Error";
            $data['app'] = "functions_pago.js";
            $this->views->getView($this,"error",$data); 
        }
        public function getOrden($params){
            if($params !=""){
                $intId = setDesencriptar($params);
                $request = $this->selectCaso($intId);
                if(!empty($request)){
                    echo json_encode($request,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function setOrden(){
            if($_POST){
                $objPaypal = json_decode($_POST['data']);
                if(is_object($objPaypal)){
                    $intId = setDesencriptar($_POST['id']);
                    $arrOrden = $this->selectCaso($intId);
                    if(!empty($arrOrden)){
                        $strTransaccion = $objPaypal->purchase_units[0]->payments->captures[0]->id;
                        $strStatus = strtolower($objPaypal->purchase_units[0]->payments->captures[0]->status);
                        $strStatus = $strStatus == "completed" ? "approved" : "pendent";
                        $request = $this->updateCaso($intId,$strTransaccion,$strStatus);
                        if($request > 0){
                            $company = getCompanyInfo();
                            $arrOrden['idorder'] = $intId;
                            $arrEmailOrden = array(
                                'asunto' => "Se ha generado un pago",
                                'email_usuario' => $arrOrden['cliente']['email'], 
                                'email_remitente'=>$company['email'],
                                'company'=>$company,
                                'email_copia' => $company['secondary_email'],
                                'order' => $arrOrden);
                            try {sendEmail($arrEmailOrden,'email_order');} catch (Exception $e) {}
                            $arrResponse = array("status"=>true,"msg"=>"El pago se ha realizado correctamente.");
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"No se ha podido guardar el pago.");
                        }
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No se ha podido realizar el pago.");
                    }
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"No se ha podido realizar el pago.");
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        
    }
?>