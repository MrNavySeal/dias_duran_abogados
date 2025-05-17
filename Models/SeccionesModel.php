<?php
    class SeccionesModel extends Mysql{
        private $intId;
        private $strEnlace;
		private $strNombre;
		private $intEstado;
        private $strImagen;
        private $strBoton;
        private $strDescripcion;
        private $strProfesion;
        private $strRespuesta;
        private $strPregunta;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;
        private $strPagina;
        private $strTitulo;
        private $strSubtitulo;
        private $strDescripcionCorta;

        public function __construct(){
            parent::__construct();
        }

        //Paginas
        public function updatePagina(string $strPagina,string $strTitulo,string $strSubtitulo,string $strDescripcionCorta,string $strDescripcion,string $strImagen){
            $this->strPagina = $strPagina;
            $this->strTitulo = $strTitulo;
            $this->strSubtitulo = $strSubtitulo;
            $this->strDescripcionCorta = $strDescripcionCorta;
            $this->strDescripcion = $strDescripcion;
            $this->strImagen = $strImagen;

            $sql = "UPDATE page SET title=?,subtitle=?,short_description=?, description=?,picture=? WHERE type = '$this->strPagina'";
            $arrData = [
                $this->strTitulo,
                $this->strSubtitulo,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->strImagen,
            ];
            $request = $this->update($sql,$arrData);
            return $request;
        }
        public function selectPagina(string $strPagina){
            $this->strPagina = $strPagina;
            $sql = "SELECT * FROM page WHERE type = '$this->strPagina'";
            $request = $this->select($sql);
            return $request;
        }

        //Banners
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

        //Testimonios
        public function selectTestimonios($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT * FROM testimonial WHERE name like '$this->strBuscar%' OR description like '$this->strBuscar%' OR profession like '$this->strBuscar%' ORDER BY id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM testimonial WHERE name like '$this->strBuscar%' OR description like '$this->strBuscar%' OR profession like '$this->strBuscar%' ORDER BY id DESC";

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
        public function selectTestimonio($id){
            $this->intId = $id;
            $sql = "SELECT * FROM testimonial WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertTestimonio(string $strImagen,string $strNombre,int $intEstado, string $strProfesion, string $strDescripcion){
			$this->strNombre = $strNombre;
			$this->strEnlace = $strProfesion;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $sql  = "INSERT INTO testimonial(picture,status,name,profession,description)  VALUES(?,?,?,?,?)";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strProfesion,
                $this->strDescripcion
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateTestimonio(int $intId,string $strImagen,string $strNombre,int $intEstado, string $strProfesion, string $strDescripcion){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
			$this->strProfesion = $strProfesion;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;

            $sql = "UPDATE testimonial SET picture=?,status=?,name=?, profession=?,description=? WHERE id = $this->intId";
            $arrData = array(
                $this->strImagen,
                $this->intEstado,
                $this->strNombre,
                $this->strProfesion,
                $this->strDescripcion
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteTestimonio($id){
            $this->intId = $id;
            $sql = "DELETE FROM testimonial WHERE id = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }

        //Testimonios
        public function selectFaqs($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT * FROM faq WHERE answer like '$this->strBuscar%' OR question like '$this->strBuscar%' ORDER BY id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM faq WHERE answer like '$this->strBuscar%' OR question like '$this->strBuscar%' ORDER BY id DESC";

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
        public function selectFaq($id){
            $this->intId = $id;
            $sql = "SELECT * FROM faq WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertFaq(string $strPregunta,string $strRespuesta,int $intEstado){
			$this->strPregunta = $strPregunta;
			$this->strRespuesta = $strRespuesta;
            $this->intEstado = $intEstado;
            $sql  = "INSERT INTO faq(question,answer,status)  VALUES(?,?,?)";
            $arrData = array($this->strPregunta,$this->strRespuesta,$this->intEstado);
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateFaq(int $intId,string $strPregunta,string $strRespuesta,int $intEstado){
            $this->intId = $intId;
            $this->strPregunta = $strPregunta;
			$this->strRespuesta = $strRespuesta;
            $this->intEstado = $intEstado;
            $sql = "UPDATE faq SET question=?,answer=?,status=? WHERE id = $this->intId";
            $arrData = array($this->strPregunta,$this->strRespuesta,$this->intEstado);
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteFaq($id){
            $this->intId = $id;
            $sql = "DELETE FROM faq WHERE id = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }
    }
?>