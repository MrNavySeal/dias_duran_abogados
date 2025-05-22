<?php 
    class CasosModel extends Mysql{
        private $intId;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;
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
            WHERE p.status = 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
            OR p.address like '$this->strBuscar%' OR co.name like '$this->strBuscar%' OR st.name like '$this->strBuscar%' 
            OR ci.name like '$this->strBuscar%' OR ty.name like '$this->strBuscar%') 
            ORDER BY p.idperson DESC $limit";  

            $sqlTotal = "SELECT count(*) as total FROM person p
            LEFT JOIN countries co ON p.countryid = co.id
            LEFT JOIN states st ON p.stateid = st.id
            LEFT JOIN cities ci ON p.cityid = ci.id
            LEFT JOIN countries cp ON p.phone_country = cp.id
            LEFT JOIN document_type ty ON p.typeid = ty.id
            WHERE p.status = 1 AND (CONCAT(p.firstname,p.lastname) like '$this->strBuscar%' OR p.phone like '$this->strBuscar%' 
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
    }
?>