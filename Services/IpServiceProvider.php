<?php
    class IpServiceProvider extends Mysql{
        private $location;
        public function __construct(LocationInterface $location,$ip,$format="json",$fields = []){
            parent::__construct();
            $this->location = $location->getLocation($ip,$format,$fields);
        }
        public function getLocation(){
            return $this->location;
        }
    }
?>