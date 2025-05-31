<?php
    require_once("Libraries/Core/Mysql.php");
    trait GeneralTrait{
        private $con;
        private $intPorPagina;
        private $intPaginaActual;
        private $intPaginaInicio;
        private $strBuscar;
        private $strCategoria;

        public function getBanners(){
            $this->con=new Mysql();
            $sql = "SELECT * FROM banners WHERE status = 1 ORDER BY id_banner DESC";       
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $request[$i]['url'] = $strUrl;
            }
            return $request;
        }
        public function getNoticias(){
            $this->con=new Mysql();
            $sql = "SELECT b.*,c.name as categoria,
            CONCAT(p.firstname,' ',p.lastname) as user_name,
            p.image as picture_user
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.status = 1  ORDER BY b.id DESC";
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $strUrlPicture = media()."/images/uploads/".$request[$i]['picture_user'];
                $strFecha = new DateTime($request[$i]['date']);
                $request[$i]['route'] = base_url()."/blog/noticia/".$request[$i]['route'];
                $request[$i]['url'] = $strUrl;
                $request[$i]['url_picture'] = $strUrlPicture;
                $request[$i]['date_format'] = $strFecha->format('M j, Y');
            }
            return $request;
        }
        public function getAreas(){
            $this->con=new Mysql();
            $sql = "SELECT * FROM category WHERE status = 1 ORDER BY name ASC";
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $request[$i]['url'] = $strUrl;
                $request[$i]['route'] = base_url()."/servicios/area/".$request[$i]['route'];
                $arrDet = $this->con->select_all("SELECT * FROM service WHERE categoryid = {$request[$i]['id']} AND status = 1 ORDER BY name");
                foreach ($arrDet as &$data) { 
                    $data['url'] = media()."/images/uploads/".$data['picture']; 
                    $data['route'] = base_url()."/servicios/servicio/".$data['route'];
                }
                $request[$i]['services'] = $arrDet;
            }
            return $request;
        }
        public function selectArea($strRuta){
            $this->con = new Mysql();
            $sql = "SELECT * FROM category WHERE status = 1 AND (route = '$strRuta' OR id = '$strRuta')";
            $request = $this->con->select($sql);
            if(!empty($request)){
                $request['url'] = media()."/images/uploads/".$request['picture'];
                $arrDet = $this->con->select_all("SELECT * FROM service WHERE categoryid = $request[id] AND status = 1 ORDER BY name");
                if(empty($arrDet)){$arrDet = $this->con->select_all("SELECT * FROM service WHERE status = 1 ORDER BY RAND()");}
                foreach ($arrDet as &$data) {
                    $data['url'] = media()."/images/uploads/".$data['picture'];
                    $data['route'] = base_url()."/servicios/servicio/".$data['route'];
                }
                $request['services'] = $arrDet;
            }
            return $request;
        }
        public function selectServicio($strRuta){
            $this->con = new Mysql();
            $sql = "SELECT cab.*,det.name as category,det.route as category_route 
            FROM service cab
            INNER JOIN category det ON cab.categoryid = det.id
            WHERE cab.status = 1 AND (cab.route = '$strRuta' OR cab.id = '$strRuta')";
            $request = $this->con->select($sql);
            if(!empty($request)){
                $request['category_route'] = base_url()."/servicios/area/".$request['category_route'];
                $request['url'] = media()."/images/uploads/".$request['picture'];
                $arrDet = $this->con->select_all("SELECT * FROM service WHERE categoryid = $request[categoryid] AND status = 1 ORDER BY name");
                if(empty($arrDet)){$arrDet = $this->con->select_all("SELECT * FROM service WHERE status = 1 ORDER BY RAND()");}
                foreach ($arrDet as &$data) {
                    $data['url'] = media()."/images/uploads/".$data['picture'];
                    $data['route'] = base_url()."/servicios/servicio/".$data['route'];
                }
                $request['services'] = $arrDet;
            }
            return $request;
        }
        public function getTestimonios(){
            $this->con=new Mysql();
            $sql = "SELECT * FROM testimonial WHERE status = 1 ORDER BY name ASC";
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $request[$i]['url'] = $strUrl;
            }
            return $request;
        }
        public function getEquipo(){
            $this->con=new Mysql();
            $sql = "SELECT * FROM team WHERE status = 1 ORDER BY name ASC";
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $request[$i]['url'] = $strUrl;
            }
            return $request;
        }
        public function getPagina($tipo){
            $this->con=new Mysql();
            $sql = "SELECT * FROM page WHERE type = '$tipo'";
            $request = $this->con->select($sql);
            $strUrl = media()."/images/uploads/".$request['picture'];
            $request['url'] = $strUrl;
            return $request;
        }
        public function getFaq(){
            $this->con=new Mysql();
            $sql = "SELECT * FROM faq WHERE status = 1";
            $request = $this->con->select_all($sql);
            return $request;
        }
        public function getBlogPaginacion($intPorPagina,$intPaginaActual, $strBuscar,$strCategoria){
            $this->con = new Mysql();
            $this->intPorPagina = $intPorPagina;
            $this->intPaginaActual = $intPaginaActual;
            $this->strBuscar = $strBuscar;
            $this->strCategoria = $strCategoria;
            $limit ="";
            $this->intPaginaInicio = ($this->intPaginaActual-1)*$this->intPorPagina;
            if($this->intPorPagina != 0){
                $limit = " LIMIT $this->intPaginaInicio,$this->intPorPagina";
            }
            if($this->strCategoria != ""){
                $this->strCategoria = " AND c.id = '$this->strCategoria'";
            }
            $sql = "SELECT b.*,c.name as categoria,
            CONCAT(p.firstname,' ',p.lastname) as user_name, 
            b.date_created as date,
            DATE_FORMAT(b.date_created,'%d/%m/%Y') as date_created,
            DATE_FORMAT(b.date_updated,'%d/%m/%Y') as date_updated,
            p.image as picture_user
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE (b.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%') AND b.status=1 $this->strCategoria
            ORDER BY b.id $limit";

            $sqlTotal = "SELECT count(*) as total 
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE (b.name like '$this->strBuscar%' OR c.name like '$this->strBuscar%') AND b.status=1 $this->strCategoria
            ORDER BY b.id";

            $totalRecords = $this->con->select($sqlTotal)['total'];
            $totalPages = intval($totalRecords > 0 ? ceil($totalRecords/$this->intPorPagina) : 0);
            $totalPages = $totalPages == 0 ? 1 : $totalPages;
            $request = $this->con->select_all($sql);

            foreach ($request as &$data) {
                $strUrl = media()."/images/uploads/".$data['picture'];
                $strUrlPicture = media()."/images/uploads/".$data['picture_user'];
                $strFecha = new DateTime($data['date']);
                $data['route'] = base_url()."/blog/noticia/".$data['route'];
                $data['url'] = $strUrl;
                $data['url_picture'] = $strUrlPicture;
                $data['date_format'] = $strFecha->format('M j, Y');
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
        public function getBlogCategorias(){
            $this->con = new Mysql();
            $sql = "SELECT * FROM blog_category WHERE status = 1 ORDER BY name DESC";
            $request = $this->con->select_all($sql);
            foreach ($request as &$data) { $data['route'] = base_url()."/blog/categoria/".$data['route']; }
            return $request;
        }
        public function selectBlogCategoria($strRuta){
            $this->con = new Mysql();
            $sql = "SELECT * FROM blog_category WHERE status = 1 AND route = '$strRuta' ORDER BY name DESC";
            $request = $this->con->select($sql);
            $request['route'] = base_url()."/blog/categoria/".$request['route'];
            return $request;
        }
        public function getBlogRecientes(){
            $this->con = new Mysql();
            $sql = "SELECT b.*,c.name as categoria,
            CONCAT(p.firstname,' ',p.lastname) as user_name, 
            b.date_created as date,
            DATE_FORMAT(b.date_created,'%d/%m/%Y') as date_created,
            DATE_FORMAT(b.date_updated,'%d/%m/%Y') as date_updated,
            p.image as picture_user
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.status=1 ORDER BY b.id DESC LIMIT 0,5";
            $request = $this->con->select_all($sql);
            foreach ($request as &$data) {
                $strUrl = media()."/images/uploads/".$data['picture'];
                $strUrlPicture = media()."/images/uploads/".$data['picture_user'];
                $strFecha = new DateTime($data['date']);
                $data['route'] = base_url()."/blog/noticia/".$data['route'];
                $data['url'] = $strUrl;
                $data['url_picture'] = $strUrlPicture;
                $data['date_format'] = $strFecha->format('M j, Y');
            }
            return $request;
        }
        public function selectBlogNoticia($strRuta){
            $this->con = new Mysql();
            $sql = "SELECT b.*,c.name as category,
            c.route as route_category,
            CONCAT(p.firstname,' ',p.lastname) as user_name, 
            b.date_created as date,
            DATE_FORMAT(b.date_created,'%d/%m/%Y') as date_created,
            DATE_FORMAT(b.date_updated,'%d/%m/%Y') as date_updated,
            p.image as picture_user
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.route = '$strRuta' OR b.id = '$strRuta'";
            $request = $this->con->select($sql);
            $strUrl = media()."/images/uploads/".$request['picture'];
            $strUrlPicture = media()."/images/uploads/".$request['picture_user'];
            $strFecha = new DateTime($request['date']);
            $request['route'] = base_url()."/blog/noticia/".$request['route'];
            $request['route_category'] = base_url()."/blog/categoria/".$request['route_category'];
            $request['url'] = $strUrl;
            $request['url_picture'] = $strUrlPicture;
            $request['date_format'] = $strFecha->format('M j, Y');

            
            //Noticias relacionadas
            $sql = "SELECT b.*,c.name as categoria,
            CONCAT(p.firstname,' ',p.lastname) as user_name,
            p.image as picture_user
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            INNER JOIN person p ON p.idperson = b.person_id
            WHERE b.status = 1 AND b.category_id = {$request['category_id']} ORDER BY b.id DESC";
            $arrRelated = $this->con->select_all($sql);
            if(empty($arrRelated)){
                $sql = "SELECT b.*,c.name as categoria,
                CONCAT(p.firstname,' ',p.lastname) as user_name,
                p.image as picture_user
                FROM blog b 
                INNER JOIN blog_category c ON c.id = b.category_id
                INNER JOIN person p ON p.idperson = b.person_id
                WHERE b.status = 1  ORDER BY b.id RAND()";
                $arrRelated = $this->con->select_all($sql);
            }
            $total = count($arrRelated);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$arrRelated[$i]['picture'];
                $strUrlPicture = media()."/images/uploads/".$arrRelated[$i]['picture_user'];
                $strFecha = new DateTime($arrRelated[$i]['date']);
                $arrRelated[$i]['route'] = base_url()."/blog/noticia/".$arrRelated[$i]['route'];
                $arrRelated[$i]['url'] = $strUrl;
                $arrRelated[$i]['url_picture'] = $strUrlPicture;
                $arrRelated[$i]['date_format'] = $strFecha->format('M j, Y');
            }
            $intNext = $request['id'] + 1;
            $intPrevious = $request['id'] - 1;
            $arrNext = $this->con->select("SELECT route FROM blog WHERE id = $intNext AND status = 1");
            $arrNext['route'] = isset($arrNext['route']) ? $arrNext['route'] :"";
            $arrNext['url'] = base_url()."/blog/noticia/".$arrNext['route'];
            $arrNext['id'] = $intNext;
            $arrPrevious = $this->con->select("SELECT  route FROM blog WHERE id = $intPrevious AND status =1");
            $arrPrevious['route'] = isset($arrPrevious['route']) ? $arrPrevious['route'] :"";
            $arrPrevious['url'] = base_url()."/blog/noticia/".$arrPrevious['route'];
            $arrPrevious['id'] = $intPrevious;
            $request['next'] = $arrNext;
            $request['previous'] = $arrPrevious;
            $request['related'] = $arrRelated;
            return $request;
        }
    }
    
?>