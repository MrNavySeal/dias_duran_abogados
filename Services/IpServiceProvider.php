<?php
    class IpServiceProvider extends Mysql{
        private $location;
        private $route;
        public function __construct(LocationInterface $location,$ip,$format="json",$fields = [],$route=""){
            parent::__construct();
            $this->location = $location->getLocation($ip,$format,$fields);
            $this->route = $route;
            $this->setLocation();
        }
        private function setLocation(){
            if($this->location['status']=="success"){
                $ip = $this->location['query'];
                $sql = "SELECT * FROM locations WHERE ip = '$ip' AND route = '$this->route'";
                $request = $this->select_all($sql);
                if(empty($request)){
                    $sql = "INSERT INTO locations(route,country,state,city,zip,lat,lon,timezone,isp,org,aso,ip) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                    $arrData = [
                        $this->route,
                        $this->location['country'],
                        $this->location['regionName'],
                        $this->location['city'],
                        $this->location['zip'],
                        $this->location['lat'],
                        $this->location['lon'],
                        $this->location['timezone'],
                        $this->location['isp'],
                        $this->location['org'],
                        $this->location['as'],
                        $this->location['query'],
                    ];
                    $this->insert($sql,$arrData);
                }
            }
        }
    }
?>