<?php 
    class UsuariosModel extends Mysql{
        private $intId;
        private $strNombre; 
        private $strApellido;
        private $intTelefono;
        private $intPaisTelefono;
        private $strCorreo; 
        private $strDireccion; 
        private $intPais;
        private $intDepartamento;
        private $intCiudad;
        private $strContrasena;
        private $intEstado;
        private $intTipoDocumento;
        private $strDocumento;
        private $intRolId;
        private $strImagenNombre;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;

        public function __construct(){
            parent::__construct();
        }
        public function insertUsuario(string $strNombre, string $strApellido,string $intTelefono, string $intPaisTelefono, string $strCorreo, string $strDireccion, 
        int $intPais, int $intDepartamento, int $intCiudad,string $strContrasena,int $intEstado,$intTipoDocumento,string $strDocumento,int $intRolId,string $strImagenNombre){
            $this->strImagenNombre = $strImagenNombre;
			$this->strNombre = $strNombre;
			$this->strApellido = $strApellido;
            $this->strDocumento = $strDocumento;
            $this->intTipoDocumento = $intTipoDocumento;
            $this->strCorreo = $strCorreo;
			$this->intTelefono = $intTelefono;
            $this->intPaisTelefono = $intPaisTelefono;
            $this->strDireccion = $strDireccion;
            $this->intPais = $intPais;
            $this->intDepartamento = $intDepartamento;
            $this->intCiudad = $intCiudad;
            $this->strContrasena = $strContrasena;
            $this->intEstado = $intEstado;
            $this->intRolId = $intRolId;
            
			$return = 0;
            $sql= "SELECT * FROM person WHERE email = '{$this->strCorreo}' OR phone = '{$this->intTelefono}' OR identification = '{$this->strDocumento}'";
			$request = $this->select_all($sql);
			if(empty($request)){ 
				$sql  = "INSERT INTO person(image,firstname,lastname,email,phone,address,countryid,stateid,cityid,identification,password,status,roleid,typeid,phone_country) 
								  VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
	        	$arrData = array(
                    $this->strImagenNombre,
                    $this->strNombre,
                    $this->strApellido,
                    $this->strCorreo,
                    $this->intTelefono,
                    $this->strDireccion,
                    $this->intPais,
                    $this->intDepartamento,
                    $this->intCiudad,
                    $this->strDocumento,
                    $this->strContrasena,
                    $this->intEstado,
                    $this->intRolId,
                    $this->intTipoDocumento,
                    $this->intPaisTelefono,
        		);
	        	$return = $this->insert($sql,$arrData);
			}else{
				$return = "exist";
			}
	        return $return;
		}
        public function updateUsuario(int $intId,string $strNombre, string $strApellido,string $intTelefono, string $intPaisTelefono, string $strCorreo, string $strDireccion, 
        int $intPais, int $intDepartamento, int $intCiudad,string $strContrasena,int $intEstado,$intTipoDocumento,string $strDocumento,int $intRolId, $strImagenNombre){
            $this->intId = $intId;
            $this->strImagenNombre = $strImagenNombre;
			$this->strNombre = $strNombre;
			$this->strApellido = $strApellido;
            $this->strDocumento = $strDocumento;
            $this->intTipoDocumento = $intTipoDocumento;
            $this->strCorreo = $strCorreo;
			$this->intTelefono = $intTelefono;
            $this->intPaisTelefono = $intPaisTelefono;
            $this->strDireccion = $strDireccion;
            $this->intPais = $intPais;
            $this->intDepartamento = $intDepartamento;
            $this->intCiudad = $intCiudad;
            $this->strContrasena = $strContrasena;
            $this->intEstado = $intEstado;
            $this->intRolId = $intRolId;

            $sql= "SELECT * FROM person WHERE (identification = '{$this->strDocumento}' OR phone = '{$this->intTelefono}' OR email = '{$this->strCorreo}') AND  idperson != $this->intId";
            $request = $this->select_all($sql);
            
			if(empty($request)){
				if($this->strContrasena  != ""){
					$sql = "UPDATE person SET image=?, firstname=?, lastname=?,email=?, phone=?,address=?,countryid=?,stateid=?,cityid=?,identification=?, 
                    password=?, status=?,roleid=?,typeid=?,phone_country=? 
                    WHERE idperson = $this->intId";
					$arrData = array(
                        $this->strImagenNombre,
                        $this->strNombre,
                        $this->strApellido,
                        $this->strCorreo,
                        $this->intTelefono,
                        $this->strDireccion,
                        $this->intPais,
                        $this->intDepartamento,
                        $this->intCiudad,
                        $this->strDocumento,
                        $this->strContrasena,
                        $this->intEstado,
                        $this->intRolId,
                        $this->intTipoDocumento,
                        $this->intPaisTelefono,
                    );
				}else{
					$sql = "UPDATE person SET image=?, firstname=?, lastname=?,email=?, phone=?,address=?,countryid=?,stateid=?,cityid=?,identification=?,status=?,roleid=? 
							,typeid=?,phone_country=? 
                            WHERE idperson = $this->intId";
					$arrData = array(
                        $this->strImagenNombre,
                        $this->strNombre,
                        $this->strApellido,
                        $this->strCorreo,
                        $this->intTelefono,
                        $this->strDireccion,
                        $this->intPais,
                        $this->intDepartamento,
                        $this->intCiudad,
                        $this->strDocumento,
                        $this->intEstado,
                        $this->intRolId,
                        $this->intTipoDocumento,
                        $this->intPaisTelefono,
                    );
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		
		}
        public function selectUsuarios($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT p.*,p.idperson as id,
            DATE_FORMAT(p.date, '%d/%m/%Y') as date,
            co.name as pais,
            st.name as departamento,
            ci.name as ciudad,
            cp.phonecode,
            r.name as role,
            ty.name as tipo_documento,
            CONCAT('+',cp.phonecode,' ',p.phone) as telefono
            FROM person p
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            LEFT JOIN role r ON r.idrole = p.roleid 
            WHERE p.roleid != 2 AND p.idperson != 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%') 
            ORDER BY p.idperson DESC $limit";  

            $sqlTotal = "SELECT count(*) as total FROM person p
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            LEFT JOIN role r ON r.idrole = p.roleid 
            WHERE p.roleid != 2 AND p.idperson != 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%') 
            ORDER BY p.idperson";

            $totalRecords = $this->select($sqlTotal)['total'];
            $totalPages = intval($totalRecords > 0 ? ceil($totalRecords/$this->intPorPagina) : 0);
            $totalPages = $totalPages == 0 ? 1 : $totalPages;
            $request = $this->select_all($sql);

            $startPage = max(1, $this->intPaginaActual - floor(BUTTONS / 2));
            if ($startPage + BUTTONS - 1 > $totalPages) {
                $startPage = max(1, $totalPages - BUTTONS + 1);
            }
            $limitPages = min($startPage + BUTTONS, $totalPages+1);
            $arrData = array(
                "data"=>$request,
                "start_page"=>$startPage,
                "limit_page"=>$limitPages,
                "total_pages"=>$totalPages,
                "total_records"=>$totalRecords,
            );
            return $arrData;
        }
        public function selectUsuario(int $intId){
            $this->intId = $intId;
            $sql = "SELECT * FROM person WHERE idperson = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function deleteUsuario($id){
            $this->intId = $id;
            $sql = "DELETE FROM person WHERE idperson = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }
        public function selectRoles(){
            $sql = "SELECT * FROM role ORDER BY name";
            $request = $this->select_all($sql);
            return $request;
        }
        /*************************Profile methods*******************************/
        public function updateProfile(int $intId,string $strNombre, string $strApellido,string $intTelefono, string $intPaisTelefono, string $strCorreo, string $strDireccion, 
        int $intPais, int $intDepartamento, int $intCiudad,string $strContrasena,$intTipoDocumento,string $strDocumento, $strImagenNombre){
            $this->intId = $intId;
            $this->strImagenNombre = $strImagenNombre;
			$this->strNombre = $strNombre;
			$this->strApellido = $strApellido;
            $this->strDocumento = $strDocumento;
            $this->intTipoDocumento = $intTipoDocumento;
            $this->strCorreo = $strCorreo;
			$this->intTelefono = $intTelefono;
            $this->intPaisTelefono = $intPaisTelefono;
            $this->strDireccion = $strDireccion;
            $this->intPais = $intPais;
            $this->intDepartamento = $intDepartamento;
            $this->intCiudad = $intCiudad;
            $this->strContrasena = $strContrasena;

            $sql= "SELECT * FROM person WHERE (identification = '{$this->strDocumento}' OR phone = '{$this->intTelefono}' OR email = '{$this->strCorreo}') AND  idperson != $this->intId";
            $request = $this->select_all($sql);
            
			if(empty($request)){
				if($this->strContrasena  != ""){
					$sql = "UPDATE person SET image=?, firstname=?, lastname=?,email=?, phone=?,address=?,countryid=?,stateid=?,cityid=?,identification=?, 
                    password=?,typeid=?,phone_country=? 
                    WHERE idperson = $this->intId";
					$arrData = array(
                        $this->strImagenNombre,
                        $this->strNombre,
                        $this->strApellido,
                        $this->strCorreo,
                        $this->intTelefono,
                        $this->strDireccion,
                        $this->intPais,
                        $this->intDepartamento,
                        $this->intCiudad,
                        $this->strDocumento,
                        $this->strContrasena,
                        $this->intTipoDocumento,
                        $this->intPaisTelefono,
                    );
				}else{
					$sql = "UPDATE person SET image=?, firstname=?, lastname=?,email=?, phone=?,address=?,countryid=?,stateid=?,cityid=?,
                    identification=?,typeid=?,phone_country=? 
                    WHERE idperson = $this->intId";
					$arrData = array(
                        $this->strImagenNombre,
                        $this->strNombre,
                        $this->strApellido,
                        $this->strCorreo,
                        $this->intTelefono,
                        $this->strDireccion,
                        $this->intPais,
                        $this->intDepartamento,
                        $this->intCiudad,
                        $this->strDocumento,
                        $this->intTipoDocumento,
                        $this->intPaisTelefono,
                    );
				}
				$request = $this->update($sql,$arrData);
			}else{
				$request = "exist";
			}
			return $request;
		}
        public function selectCountries(){
            $sql = "SELECT * FROM countries WHERE id = 47";
            $request = $this->select($sql);
            return $request;
        }
        public function selectStates($id){
            $sql = "SELECT * FROM states WHERE country_id = $id";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectCities($id){
            $sql = "SELECT * FROM cities WHERE state_id = $id";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>