<?php
    class IpGeolocationProvider implements LocationInterface{
        private $ip;
        private $key;

        public function getLocation(string $ip,string $format,array $fields=[]){
            $this->key = "f5dbd4464e734ac29e84d64fec64a1e7";
            $this->ip = $ip;
            $arrData = [];
            $url = "https://api.ipgeolocation.io/v2/ipgeo?apiKey=$this->key&ip=$this->ip";
            $response = file_get_contents($url);
            $data = json_decode($response,true);
            
            if(empty($data)){
                $arrData['status'] = "failed";
            }else{
                $arrData = [
                    "country"=>$data['location']['country_name'],
                    "regionName"=>$data['location']['state_prov'],
                    "city"=>$data['location']['city'],
                    "zip"=>$data['location']['zipcode'],
                    "lat"=>$data['location']['latitude'],
                    "lon"=>$data['location']['longitude'],
                    "timezone"=>"",
                    "isp"=>"",
                    "org"=>"",
                    "as"=>"",
                    "query"=>$data['ip'],
                    "status"=>"success",
                ];
            }
            return $arrData;
        }    
    }
?>