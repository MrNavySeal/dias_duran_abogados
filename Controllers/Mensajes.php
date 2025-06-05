<?php
    class Mensajes extends Controllers{
        public function __construct(){
            session_start();
            
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(9);
        }

        /*************************Views*******************************/
        
        public function mensajes(){
            if($_SESSION['permitsModule']['r']){
                $data['inbox'] = $this->getMails();
                $data['sent'] = $this->getSentMails();
                $data['page_tag'] = "Mensajes";
                $data['page_title'] = "Mensajes";
                $data['page_name'] = "mensajes";
                $data['panelapp'] = "functions_mailbox.js";
                $this->views->getView($this,"mensajes",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function mensaje($params){
            if($_SESSION['permitsModule']['r']){
                if(is_numeric($params)){
                    $id = intval($params);
                    $data['message'] = $this->model->selectMail($id);
                    $data['page_tag'] = "Mensaje";
                    $data['page_title'] = "Mensaje";
                    $data['page_name'] = "mensaje";
                    $data['panelapp'] = "functions_mailbox.js";
                    $this->views->getView($this,"mensaje",$data);
                }else{
                    header("location: ".base_url()."/administracion/mailbox");
                    die();
                }
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function enviado($params){
            if($_SESSION['permitsModule']['r']){
                if(is_numeric($params)){
                    $id = intval($params);
                    $data['message'] = $this->model->selectSentMail($id);
                    $data['page_tag'] = "Enviados";
                    $data['page_title'] = "Enviados";
                    $data['page_name'] = "enviados";
                    $this->views->getView($this,"enviado",$data);
                }else{
                    header("location: ".base_url()."/administracion/mailbox");
                    die();
                }
            }else{
                header("location: ".base_url());
                die();
            }
        }
        
        /*************************Mailbox methods*******************************/
        public function getMails(){
            if($_SESSION['permitsModule']['r']){
                $html="";
                $total = 0;
                $request = $this->model->selectMensajes();
                if(count($request)>0){
                    for ($i=0; $i < count($request); $i++) { 
                        $status ="";
                        $url = base_url()."/mensajes/mensaje/".$request[$i]['id'];
                        if($request[$i]['status'] == 1){
                            $status="text-black-50";
                        }else{
                            $total++;
                        }
                        $html.='
                        <div class="mail-item '.$status.'">
                            <div class="row position-relative">
                                <div class="col-4">
                                    <p class="m-0 mail-info">'.$request[$i]['name'].'</p>
                                </div>
                                <div class="col-4">
                                    <p class="mail-info">'.$request[$i]['subject'].'</p>
                                </div>
                                <div class="col-4">
                                    <p class="m-0">'.$request[$i]['date'].'</p>
                                </div>
                                <a href="'.$url.'" class="position-absolute w-100 h-100"></a>
                            </div>
                            <button type="button" class="btn" onclick="delMail('.$request[$i]['id'].',1)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        ';
                    }
                    $arrResponse = array("status"=>true,"data"=>$html,"total"=>$total);
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"No hay datos");
                }
            }
            return $arrResponse;
        }
        public function setReply(){
            if($_SESSION['permitsModule']['w']){
                if($_POST){
                    if(empty($_POST['txtMessage']) || empty($_POST['idMessage']) || empty($_POST['txtEmail']) || empty($_POST['txtName'])){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $strMessage = strClean($_POST['txtMessage']);
                        $idMessage = intval($_POST['idMessage']);
                        $strEmail = strClean(strtolower($_POST['txtEmail']));
                        $strName = strClean(ucwords($_POST['txtName']));
                        $request = $this->model->updateMessage($strMessage,$idMessage);
                        $company=getCompanyInfo();
                        if($request>0){
                            $dataEmail = array('email_remitente' => $company['email'], 
                                                    'email_usuario'=>$strEmail,
                                                    'asunto' =>'Respondiendo tu mensaje.',
                                                    "message"=>$strMessage,
                                                    'company'=>$company,
                                                    'name'=>$strName);
                            sendEmail($dataEmail,'email_reply');
                            $arrResponse = array("status"=>true,"msg"=>"Respuesta enviada"); 
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"Ha ocurrido un error, intenta de nuevo.");
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function sendEmail(){
            if($_SESSION['permitsModule']['w']){
                if($_POST){
                    if(empty($_POST['txtMessage']) ||  empty($_POST['txtEmail'])){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $strMessage = strClean($_POST['txtMessage']);
                        $strEmail = strClean(strtolower($_POST['txtEmail']));
                        $strEmailCC = strClean(strtolower($_POST['txtEmailCC']));
                        $strSubject = $_POST['txtSubject'] !="" ? strClean(($_POST['txtSubject'])) : "Has enviado un correo.";
                        $request = $this->model->insertMessage($strSubject,$strEmail,$strMessage);
                        $company = getCompanyInfo();
                        if($request>0){
                            $dataEmail = array('email_remitente' => $company['email'], 
                                                    'email_copia'=>$strEmailCC,
                                                    'email_usuario'=>$strEmail,
                                                    'asunto' =>$strSubject,
                                                    'company'=>$company,
                                                    "message"=>$strMessage);
                            sendEmail($dataEmail,'email_sent');
                            $arrResponse = array("status"=>true,"msg"=>"Mensaje enviado."); 
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"Ha ocurrido un error, intenta de nuevo.");
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }   
            }
            die();
        }
        public function getSentMails(){
            if($_SESSION['permitsModule']['r']){
                $html="";
                $request = $this->model->selectSentMails();
                if(count($request)>0){
                    for ($i=0; $i < count($request); $i++) { 
                        $status ="";
                        $total = 0;
                        $email = explode("@",$request[$i]['email']);
                        $url = base_url()."/administracion/enviado/".$request[$i]['id'];
                        $html.='
                        <div class="mail-item text-black-50">
                            <div class="row position-relative">
                                <div class="col-4">
                                    <p class="m-0 mail-info">'.$email[0].'</p>
                                </div>
                                <div class="col-4">
                                    <p class="mail-info">'.$request[$i]['subject'].'</p>
                                </div>
                                <div class="col-4">
                                    <p class="m-0">'.$request[$i]['date'].'</p>
                                </div>
                                <a href="'.$url.'" class="position-absolute w-100 h-100"></a>
                            </div>
                            <button type="button" class="btn" onclick="delMail('.$request[$i]['id'].',2)"><i class="fas fa-trash-alt"></i></button>
                        </div>
                        ';
                    }
                    $arrResponse = array("status"=>true,"data"=>$html,"total"=>$total);
                }else{
                    $arrResponse = array("status"=>false,"msg"=>"No hay datos");
                }
            }
            return $arrResponse;
        }
        public function delMail(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    $id = intval($_POST['id']);
                    $option = intval($_POST['option']);

                    $request = $this->model->delEmail($id,$option);
                    
                    if($request=="ok"){
                        $arrResponse = array("status"=>true,"msg"=>"The mail has been deleted."); 
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Error, try again."); 
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>