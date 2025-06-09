<?php
    class Usuarios extends Controllers{

        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(2);
        }
        public function usuarios(){
            if($_SESSION['permitsModule']['r']){
                $data['botones'] = [
                    "duplicar" => ["mostrar"=>$_SESSION['permitsModule']['r'] ? true : false, "evento"=>"onClick","funcion"=>"mypop=window.open('".BASE_URL."/usuarios"."','','');mypop.focus();"],
                    "nuevo" => ["mostrar"=>$_SESSION['permitsModule']['w'] ? true : false, "evento"=>"@click","funcion"=>"showModal()"],
                ];
                $data['page_tag'] = "";
                $data['page_title'] = "Usuarios";
                $data['page_name'] = "";
                $data['panelapp'] = "functions_usuarios.js";
                $this->views->getView($this,"usuarios",$data);
            }else{
                header("location: ".base_url());
                die();
            }
        }
        public function getDatosIniciales(){
            if($_SESSION['permitsModule']['r']){
                $arrResponse = array(
                    "paises"=>getPaises(),
                    "tipos_documento"=>getTiposDocumento(),
                    "roles"=>$this->model->selectRoles()
                );
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function setUsuario(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['tipo_documento']) || empty($_POST['documento'])
                    || empty($_POST['correo']) || empty($_POST['pais']) || empty($_POST['departamento']) || empty($_POST['ciudad'])
                    || empty($_POST['pais_telefono']) || empty($_POST['telefono'])
                    ){
                        $arrResponse = array("status" => false, "msg" => 'Todos los campos con (*) son obligatorios');
                    }else{ 
                        $intId = intval($_POST['id']);
                        $strNombre = ucwords(strClean($_POST['nombre']));
                        $strApellido = ucwords(strClean($_POST['apellido']));
                        $intTelefono = doubleval(strClean($_POST['telefono']));
                        $intPaisTelefono = doubleval(strClean($_POST['pais_telefono']));
                        $strCorreo = $_POST['correo'] != "" ? strtolower(strClean($_POST['correo'])) : "generico@generico.co";
                        $strDireccion = strClean($_POST['direccion']);
                        $intPais = intval($_POST['pais']) != 0 ? intval($_POST['pais']) : 99999;
                        $intDepartamento = isset($_POST['departamento']) && intval($_POST['departamento']) != 0   ? intval($_POST['departamento']) : 99999;
                        $intCiudad = isset($_POST['ciudad']) && intval($_POST['ciudad']) != 0 ? intval($_POST['ciudad']) : 99999;
                        $strContrasena = strClean($_POST['contrasena']);
                        $intRolId = intval($_POST['rol']);
                        $intEstado = intval($_POST['estado']);
                        $strTempContrasena =$strContrasena;
                        $request = "";
                        $intTipoDocumento = intval($_POST['tipo_documento']);
                        $strDocumento = strClean($_POST['documento']) !="" ? strClean($_POST['documento']) : "222222222";
                        $strImagen = "";
                        $strImagenNombre="";
                        $company = getCompanyInfo();
                        if($intId == 0){
                            if($_SESSION['permitsModule']['w']){
    
                                $option = 1;
    
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = "user.jpg";
                                }else{
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'profile_'.bin2hex(random_bytes(6)).'.png';
                                }
    
                                if($strContrasena !=""){
                                    $strContrasena =  hash("SHA256",$strContrasena);
                                }else{
                                    $strTempContrasena =bin2hex(random_bytes(4));
                                    $strContrasena =  hash("SHA256",$strTempContrasena);
                                }
    
                                $request = $this->model->insertUsuario(
                                    $strNombre, 
                                    $strApellido,
                                    $intTelefono,
                                    $intPaisTelefono,
                                    $strCorreo, 
                                    $strDireccion, 
                                    $intPais,
                                    $intDepartamento,
                                    $intCiudad,
                                    $strContrasena,
                                    $intEstado,
                                    $intTipoDocumento,
                                    $strDocumento,
                                    $intRolId,
                                    $strImagenNombre,
                                );
                            }
                        }else{
                            if($_SESSION['permitsModule']['u']){
    
                                $option = 2;
                                $request = doubleval($this->model->selectUsuario($intId));
    
                                if($_FILES['imagen']['name'] == ""){
                                    $strImagenNombre = $request['image'] != "" ? $request['image'] :"user.jpg";
                                }else{
                                    if($request['image'] != "user.jpg"){
                                        deleteFile($request['image']);
                                    }
                                    $strImagen = $_FILES['imagen'];
                                    $strImagenNombre = 'profile_'.bin2hex(random_bytes(6)).'.png';
                                }
                                if($strContrasena!=""){ $strContrasena =  hash("SHA256",$strContrasena); }
                                
                                $request = doubleval($this->model->updateUsuario(
                                    $intId, 
                                    $strNombre, 
                                    $strApellido,
                                    $intTelefono,
                                    $intPaisTelefono,
                                    $strCorreo, 
                                    $strDireccion, 
                                    $intPais,
                                    $intDepartamento,
                                    $intCiudad,
                                    $strContrasena,
                                    $intEstado,
                                    $intTipoDocumento,
                                    $strDocumento,
                                    $intRolId,
                                    $strImagenNombre,
                                ));
                            }
                        }
                        if(is_numeric($request) && $request > 0){
                            if($strImagen!=""){
                                uploadImage($strImagen,$strImagenNombre);
                            }
                            if($option == 1){
                                $data['nombreUsuario'] = $strNombre." ".$strApellido;
                                $data['asunto']="Credenciales";
                                $data['email_usuario'] = $strCorreo;
                                $data['email_remitente'] = $company['email'];
                                $data['password'] = $strTempContrasena;
                                $data['company'] = $company;
                                if($strCorreo !="generico@generico.co"){
                                    try { sendEmail($data,"email_credentials"); } catch (\Throwable $th) {}
                                    
                                }
                                $arrResponse = array("status"=>true,"msg"=>'Datos guardados. Se ha enviado un correo electrónico al usuario con las credenciales.');
                            }else{
                                if($strContrasena!=""){
                                    $data['nombreUsuario'] = $strNombre." ".$strApellido;
                                    $data['asunto']="Credenciales";
                                    $data['email_usuario'] = $strCorreo;
                                    $data['email_remitente'] = $company['email'];
                                    $data['password'] = $strTempContrasena;
                                    $data['company'] = $company;
                                    if($strCorreo !="generico@generico.co"){
                                        try { sendEmail($data,"email_passwordUpdated"); } catch (\Throwable $th) {}
                                    }
                                    $arrResponse = array("status"=>true,"msg"=>'La contraseña ha sido actualizada, se ha enviado un correo electrónico con la nueva contraseña.');
                                }else{
                                    $arrResponse = array("status"=>true,"msg"=>'Datos actualizados');
                                }
                                
                            }
                        }else if($request == 'exist'){
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
        public function getBuscar(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $intPorPagina = intval($_POST['paginas']);
                    $intPaginaActual = intval($_POST['pagina']);
                    $strBuscar = clear_cadena(strClean($_POST['buscar']));
                    $request = $this->model->selectUsuarios($intPorPagina,$intPaginaActual, $strBuscar);
                    if(!empty($request)){
                        foreach ($request['data'] as &$data) { 
                            if(isset($data['image'])){ $data['url'] = media()."/images/uploads/".$data['image'];}
                            $data['edit'] = $_SESSION['permitsModule']['u'];
                            $data['delete'] = $_SESSION['permitsModule']['d'];
                        }
                    }
                    echo json_encode($request,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getDatos(){
            if($_SESSION['permitsModule']['r']){
                if($_POST){
                    $intId = intval($_POST['id']);
                    $request = $this->model->selectUsuario($intId);
                    if(!empty($request)){
                        if(isset($request['image'])){$request['url'] = media()."/images/uploads/".$request['image'];}
                        $arrResponse = array("status"=>true,"data"=>$request);
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"Error, intenta de nuevo"); 
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
        public function delDatos(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    $intId = intval($_POST['id']);
                    $request = $this->model->selectUsuario($intId);
                    if($request['image']!="user.jpg"){ deleteFile($request['image']); }
                    $request = $this->model->deleteUsuario($intId);
                    if($request > 0 || $request == "ok"){
                        $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado correctamente.");
                    }else{
                        $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        /*************************Profile methods*******************************/
        public function perfil(){
            $data['page_tag'] = "Perfil";
            $data['page_title'] = "Perfil";
            $data['page_name'] = "perfil";
            $data['panelapp'] = "functions_perfil.js";
            $this->views->getView($this,"perfil",$data);
        }
        public function getPerfil(){
            $request = $_SESSION['userData'];
            if(isset($request['image'])){$request['url'] = media()."/images/uploads/".$request['image'];}
            $arrResponse = array(
                "paises"=>getPaises(),
                "tipos_documento"=>getTiposDocumento(),
                "data"=>$request
            );
            echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function updatePerfil(){
            if($_POST){
                if(empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['tipo_documento']) || empty($_POST['documento'])
                    || empty($_POST['correo']) || empty($_POST['pais']) || empty($_POST['departamento']) || empty($_POST['ciudad'])
                    || empty($_POST['pais_telefono']) || empty($_POST['telefono'])
                    ){
                        $arrResponse = array("status" => false, "msg" => 'Todos los campos con (*) son obligatorios');
                    }else{ 
                    $intId = intval($_POST['id']);
                    $strNombre = ucwords(strClean($_POST['nombre']));
                    $strApellido = ucwords(strClean($_POST['apellido']));
                    $intTelefono = doubleval(strClean($_POST['telefono']));
                    $intPaisTelefono = doubleval(strClean($_POST['pais_telefono']));
                    $strCorreo = $_POST['correo'] != "" ? strtolower(strClean($_POST['correo'])) : "generico@generico.co";
                    $strDireccion = strClean($_POST['direccion']);
                    $intPais = intval($_POST['pais']) != 0 ? intval($_POST['pais']) : 99999;
                    $intDepartamento = isset($_POST['departamento']) && intval($_POST['departamento']) != 0   ? intval($_POST['departamento']) : 99999;
                    $intCiudad = isset($_POST['ciudad']) && intval($_POST['ciudad']) != 0 ? intval($_POST['ciudad']) : 99999;
                    $strContrasena = strClean($_POST['contrasena']);
                    $request = "";
                    $intTipoDocumento = intval($_POST['tipo_documento']);
                    $strDocumento = strClean($_POST['documento']) !="" ? strClean($_POST['documento']) : "222222222";
                    $strImagen = "";
                    $strImagenNombre="";

                    $request = $this->model->selectUsuario($intId);
                    if($_FILES['imagen']['name'] == ""){
                        $strImagenNombre = $request['image'] != "" ? $request['image'] :"user.jpg";
                    }else{
                        if($request['image'] != "user.jpg"){
                            deleteFile($request['image']);
                        }
                        $strImagen = $_FILES['imagen'];
                        $strImagenNombre = 'profile_'.bin2hex(random_bytes(6)).'.png';
                    }
                    
                    if($strContrasena!=""){ $strContrasena =  hash("SHA256",$strContrasena); }    
                    $request = doubleval($this->model->updateProfile(
                        $intId, 
                        $strNombre, 
                        $strApellido,
                        $intTelefono,
                        $intPaisTelefono,
                        $strCorreo, 
                        $strDireccion, 
                        $intPais,
                        $intDepartamento,
                        $intCiudad,
                        $strContrasena,
                        $intTipoDocumento,
                        $strDocumento,
                        $strImagenNombre,
                    ));
                        
                    if($request > 0 ){
                        if($strImagen!=""){
                            uploadImage($strImagen,$strImagenNombre);
                        }
                        resetUserData();
                        $arrResponse = array('status' => true, 'msg' => 'Datos actualizados');
                    }else if($request == 'exist'){
                        $arrResponse = array('status' => false, 'msg' => '¡Atención! el correo electrónico, la cédula o el número de teléfono ya están registrados, pruebe con otro.');		
                    }else{
                        $arrResponse = array("status" => false, "msg" => 'No es posible guardar los datos');
                    }
                }
                echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
    }
?>