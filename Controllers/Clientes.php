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
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/clientes"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Clientes";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_clientes.js";
                $this->views->getView($this,"clientes",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function getDatosIniciales(){
            if($_SESSION['permitsModule']['r']){
                $arrResponse = array(
                    "paises"=>getPaises(),
                    "tipos_documento"=>getTiposDocumento()
                );
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function setCliente(){
            dep($_POST);exit;
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['tipo_documento']) || empty($_POST['documento'])
                    || empty($_POST['correo']) || empty($_POST['pais']) || empty($_POST['departamento']) || empty($_POST['ciudad'])
                    || empty($_POST['pais_telefono']) || empty($_POST['telefono']) || empty($_POST['direccion'])
                    ){
                        $arrResponse = array("status" => false, "msg" => 'Todos los campos con (*) son obligatorios');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strName = ucwords(strClean($_POST['nombre']));
                        $strApellido = ucwords(strClean($_POST['apellido']));
                        $strTelefono = intval(strClean($_POST['telefono']));
                        $strCorreo = $_POST['correo'] != "" ? strtolower(strClean($_POST['correo'])) : "generico@generico.co";
                        $strDireccion = strClean($_POST['direccion']);
                        $intPais = intval($_POST['pais']) != 0 ? intval($_POST['pais']) : 99999;
                        $intDepartamento = isset($_POST['departamento']) && intval($_POST['departamento']) != 0   ? intval($_POST['departamento']) : 99999;
                        $intCiudad = isset($_POST['ciudad']) && intval($_POST['ciudad']) != 0 ? intval($_POST['ciudad']) : 99999;
                        $strContrasena = strClean($_POST['contrasena']);
                        $intRolId = 2;
                        $intEstado = intval($_POST['estado']);
                        $strTempContrasena =$strContrasena;
                        $request = "";
                        $intTipoDocumento = intval($_POST['tipo_documento']);
                        $strDocumento = strClean($_POST['documento']) !="" ? strClean($_POST['documento']) : "222222222";
                        $photo = "";
                        $photoProfile="";
                        $company = getCompanyInfo();
                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
    
                                $option = 1;
    
                                if($_FILES['txtImg']['name'] == ""){
                                    $photoProfile = "user.jpg";
                                }else{
                                    $photo = $_FILES['txtImg'];
                                    $photoProfile = 'profile_'.bin2hex(random_bytes(6)).'.png';
                                }
    
                                if($strContrasena !=""){
                                    $strContrasena =  hash("SHA256",$strContrasena);
                                }else{
                                    $strTempContrasena =bin2hex(random_bytes(4));
                                    $strContrasena =  hash("SHA256",$strTempContrasena);
                                }
    
                                $request_user = $this->model->insertCustomer(
                                    $strName, 
                                    $strLastName,
                                    $strIdentification,
                                    $photoProfile, 
                                    $intPhone, 
                                    $strEmail,
                                    $strAddress,
                                    $intCountry,
                                    $intState,
                                    $intCity,
                                    $strPassword,
                                    $intStatus,
                                    $intRolId
                                );
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
    
                                $option = 2;
                                $request = $this->model->selectCustomer($idUser);
    
                                if($_FILES['txtImg']['name'] == ""){
                                    $photoProfile = $request['image'];
                                }else{
                                    if($request['image'] != "user.jpg"){
                                        deleteFile($request['image']);
                                    }
                                    $photo = $_FILES['txtImg'];
                                    $photoProfile = 'profile_'.bin2hex(random_bytes(6)).'.png';
                                }
    
                                if($strPassword!=""){
                                    $strPassword =  hash("SHA256",$strPassword);
                                }
                                
                                $request_user = $this->model->updateCustomer(
                                    $idUser, 
                                    $strName, 
                                    $strLastName,
                                    $strIdentification,
                                    $photoProfile, 
                                    $intPhone, 
                                    $strEmail,
                                    $strAddress,
                                    $intCountry,
                                    $intState,
                                    $intCity,
                                    $strPassword, 
                                    $intStatus,
                                    $intRolId
                                );
                            }
                        }
    
                        if($request_user > 0 ){
                            if($photo!=""){
                                uploadImage($photo,$photoProfile);
                            }
                            
                            if($option == 1){
                                $data['nombreUsuario'] = $strName." ".$strLastName;
                                $data['asunto']="Credentials";
                                $data['email_usuario'] = $strEmail;
                                $data['email_remitente'] = $company['email'];
                                $data['password'] = $password;
                                $data['company'] = $company;
                                if($strEmail !="generico@generico.co"){
                                    sendEmail($data,"email_credentials");
                                }
                                $arrResponse = array("status"=>true,"msg"=>'Datos guardados. Se ha enviado un correo electrónico al usuario con las credenciales.');
                            }else{
                                if($strPassword!=""){
                                    $data['nombreUsuario'] = $strName." ".$strLastName;
                                    $data['asunto']="Credentials";
                                    $data['email_usuario'] = $strEmail;
                                    $data['email_remitente'] = $company['email'];
                                    $data['password'] = $password;
                                    $data['company'] = $company;
                                    if($strEmail !="generico@generico.co"){
                                        sendEmail($data,"email_passwordUpdated");
                                    }
                                    $arrResponse = array("status"=>true,"msg"=>'La contraseña ha sido actualizada, se ha enviado un correo electrónico con la nueva contraseña.');
                                }else{
                                    $arrResponse = array("status"=>true,"msg"=>'Datos actualizados');
                                }
                                
                            }
                        }else if($request_user == 'exist'){
                            $arrResponse = array('status' => false, 'msg' => '¡Atención! el correo electrónico, la identificación o el número de teléfono ya están registrados, pruebe con otro.');		
                        }else{
                            $arrResponse = array("status" => false, "msg" => 'No es posible guardar los datos.');
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
			die();
		}
        public function getEstados($params){
            $arrParams = explode(",",$params);
            $strTipo = $arrParams[0];
            $intId = $arrParams[1];
            if($strTipo == "estado"){$request = getDepartamentos($intId);}
            else{$request = getCiudades($intId);}
            echo json_encode($request,JSON_UNESCAPED_UNICODE);
        }
    }
?>