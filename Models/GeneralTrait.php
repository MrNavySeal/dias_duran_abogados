<?php
    require_once("Libraries/Core/Mysql.php");
    trait GeneralTrait{
        private $con;

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
    }
    
?>