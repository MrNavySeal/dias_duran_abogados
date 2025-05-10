<?php 
    class ClientesModel extends Mysql{
        
        public function getAllClientes($params) {
            $limit = $searchNombre = $searchDocumento = $inicio = "";

            $inicio = ($params["paginaActual"] - 1) * $params["limitePagina"];

            if ($params["limitePagina"] != "") {
                $limit = "LIMIT $inicio, $params[limitePagina]";
            }

             if ($params["searchCodigo"] != "") {
                $searchNombre = "AND CONCAT(firstname, lastname) LIKE '$params[searchNombre]%'";
            }

            if ($params["searchNombre"] != "") {
                $searchDocumento = "AND identification LIKE '$params[searchDocumento]%'";
            }

            $sql = "SELECT image, CONCAT(firstname, lastname) AS nombre_cliente, identification, email, phone, DATE_FORMAT(date,'%d/%m/%Y') AS date, status 
            FROM person WHERE idperson > 1 $searchNombre $searchDocumento
            ORDER BY idperson DESC $limit";
            $row = $this->select_all($sql);

            foreach ($row as $key => $cliente) {
                $row[$key]["image"] = "./Assets/images/uploads/$cliente[image]";
            }

            $sql_total = "SELECT COUNT(*) AS total 
            FROM person WHERE idperson > 1 $searchNombre $searchDocumento
            $limit";
            $totalRegistros = $this->select($sql_total)["total"];
            $totalPaginas = intval($totalRegistros > 0 ? ceil($totalRegistros/$params["limitePagina"]) : 0);
            $totalPaginas = $totalPaginas == 0 ? 1 : $totalPaginas;

            return array("data"=>$row,"total"=>$totalPaginas);
        }
    }
?>