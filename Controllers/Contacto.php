<?php
    require_once("Models/GeneralTrait.php");
    require_once("Models/CustomerTrait.php");
    class Contacto extends Controllers{
        use GeneralTrait,CustomerTrait;
        public function __construct(){
            parent::__construct();
            session_start();
            sessionCookie();
        }

        public function contacto(){
            $company=getCompanyInfo();
            $data['company']=$company;
            $data['page_tag'] = "Contacto | ".$company['name'];
			$data['page_title'] = "Contacto | ".$company['name'];
			$data['page_name'] = "Contacto";
            $data['url'] = $this->getPagina("contacto")['url'];
            $data['app'] = "functions_contacto.js";
            $this->views->getView($this,"contacto",$data);
        }
        public function getInitialData(){
            $arrResponse = array(
                "areas"=>$this->getAreas(),
                "paises"=>getPaises(),
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        
        public function setContacto(){
            if($_POST){
                if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['pais']) || empty($_POST['departamento'])
                || empty($_POST['ciudad']) || empty($_POST['pais_telefono']) || empty($_POST['telefono']) || empty($_POST['direccion'])
                || empty($_POST['comentario'])){
                    $arrResponse = array("status"=>true,"msg"=>"Todos los campos son obligatorios.");
                }else{
                    $strNombre = ucwords(strClean($_POST['nombre']));
                    $strApellido = ucwords(strClean($_POST['apellido']));
                    $intTelefono = doubleval(strClean($_POST['telefono']));
                    $intPaisTelefono = doubleval(strClean($_POST['pais_telefono']));
                    $strCorreo = strtolower(strClean($_POST['correo']));
                    $strDireccion = strClean($_POST['direccion']);
                    $strComentario = ucfirst(strClean($_POST['comentario']));
                    $intPais = intval($_POST['pais']) != 0 ? intval($_POST['pais']) : 99999;
                    $intDepartamento = isset($_POST['departamento']) && intval($_POST['departamento']) != 0   ? intval($_POST['departamento']) : 99999;
                    $intCiudad = isset($_POST['ciudad']) && intval($_POST['ciudad']) != 0 ? intval($_POST['ciudad']) : 99999;
                    $strSubject = "Nuevo mensaje";
                    $company = getCompanyInfo();
                    $useragent = $_SERVER['HTTP_USER_AGENT'];
                    $strIp= getIp();
                    $strDispositivo= "PC";

                    if(preg_match("/mobile/i",$useragent)){
                        $strDispositivo = "Movil";
                    }else if(preg_match("/tablet/i",$useragent)){
                        $strDispositivo = "Tablet";
                    }else if(preg_match("/iPhone/i",$useragent)){
                        $strDispositivo = "iPhone";
                    }else if(preg_match("/iPad/i",$useragent)){
                        $strDispositivo = "iPad";
                    }
                    $request = $this->insertContacto($strNombre,$strApellido,$intTelefono,$intPaisTelefono,$strCorreo,$strDireccion,$intPais,
                    $intDepartamento,$intCiudad,$strComentario,$strIp,$strDispositivo);
                    
                    if($request > 0){
                        $dataEmail = array('email_remitente' => $company['email'], 
                                                'email_usuario'=>$strCorreo, 
                                                'email_copia'=>$company['secondary_email'],
                                                'asunto' =>$strSubject,
                                                "message"=>$strComentario,
                                                "company"=>$company,
                                                "phone"=>$intTelefono,
                                                'name'=>$strNombre." ".$strApellido);
                        try {
                            sendEmail($dataEmail,'email_contact');
                            $arrResponse = array("status"=>true,"msg"=>"Recibimos tu mensaje, pronto nos comunicaremos contigo.");
                        } catch (Exception $e) {
                            $arrResponse = array("status"=>false,"msg"=>"Ha ocurrido un error en el envio de mensajes, inténtelo más tarde.");
                        }
                        
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Error, intenta de nuevo");
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>