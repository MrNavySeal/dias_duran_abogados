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
            $sql = "SELECT b.*,c.name as categoria 
            FROM blog b 
            INNER JOIN blog_category c ON c.id = b.category_id
            WHERE b.status = 1  ORDER BY b.id DESC";
            $request = $this->con->select_all($sql);
            $total = count($request);
            for ($i=0; $i < $total; $i++) { 
                $strUrl = media()."/images/uploads/".$request[$i]['picture'];
                $strFecha = new DateTime($request[$i]['date']);
                $request[$i]['route'] = base_url()."/"
                $request[$i]['url'] = $strUrl;
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
    }
    
?>