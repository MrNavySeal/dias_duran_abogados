<?php 
    class MensajesModel extends Mysql{
        private $strMessage;
        private $intIdMessage;
        private $strEmail;
        private $strSubject;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;
        public function __construct(){
            parent::__construct();
        }
        /*************************Mailbox methods*******************************/
        public function selectMensajes($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            
            $sql = "SELECT cab.* ,DATE_FORMAT(cab.date, '%d/%m/%Y') as date, 
            CONCAT('+',cp.phonecode,' ',cab.phone) as telefono,
            serv.name as asunto,
            co.name as pais,
            st.name as departamento,
            ci.name as ciudad,
            cp.phonecode
            FROM contact cab
            LEFT JOIN service serv ON cab.service_id = serv.id
            LEFT JOIN countries co ON cab.countryid = co.id
            LEFT JOIN states st ON cab.stateid = st.id
            LEFT JOIN cities ci ON cab.cityid = ci.id
            LEFT JOIN countries cp ON cab.phone_country = cp.id
            ORDER BY cab.id DESC $limit";  

            $sqlTotal = "SELECT cab.* FROM contact cab
            LEFT JOIN service serv ON cab.service_id = serv.id
            LEFT JOIN countries co ON cab.countryid = co.id
            LEFT JOIN states st ON cab.stateid = st.id
            LEFT JOIN cities ci ON cab.cityid = ci.id
            LEFT JOIN countries cp ON cab.phone_country = cp.id
            ORDER BY cab.id DESC";

            $request = $this->select_all($sql);
            $requestFull = $this->select_all($sqlTotal);
            $totalRecords = count($requestFull);
            $totalPages = intval($totalRecords > 0 ? ceil($totalRecords/$this->intPorPagina) : 0);
            $totalPages = $totalPages == 0 ? 1 : $totalPages;
            

            $startPage = max(1, $this->intPaginaActual - floor(BUTTONS / 2));
            if ($startPage + BUTTONS - 1 > $totalPages) {
                $startPage = max(1, $totalPages - BUTTONS + 1);
            }
            $limitPages = min($startPage + BUTTONS, $totalPages+1);
            $arrData = array(
                "data"=>$request,
                "full_data"=>$requestFull,
                "start_page"=>$startPage,
                "limit_page"=>$limitPages,
                "total_pages"=>$totalPages,
                "total_records"=>$totalRecords,
            );
            return $arrData;
        }
        public function selectEnviados($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            
            $sql = "SELECT * ,DATE_FORMAT(date, '%d/%m/%Y') as date 
            FROM sendmessage ORDER BY id DESC $limit";  
            $sqlTotal = "SELECT * FROM sendmessage  ORDER BY id DESC";

            $request = $this->select_all($sql);
            $requestFull = $this->select_all($sqlTotal);
            $totalRecords = count($requestFull);
            $totalPages = intval($totalRecords > 0 ? ceil($totalRecords/$this->intPorPagina) : 0);
            $totalPages = $totalPages == 0 ? 1 : $totalPages;
            

            $startPage = max(1, $this->intPaginaActual - floor(BUTTONS / 2));
            if ($startPage + BUTTONS - 1 > $totalPages) {
                $startPage = max(1, $totalPages - BUTTONS + 1);
            }
            $limitPages = min($startPage + BUTTONS, $totalPages+1);
            $arrData = array(
                "data"=>$request,
                "full_data"=>$requestFull,
                "start_page"=>$startPage,
                "limit_page"=>$limitPages,
                "total_pages"=>$totalPages,
                "total_records"=>$totalRecords,
            );
            return $arrData;
        }
        public function selectSentMails(){
            $sql = "SELECT * ,DATE_FORMAT(date, '%d/%m/%Y') as date FROM sendmessage ORDER BY id DESC";       
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectMail(int $id){
            $this->update("UPDATE contact SET status=? WHERE id = $id",[1]);

            $sql = "SELECT cab.* ,DATE_FORMAT(cab.date, '%d/%m/%Y') as date, 
            DATE_FORMAT(cab.date_updated, '%d/%m/%Y') as date_updated, 
            CONCAT('+',cp.phonecode,' ',cab.phone) as telefono,
            serv.name as asunto,
            co.name as pais,
            st.name as departamento,
            ci.name as ciudad,
            cp.phonecode
            FROM contact cab
            LEFT JOIN service serv ON cab.service_id = serv.id
            LEFT JOIN countries co ON cab.countryid = co.id
            LEFT JOIN states st ON cab.stateid = st.id
            LEFT JOIN cities ci ON cab.cityid = ci.id
            LEFT JOIN countries cp ON cab.phone_country = cp.id
            WHERE cab.id=$id";
            $request = $this->select($sql);
            return $request;
        }
        public function selectSentMail(int $id){
            $sql = "SELECT *, DATE_FORMAT(date, '%d/%m/%Y') as date FROM sendmessage WHERE id=$id";
            $request = $this->select($sql);
            return $request;
        }
        public function updateMessage($strMessage,$idMessage){
            $this->strMessage = $strMessage;
            $this->intIdMessage = $idMessage;
            $sql = "UPDATE contact SET reply=?, date_updated=NOW() WHERE id = $this->intIdMessage";
            $arrData = array($this->strMessage);
            $request = $this->update($sql,$arrData);
            return $request;
        }
        public function insertMessage($strSubject,$strEmail,$strMessage){
            $this->strMessage = $strMessage;
            $this->strEmail = $strEmail;
            $this->strSubject = $strSubject;

            $sql = "INSERT INTO sendmessage(email,subject,message) VALUES(?,?,?)";
            $arrData = array($this->strEmail,$this->strSubject,$this->strMessage);
            $request = $this->insert($sql,$arrData);
            return $request;
        }
        public function delEmail($id,$option){
            $sql ="";
            if($option == "recibidos"){
                $sql = "DELETE FROM contact WHERE id =$id";
            }else{
                $sql = "DELETE FROM sendmessage WHERE id =$id";
            }
            $request = $this->delete($sql);
            return $request;
        }
    }
?>