<?php
    class DashboardModel extends Mysql{
        public function __construct(){
            parent::__construct();
        }
        function getTotalViews(){
            $sql = "SELECT COUNT(*) as total FROM locations";
            $request = $this->select($sql);
            return $request['total'];
        }
        function getTotalUsers(){
            $sql = "SELECT COUNT(*) as total FROM person WHERE idperson!=1 ";
            $request = $this->select($sql);
            return $request['total'];
        }
        function getTotalCustomers(){
            $sql = "SELECT COUNT(*) as total FROM person WHERE roleid=2";
            $request = $this->select($sql);
            return $request['total'];
        }
        function getTotalOrders($idUser){
            $option="";
            if($idUser!=""){
                $option = " WHERE personid = $idUser";
            }

            $sql = "SELECT COUNT(*) as total FROM orderdata $option";
            $request = $this->select($sql);
            return $request['total'];
        }
        function getTotalSales(){
            $sql = "SELECT sum(value_base) as total FROM orderdata WHERE status='approved'";
            $request = $this->select($sql);
            $request['total'] = $request['total'] =="" ? 0 : $request['total'];
            return formatNum($request['total']);
        }
        function getLastOrders($idUser){
            $option="";
            if($idUser!=""){
                $option = " WHERE personid = $idUser";
            }
            $sql = "SELECT * FROM orderdata $option ORDER BY idorder DESC LIMIT 10";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectAccountMonth(int $year, int $month){
            $totalPerMonth = 0;
            //$month = 7;
            $arrSalesDay = array();
            $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $day = 1;
            for ($i=0; $i < $days ; $i++) { 
                $date_create = date_create($year."-".$month."-".$day);
                $date_format = date_format($date_create,"Y-m-d");
                //Ingresos
                $sql ="SELECT 
                    DAY(date) AS day, 
                    COUNT(idorder) AS quantity, 
                    SUM(value_base) AS total FROM orderdata
                    WHERE DATE(date) = '$date_format' AND status = 'approved'";
                $request = $this->select($sql);
                $request['day'] = $day;
                $request['total'] = $request['total'] =="" ? 0 : $request['total'];
                $totalPerMonth+=$request['total'];
                array_push($arrSalesDay,$request);
                $day++;
            }
            $months = months();
            $arrData = array(
                "ingresos"=>array("year"=>$year,"month"=>$months[$month-1],"total"=>$totalPerMonth,"sales"=>$arrSalesDay),
            );
            return $arrData;
        }
        public function selectViewsMonth(int $year, int $month){
            $totalPerMonth = 0;
            $arrInfo = array();
            $days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
            $day = 1;
            for ($i=0; $i < $days ; $i++) { 
                $date_create = date_create($year."-".$month."-".$day);
                $date_format = date_format($date_create,"Y-m-d");
                $sql ="SELECT DAY(date) AS day, COUNT(id) AS total FROM locations WHERE DATE(date) = '$date_format'";
                $request = $this->select($sql);
                $request['day'] = $day;
                $request['total'] = $request['total'] =="" ? 0 : $request['total'];
                $totalPerMonth+=$request['total'];
                array_push($arrInfo,$request);
                $day++;
            }
            $months = months();
            $arrData = array(
                "info"=>array("year"=>$year,"month"=>$months[$month-1],"total"=>$totalPerMonth,"data"=>$arrInfo),
            );
            return $arrData;
        }
        public function selectViewsCountry(){
            $sql = "SELECT country as name,count(*) as total FROM locations GROUP BY country ORDER BY country ";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectViewsPage(){
            $sql = "SELECT route as name,count(*) as total FROM locations GROUP BY route ORDER BY total DESC";
            $request = $this->select_all($sql);
            return $request;
        }
        public function selectAccountYear(int $year){
            $arrSalesMonth = array();
            $months = months();
            $total =0;
            $costos=0;
            $gastos=0;
            for ($i=1; $i <=12 ; $i++) { 
                $arrData = array("year"=>"","month"=>"","nmonth"=>"","sale"=>"","costos"=>"","gastos"=>"");
                //Ingresos
                $sql = "SELECT $year as year, 
                        $i as month, 
                        sum(value_base) as sale 
                        FROM orderdata
                        WHERE MONTH(date) = $i AND YEAR(date) = $year AND status = 'approved'
                        GROUP BY MONTH(date)";
                $request = $this->select($sql);
                $arrData['month'] = $months[$i-1];
                if(empty($request)){
                    $arrData['year'] = $year;
                    $arrData['nmonth'] = $i;
                    $arrData['sale'] = 0;
                }else{
                    $arrData['year'] = $request['year'];
                    $arrData['nmonth'] = $request['month'];
                    $arrData['sale'] = $request['sale'];
                }
                $total+=$arrData['sale'];
                array_push($arrSalesMonth,$arrData);
                
            }
            $arrData = array("data"=>$arrSalesMonth,"total"=>$total);
            //dep($arrData);exit;
            return $arrData;
        }
        public function selectViewsYear(int $year){
            $arrInfo = array();
            $months = months();
            $total =0;
            for ($i=1; $i <=12 ; $i++) { 
                $arrData = array("year"=>"","month"=>"","nmonth"=>"","total"=>"");
                $sql = "SELECT $year as year, 
                        $i as month, 
                        count(id) as total 
                        FROM locations
                        WHERE MONTH(date) = $i AND YEAR(date) = $year
                        GROUP BY MONTH(date)";
                $request = $this->select($sql);
                $arrData['month'] = $months[$i-1];
                if(empty($request)){
                    $arrData['year'] = $year;
                    $arrData['nmonth'] = $i;
                    $arrData['total'] = 0;
                }else{
                    $arrData['year'] = $request['year'];
                    $arrData['nmonth'] = $request['month'];
                    $arrData['total'] = $request['total'];
                }
                $total+=$arrData['total'];
                array_push($arrInfo,$arrData);
                
            }
            $arrData = array("data"=>$arrInfo,"total"=>$total);
            return $arrData;
        }

    }
?>