<?php 
    class CasosModel extends Mysql{
        private $intId;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strFecha;
        private $strBuscar;
        private $strMonedaBase;
        private $strMonedaObjetivo;
        private $intValorObjetivo;
        private $strTitulo;
        private $strDescripcion;
        private $intServicio;
        private $intCliente;
        private $strHora;
        private $intValorBase;
        private $strEstado;
        public function __construct(){
            parent::__construct();
        }
        public function selectServicios($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT p.*, c.name as category FROM service p INNER JOIN category c ON c.id = p.categoryid 
            WHERE p.status = 1 AND (p.name like '$this->strBuscar%' OR p.short_description like '$this->strBuscar%' OR c.name like '$this->strBuscar%') ORDER BY p.id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM service p INNER JOIN category c ON c.id = p.categoryid 
            WHERE p.status = 1 AND (p.name like '$this->strBuscar%' OR p.short_description like '$this->strBuscar%' OR c.name like '$this->strBuscar%') ORDER BY p.id DESC $limit"; 

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
        public function selectClientes($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT p.*,p.idperson as id,p.image as picture,
            DATE_FORMAT(p.date, '%d/%m/%Y') as date,
            co.name as pais,
            st.name as departamento,
            ci.name as ciudad,
            cp.phonecode,
            ty.name as tipo_documento,
            cu.code as currency,
            CONCAT('+',cp.phonecode,' ',p.phone) as telefono
            FROM person p
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            LEFT JOIN currency cu ON cp.shortname = cu.iso
            WHERE p.status = 1 AND p.roleid = 2 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%') 
            ORDER BY p.idperson DESC $limit";  

            $sqlTotal = "SELECT count(*) as total FROM person p
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            WHERE p.status = 1 AND p.roleid = 2 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%') 
            ORDER BY p.idperson DESC";

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
        public function selectCasos($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT ord.*,
            DATE_FORMAT(ord.date,'%d/%m/%Y') as date,
            co.name as pais,
            st.name as departamento,
            ci.name as ciudad,
            cp.phonecode,
            ty.name as tipo_documento,
            cu.code as currency,
            CONCAT('+',cp.phonecode,' ',p.phone) as telefono,
            serv.name as servicio,
            c.name as area,
            p.address,
            p.firstname,
            p.lastname,
            p.phone,
            p.phone_country,
            p.email,
            p.identification
            FROM orderdata ord
            LEFT JOIN person p ON p.idperson = ord.personid
            LEFT JOIN service serv ON ord.service_id = serv.id
            LEFT JOIN category c ON c.id = serv.categoryid 
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            LEFT JOIN currency cu ON cp.shortname = cu.iso
            WHERE p.status = 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%' OR serv.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%') 
            ORDER BY ord.idorder DESC $limit";  

            $sqlTotal = "SELECT count(*) as total FROM orderdata ord
            LEFT JOIN person p ON p.idperson = ord.personid
            LEFT JOIN service serv ON ord.service_id = serv.id
            LEFT JOIN category c ON c.id = serv.categoryid 
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            LEFT JOIN currency cu ON cp.shortname = cu.iso
            WHERE p.status = 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%' OR serv.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%') 
            ORDER BY ord.idorder DESC";

            $totalRecords = $this->select($sqlTotal)['total'];
            $totalPages = intval($totalRecords > 0 ? ceil($totalRecords/$this->intPorPagina) : 0);
            $totalPages = $totalPages == 0 ? 1 : $totalPages;
            $request = $this->select_all($sql);
            foreach ($request as &$data) {
                $strHora = date("h:i A", strtotime($data['time'])); // "09:23 PM"
                $data['date'] = $data['date'] . ' ' . $strHora;
            }
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
        public function selectCaso($intId){
            $this->intId = $intId;
            $sql = "SELECT * FROM orderdata WHERE idorder = $this->intId";
           
            $request = $this->select($sql);
            if(!empty($request)){
                $sqlCliente = "SELECT p.*,p.idperson as id,p.image as picture,
                DATE_FORMAT(p.date, '%d/%m/%Y') as date,
                co.name as pais,
                st.name as departamento,
                ci.name as ciudad,
                cp.phonecode,
                ty.name as tipo_documento,
                cu.code as currency,
                CONCAT('+',cp.phonecode,' ',p.phone) as telefono
                FROM person p
                LEFT JOIN countries co ON p.countryid = co.id
                LEFT JOIN states st ON p.stateid = st.id
                LEFT JOIN cities ci ON p.cityid = ci.id
                LEFT JOIN countries cp ON p.phone_country = cp.id
                LEFT JOIN document_type ty ON p.typeid = ty.id
                LEFT JOIN currency cu ON cp.shortname = cu.iso
                WHERE p.idperson = $request[personid] AND p.status = 1";


                $sqlServicio = "SELECT p.*, c.name as category 
                FROM service p INNER JOIN category c ON c.id = p.categoryid 
                WHERE p.status = 1 AND p.id = $request[service_id]";
                $request['cliente'] = $this->select($sqlCliente);
                $request['servicio'] = $this->select($sqlServicio);
            }
            return $request;
        }
        public function selectConversion($strMonedaBase,$strMonedaObjetivo){
            $this->strMonedaBase = $strMonedaBase;
            $this->strMonedaObjetivo = $strMonedaObjetivo;
            $request = $this->select("SELECT * FROM conversion WHERE code_base = '$this->strMonedaBase' AND code_target = '$this->strMonedaObjetivo'");
            return $request;
        }
        public function insertCaso($strTitulo,$strDescripcion,$intServicio,$intCliente,$strHora,$strFecha,
        $strMonedaBase,$strMonedaObjetivo,$intValorBase,$intValorObjetivo,$strEstado){
            $this->strTitulo = $strTitulo;
            $this->strDescripcion = $strDescripcion;
            $this->intServicio = $intServicio;
            $this->intCliente = $intCliente;
            $this->strHora = $strHora;
            $this->strFecha = $strFecha;
            $this->intValorBase = $intValorBase;
            $this->intValorObjetivo = $intValorObjetivo;
            $this->strMonedaBase = $strMonedaBase;
            $this->strMonedaObjetivo = $strMonedaObjetivo;
            $this->strEstado = $strEstado;
            $sql = "INSERT INTO orderdata(title,note,service_id,personid,time,date,value_base,value_target,currency_base,currency_target,status,statusorder)
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData =[
                $this->strTitulo,
                $this->strDescripcion,
                $this->intServicio,
                $this->intCliente, 
                $this->strHora,
                $this->strFecha, 
                $this->intValorBase,
                $this->intValorObjetivo,
                $this->strMonedaBase,
                $this->strMonedaObjetivo,
                "pendent",
                $this->strEstado,
            ];
            $request = $this->insert($sql,$arrData);
            return $request;
        }
        public function updateCaso($intId,$strTitulo,$strDescripcion,$intServicio,$intCliente,$strHora,$strFecha,
        $strMonedaBase,$strMonedaObjetivo,$intValorBase,$intValorObjetivo,$strEstado){
            $this->intId = $intId;
            $this->strTitulo = $strTitulo;
            $this->strDescripcion = $strDescripcion;
            $this->intServicio = $intServicio;
            $this->intCliente = $intCliente;
            $this->strHora = $strHora;
            $this->strFecha = $strFecha;
            $this->intValorBase = $intValorBase;
            $this->intValorObjetivo = $intValorObjetivo;
            $this->strMonedaBase = $strMonedaBase;
            $this->strMonedaObjetivo = $strMonedaObjetivo;
            $this->strEstado = $strEstado;
            $sql = "UPDATE orderdata SET title=?,note=?,service_id=?,personid=?,time=?,date=?,value_base=?,value_target=?,currency_base=?,currency_target=?,statusorder=?
            WHERE idorder = $this->intId";
            $arrData =[
                $this->strTitulo,
                $this->strDescripcion,
                $this->intServicio,
                $this->intCliente, 
                $this->strHora,
                $this->strFecha, 
                $this->intValorBase,
                $this->intValorObjetivo,
                $this->strMonedaBase,
                $this->strMonedaObjetivo,
                $this->strEstado,
            ];
            $request = $this->update($sql,$arrData);
            return $request;
        }
        public function insertConversion($strMonedaBase,$strMonedaObjetivo,$intValorObjetivo){
            $this->strMonedaBase = $strMonedaBase;
            $this->strMonedaObjetivo = $strMonedaObjetivo;
            $this->intValorObjetivo = $intValorObjetivo;
            $request = $this->insert("INSERT INTO conversion(code_base,code_target,target) VALUES(?,?,?)",[$this->strMonedaBase,$this->strMonedaObjetivo,$this->intValorObjetivo]);
            return $request;
        }
        public function updateConversion($intId,$intValorObjetivo,$strFecha){
            $this->intId = $intId;
            $this->intValorObjetivo = $intValorObjetivo;
            $this->strFecha = $strFecha;
            $request = $this->update("UPDATE conversion SET target=?,date=? WHERE id = $this->intId",[$this->intValorObjetivo,$this->strFecha]);
            return $request;
        }
        public function deleteCaso($id){
            $this->intId = $id;
            $sql = "DELETE FROM orderdata WHERE idorder = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }
    }
?>