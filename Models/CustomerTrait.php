<?php
    require_once("Libraries/Core/Mysql.php");
    trait CustomerTrait{
        private $con;

        public function selectCaso($intId){
            $this->con = new Mysql();
            $this->intId = $intId;
            $sql = "SELECT date,time,value_target as total,currency_target as currency,personid,service_id,idtransaction,status FROM orderdata WHERE idorder = $this->intId";
            $request = $this->con->select($sql);
            if(!empty($request)){
                $sqlCliente = "SELECT p.firstname,
                p.lastname,
                p.email,
                p.identification,
                p.address,
                DATE_FORMAT(p.date, '%d/%m/%Y') as date,
                co.name as pais,
                st.name as departamento,
                ci.name as ciudad,
                cp.phonecode,
                cp.shortname,
                ty.name as tipo_documento,
                CONCAT('+',cp.phonecode,' ',p.phone) as telefono
                FROM person p
                LEFT JOIN countries co ON p.countryid = co.id
                LEFT JOIN states st ON p.stateid = st.id
                LEFT JOIN cities ci ON p.cityid = ci.id
                LEFT JOIN countries cp ON p.phone_country = cp.id
                LEFT JOIN document_type ty ON p.typeid = ty.id
                LEFT JOIN currency cu ON cp.shortname = cu.iso
                WHERE p.idperson = $request[personid] AND p.status = 1";

                $sqlServicio = "SELECT p.name as servicio, c.name as area 
                FROM service p INNER JOIN category c ON c.id = p.categoryid 
                WHERE p.status = 1 AND p.id = $request[service_id]";
                $request['cliente'] = $this->con->select($sqlCliente);
                $request['servicio'] = $this->con->select($sqlServicio);
            }
            return $request;
        }
        public function updateCaso($intId,$strTransaccion,$strStatus){
            $this->con = new Mysql();
            $sql = "UPDATE orderdata SET idtransaction=?,status=? WHERE idorder = $intId";
            $arrData =[$strTransaccion,$strStatus];
            $request = $this->con->update($sql,$arrData);
            return $request;
        }
        public function insertContacto($strNombre,$strApellido,$intTelefono,$intPaisTelefono,$strCorreo,$strDireccion,$intPais,
        $intDepartamento,$intCiudad,$strComentario,$strIp,$strDispositivo,$intServicio){
            $this->con = new Mysql();
            $sql = "INSERT INTO contact(name,lastname,phone,phone_country,email,address,countryid,stateid,cityid,message,ip,device,service_id) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $arrData = [$strNombre,$strApellido,$intTelefono,$intPaisTelefono,$strCorreo,$strDireccion,$intPais,
            $intDepartamento,$intCiudad,$strComentario,$strIp,$strDispositivo,$intServicio];
            $request = $this->con->insert($sql,$arrData);
            return $request;
        }
        
    }
    
?>