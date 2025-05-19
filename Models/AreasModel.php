<?php
    class AreasModel extends Mysql{
        private $intId;
		private $strNombre;
		private $intEstado;
        private $strImagen;
        private $strDescripcion;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;
        private $strDescripcionCorta;
        private $strRuta;
        private $intArea;

        public function __construct(){
            parent::__construct();
        }

        //Areas
        public function selectAreas($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT * FROM category WHERE name like '$this->strBuscar%' OR short_description like '$this->strBuscar%' ORDER BY id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM category WHERE name like '$this->strBuscar%' OR short_description like '$this->strBuscar%' ORDER BY id DESC";

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
        public function selectArea($id){
            $this->intId = $id;
            $sql = "SELECT * FROM category WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertArea(string $strNombre,string $strDescripcion,string $strDescripcionCorta,int $intEstado, string $strRuta,string $strImagen){
			$this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $sql  = "INSERT INTO category(picture,status,name,short_description,description,route)  VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->strRuta,
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateArea(int $intId,string $strNombre,string $strDescripcion,string $strDescripcionCorta,int $intEstado, string $strRuta,string $strImagen){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $sql = "UPDATE category SET picture=?,status=?,name=?, short_description=?,description=?, route=? WHERE id = $this->intId";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->strRuta,
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteArea($id){
            $this->intId = $id;
            $sql = "SELECT categoryid FROM service WHERE categoryid = $this->intId";
            $request = $this->select_all($sql);
            if(empty($request)){
                $sql = "DELETE FROM category WHERE id = $this->intId";
                $request = $this->delete($sql);
            }else{
                $request = "existe";
            }
            return $request;
        }

        //Servicios
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
            WHERE p.name like '$this->strBuscar%' OR p.short_description like '$this->strBuscar%' OR c.name like '$this->strBuscar%' ORDER BY p.id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM service p INNER JOIN category c ON c.id = p.categoryid 
            WHERE p.name like '$this->strBuscar%' OR p.short_description like '$this->strBuscar%' OR c.name like '$this->strBuscar%' ORDER BY p.id DESC $limit"; 

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
        public function selectServicio($id){
            $this->intId = $id;
            $sql = "SELECT * FROM service WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertServicio(string $strNombre,string $strDescripcion,string $strDescripcionCorta,int $intEstado, string $strRuta,string $strImagen,int $intArea){
			$this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $this->intArea = $intArea;
            $sql  = "INSERT INTO service(picture,status,name,short_description,description,route,categoryid)  VALUES(?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->strRuta,
                $this->intArea
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateServicio(int $intId,string $strNombre,string $strDescripcion,string $strDescripcionCorta,int $intEstado, string $strRuta,string $strImagen,int $intArea){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $this->intArea = $intArea;
            $sql = "UPDATE service SET picture=?,status=?,name=?, short_description=?,description=?, route=?,categoryid=? WHERE id = $this->intId";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->strRuta,
                $this->intArea
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function selectServiciosAreas(){
            $sql = "SELECT * FROM category WHERE status = 1 ORDER BY name";
            $request = $this->select_all($sql);
            return $request;
        }
        public function deleteServicio($id){
            $this->intId = $id;
            $sql = "DELETE FROM service WHERE id = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }
    }
?>