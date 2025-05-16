<?php
    class SeccionesModel extends Mysql{
        private $intId;
        private $strEnlace;
		private $strNombre;
		private $intEstado;
        private $strImagen;
        private $strBoton;
        private $strDescripcion;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;

        public function __construct(){
            parent::__construct();
        }
        public function insertBanner(string $strImagen,string $strNombre,int $intEstado, string $strEnlace, string $strBoton, string $strDescripcion){
			$this->strNombre = $strNombre;
			$this->strEnlace = $strEnlace;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strBoton = $strBoton;
            $this->strDescripcion = $strDescripcion;
            $sql  = "INSERT INTO banners(picture,status,link,name,button,description)  VALUES(?,?,?,?,?,?)";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strEnlace,
                $this->strNombre,
                $this->strBoton,
                $this->strDescripcion
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateBanner(int $intId,string $strImagen, string $strNombre,int $intEstado, string $strEnlace,string $strBoton,string $strDescripcion){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
			$this->strEnlace = $strEnlace;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strBoton = $strBoton;
            $this->strDescripcion = $strDescripcion;

            $sql = "UPDATE banners SET picture=?,status=?,link=?,name=?, button=?,description=? WHERE id_banner = $this->intId";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strEnlace,
                $this->strNombre,
                $this->strBoton,
                $this->strDescripcion
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteBanner($id){
            $this->intId = $id;
            $sql = "DELETE FROM banners WHERE id_banner = $this->intId";
            $return = $this->delete($sql);
            return $return;
        }
        public function selectBanners($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT * FROM banners WHERE name like '$this->strBuscar%' OR description like '$this->strBuscar%' ORDER BY id_banner DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM banners WHERE name like '$this->strBuscar%' OR description like '$this->strBuscar%' ORDER BY id_banner DESC";

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
        public function selectBanner($id){
            $this->intId = $id;
            $sql = "SELECT * FROM banners WHERE id_banner = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
    }
?>