<?php
    class NoticiasModel extends Mysql{
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
        private $intCategoria;

        public function __construct(){
            parent::__construct();
        }

        //Categorias
        public function selectCategorias($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT * FROM blog_category WHERE name like '$this->strBuscar%'  ORDER BY id DESC $limit";  
            $sqlTotal = "SELECT count(*) as total FROM blog_category WHERE name like '$this->strBuscar%' ORDER BY id DESC";

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
        public function selectCategoria($id){
            $this->intId = $id;
            $sql = "SELECT * FROM blog_category WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertCategoria(string $strNombre,int $intEstado, string $strRuta){
			$this->strNombre = $strNombre;
            $this->intEstado = $intEstado;
            $this->strRuta = $strRuta;
            $sql  = "INSERT INTO blog_category(status,name,route)  VALUES(?,?,?)";
            $arrData = array(
                $this->intEstado,
                $this->strNombre,
                $this->strRuta
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateCategoria(int $intId,string $strNombre,int $intEstado, string $strRuta){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
            $this->intEstado = $intEstado;
            $this->strRuta = $strRuta;
            $sql = "UPDATE blog_category SET status=?,name=?, route=? WHERE id = $this->intId";
            $arrData = array(
                $this->intEstado,
                $this->strNombre,
                $this->strRuta,
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteCategoria($id){
            $this->intId = $id;
            $sql = "SELECT * FROM blog WHERE category_id = $this->intId";
            $request = $this->select_all($sql);
            if(empty($request)){
                $sql = "DELETE FROM blog_category WHERE id = $this->intId";
                $request = $this->delete($sql);
            }else{
                $request = "existe";
            }
            return $request;
        }
        //Noticias
        public function selectNoticias($intPorPagina,$intPaginaActual, $strBuscar){
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            $sql = "SELECT b.*,c.name as categoria,
            CONCAT(p.firstname,' ',p.lastname) as user_name, 
            DATE_FORMAT(b.date_created,'%d/%m/%Y') as date_created,
            DATE_FORMAT(b.date_updated,'%d/%m/%Y') as date_updated
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%'
            ORDER BY b.id DESC $limit";

            $sqlTotal = "SELECT count(*) as total 
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%'
            ORDER BY b.id DESC";

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
        public function selectNoticia($id){
            $this->intId = $id;
            $sql = "SELECT * FROM blog WHERE id = $this->intId";
            $request = $this->select($sql);
            return $request;
        }
        public function insertNoticia(string $strNombre,string $strDescripcionCorta,string $strDescripcion,string $strImagen,int $intEstado, string $strRuta,int $intCategoria){
			$this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $this->intCategoria = $intCategoria;
            $sql  = "INSERT INTO blog(name,picture,shortdescription,description,status,route,category_id,person_id)  VALUES(?,?,?,?,?,?,?,?)";
            $arrData = array(
                $this->strNombre,
                $this->strImagen,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->intEstado,
                $this->strRuta,
                $this->intCategoria,
                $_SESSION['idUser']
            );
            $request = $this->insert($sql,$arrData);
	        return $request;
		}
        public function updateNoticia(int $intId,string $strNombre,string $strDescripcionCorta,string $strDescripcion,string $strImagen,int $intEstado, string $strRuta,int $intCategoria){
            $this->intId = $intId;
            $this->strNombre = $strNombre;
			$this->strDescripcionCorta = $strDescripcionCorta;
            $this->strImagen = $strImagen;
            $this->intEstado = $intEstado;
            $this->strDescripcion = $strDescripcion;
            $this->strRuta = $strRuta;
            $this->intCategoria = $intCategoria;
            $sql = "UPDATE blog SET name=?,picture=?,shortdescription=?,description=?,status=?,route=?,category_id=?,date_updated=? WHERE id = $this->intId";
            $arrData = array(
                $this->strNombre,
                $this->strImagen,
                $this->strDescripcionCorta,
                $this->strDescripcion,
                $this->intEstado,
                $this->strRuta,
                $this->intCategoria,
                date_format(date_create('now'),'Y-m-d')
            );
            $request = $this->update($sql,$arrData);
			return $request;
		
		}
        public function deleteNoticia($id){
            $this->intId = $id;
             $sql = "DELETE FROM blog WHERE id = $this->intId";
            $request = $this->delete($sql);
            return $request;
        }
        public function selectCategoriasNoticias(){
            $sql = "SELECT * FROM blog_category WHERE status = 1 ORDER BY name";
            $request = $this->select_all($sql);
            return $request;
        }
    }
?>