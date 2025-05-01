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
        public function getCustomers($option=null,$params=null){
            
            if(empty($_SESSION['permitsModule']['r'])){
                header("location: ".base_url());
            }
            $request = $this->model->selectCustomers();
            if(count($request)>0){
                for ($i=0; $i < count($request); $i++) { 

                    $btnEdit="";
                    $btnDelete="";
                    $btnView = '<button class="btn btn-info m-1 text-white" type="button" title="Ver" onclick="viewItem('.$request[$i]['idperson'].')" ><i class="fas fa-eye"></i></button>';
                    
                    if($_SESSION['permitsModule']['u'] && $request[$i]['roleid'] != 1 || $_SESSION['idUser'] == 1){
                        $btnEdit = '<button class="btn btn-success m-1" type="button" title="Editar" onclick="editItem('.$request[$i]['idperson'].')" ><i class="fas fa-pencil-alt"></i></button>';
                    }
                    if($_SESSION['permitsModule']['d'] && $request[$i]['roleid'] != 1 || $_SESSION['idUser'] == 1){
                        $btnDelete = '<button class="btn btn-danger m-1" type="button" title="Eliminar" onclick="deleteItem('.$request[$i]['idperson'].')" ><i class="fas fa-trash-alt"></i></button>';
                    }
                    if($request[$i]['status']==1){
                        $status='<span class="badge me-1 bg-success">Activo</span>';
                    }else{
                        $status='<span class="badge me-1 bg-danger">Inactivo</span>';
                    }
                    $request[$i]['fullname'] = $request[$i]['firstname']." ".$request[$i]['lastname'];
                    $request[$i]['options'] = $btnView.$btnEdit.$btnDelete;
                    $request[$i]['status'] = $status;
                }
                echo json_encode($request,JSON_UNESCAPED_UNICODE);
            }
            die();
        }
        public function getCustomer(){
            if($_SESSION['permitsModule']['r']){

                if($_POST){
                    if(empty($_POST)){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $idUser = intval($_POST['idUser']);
                        $request = $this->model->selectCustomer($idUser);
                        if(!empty($request)){
                            $request['image'] = media()."/images/uploads/".$request['image'];
                            $countries = $this->model->selectCountries();
                            $states = $this->model->selectStates($request['countryid']);
                            $cities = $this->model->selectCities($request['stateid']);

                            $countrieshtml='';
                            if($request['countryid'] == $countries['id']){
                                $countrieshtml.='<option value="0">Seleccione</option><option value="'.$countries['id'].'" selected>'.$countries['name'].'</option>';
                            }else{
                                $countrieshtml.='<option value="0" selected>Seleccione</option><option value="'.$countries['id'].'">'.$countries['name'].'</option>';
                            }

                            $stateshtml="";
                            $citieshtml="";

                            for ($i=0; $i < count($states) ; $i++) { 
                                if($request['stateid'] == $states[$i]['id']){
                                    $stateshtml.='<option value="'.$states[$i]['id'].'" selected>'.$states[$i]['name'].'</option>';
                                    
                                }else{
                                    $stateshtml.='<option value="'.$states[$i]['id'].'">'.$states[$i]['name'].'</option>';
                                }
                            }
                            for ($i=0; $i < count($cities) ; $i++) { 
                                if($request['cityid'] == $cities[$i]['id']){
                                    $citieshtml.='<option value="'.$cities[$i]['id'].'" selected>'.$cities[$i]['name'].'</option>';
                                }else{
                                    $citieshtml.='<option value="'.$cities[$i]['id'].'">'.$cities[$i]['name'].'</option>';
                                }
                            }
                            $arrResponse = array("status"=>true,"data"=>$request,"countries"=>$countrieshtml,"states"=>$stateshtml,"cities"=>$citieshtml);
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"Error, intenta de nuevo."); 
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }else{
                header("location: ".base_url());
                die();
            }
            die();
        }
        public function setCustomer(){
            if(empty($_SESSION['permitsModule']['r'])){
                header("location: ".base_url());
            }
            if($_POST){
                if(empty($_POST['txtFirstName']) || empty($_POST['txtLastName']) || empty($_POST['txtPhone']) || empty($_POST['statusList'])){
                    $arrResponse = array("status" => false, "msg" => 'Error de datos');
                }else{ 
                    $idUser = intval($_POST['idUser']);
                    $strName = ucwords(strClean($_POST['txtFirstName']));
                    $strLastName = ucwords(strClean($_POST['txtLastName']));
                    $intPhone = intval(strClean($_POST['txtPhone']));
                    $strEmail = $_POST['txtEmail'] != "" ? strtolower(strClean($_POST['txtEmail'])) : "generico@generico.co";
                    $strAddress = strClean($_POST['txtAddress']);
                    $intCountry = intval($_POST['listCountry']) != 0 ? intval($_POST['listCountry']) : 99999;
                    $intState = isset($_POST['listState']) && intval($_POST['listState']) != 0   ? intval($_POST['listState']) : 99999;
                    $intCity = isset($_POST['listState']) && intval($_POST['listCity']) != 0 ? intval($_POST['listCity']) : 99999;
                    $strPassword = strClean($_POST['txtPassword']);
                    $intRolId = 2;
                    $intStatus = intval($_POST['statusList']);
                    $password =$strPassword;
                    $request_user = "";
                    $strIdentification = strClean($_POST['txtDocument']) !="" ? strClean($_POST['txtDocument']) : "222222222";
                    $photo = "";
                    $photoProfile="";
                    $company = getCompanyInfo();
                    if($idUser == 0){
                        if($_SESSION['permitsModule']['w']){

                            $option = 1;

                            if($_FILES['txtImg']['name'] == ""){
                                $photoProfile = "user.jpg";
                            }else{
                                $photo = $_FILES['txtImg'];
                                $photoProfile = 'profile_'.bin2hex(random_bytes(6)).'.png';
                            }

                            if($strPassword !=""){
                                $strPassword =  hash("SHA256",$strPassword);
                            }else{
                                $password =bin2hex(random_bytes(4));
                                $strPassword =  hash("SHA256",$password);
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
			die();
		}
        public function delCustomer(){
            if($_SESSION['permitsModule']['d']){
                if($_POST){
                    if(empty($_POST['idUser'])){
                        $arrResponse=array("status"=>false,"Error de datos.");
                    }else{
                        $id = intval($_POST['idUser']);
                        
                        $request = $this->model->selectCustomer($id);
                        if($request['image'] !="user.jpg"){
                            deleteFile($request['image']);
                        }
                        $request = $this->model->deleteCustomer($id);
                        if($request=="ok"){
                            $arrResponse = array("status"=>true,"msg"=>"Se ha eliminado.");
                        }else{
                            $arrResponse = array("status"=>false,"msg"=>"No es posible eliminar, intenta de nuevo.");
                        }
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function getCountries(){
            $request = $this->model->selectCountries();
            $html='
            <option value="0" selected>Seleccione</option>
            <option value="'.$request['id'].'">'.$request['name'].'</option>
            ';
            echo json_encode($html,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getSelectCountry($id){
            $request = $this->model->selectStates($id);
            $html='<option value="0" selected>Seleccione</option>';
            for ($i=0; $i < count($request) ; $i++) { 
                $html.='<option value="'.$request[$i]['id'].'">'.$request[$i]['name'].'</option>';
            }
            echo json_encode($html,JSON_UNESCAPED_UNICODE);
            die();
        }
        public function getSelectState($id){
            $request = $this->model->selectCities($id);
            $html='<option value="0" selected>Seleccione</option>';
            for ($i=0; $i < count($request) ; $i++) { 
                $html.='<option value="'.$request[$i]['id'].'">'.$request[$i]['name'].'</option>';
            }
            echo json_encode($html,JSON_UNESCAPED_UNICODE);
            die();
        }

    }
?>