<?php
    class MarqueteriaCalculos extends Controllers{
        public function __construct(){
            session_start();
            if(empty($_SESSION['login'])){
                header("location: ".base_url());
                die();
            }
            parent::__construct();
            sessionCookie();
            getPermits(6);
            
        }
        public function calcularMarcoTotal(){
            if($_SESSION['permitsModule']['w']){
                if($_POST){
                    if(empty($_POST['id']) || empty($_POST['data']) || empty($_POST['height']) || empty($_POST['width']) || empty($_POST['id_config']) 
                    || empty($_POST['orientation'])){
                        $arrResponse = array("status"=>false,"msg"=>"Error de datos");
                    }else{
                        $intId = intval($_POST['id']);
                        $intIdConfig = intval($_POST['id_config']);
                        $intMargin = intval($_POST['margin']);
                        $intHeight = floatval($_POST['height']);
                        $intWidth = floatval($_POST['width']);
                        $intHeightM = $intHeight+($intMargin*2);
                        $intWidthM = $intWidth+($intMargin*2);
                        $arrData = json_decode($_POST['data'],true);
                        $strOrientation = strClean($_POST['orientation']);
                        $strColorFrame = strClean($_POST['color_frame']);
                        $strColorMargin = strClean($_POST['color_margin']);
                        $strColorBorder = strClean($_POST['color_border']);
                        $intIdColorFrame = intval($_POST['color_frame_id']);
                        $intIdColorMargin = intval($_POST['color_margin_id']);
                        $intIdColorBorder = intval($_POST['color_border_id']);
                        $intIdTypeFrame = intval($_POST['type_frame']);
                        $request = $this->model->selectFrameConfig($intId,$arrData);
                        $request_config=$this->model->selectCategory($intIdConfig);
                        $isPrint = $request_config['is_print'];
                        /************Frame variables************* */
                        $frameLength = 290;
                        $framePainted = 2.87;
                        $frame = $request['frame'];
                        $cost= 0;
                        $waste = $frame['waste'];
                        $data = $request['data'];
                        $flag = strpos($frame['name'],"madera") > 0 ? true : false;
                        if($flag){
                            $cost = ceil(($frame['price_purchase']/$frameLength)*$framePainted);
                        }else{
                            $cost = ceil($frame['price_purchase']/$frameLength);
                        }
                        $totalCostFrame = ((($intHeightM+$intWidthM)*2)+$waste)*$cost;
                        if( $frame['name'] !="molduras importadas"){
                            $perimetro = 2*($intHeightM+$intWidthM);
                            $varas = ceil(($perimetro)/($frameLength-$waste));
                            $totalCostFrame = ($perimetro+($waste*$varas))*$cost;
                        }
                        $totalCostFrame = ceil(($totalCostFrame)/1000)*1000;
                        $totalCostMaterial = 0;
                        $totalCost = 0;
                        $arrSpecs = [];
                        $arrCostData = [];
                        $htmlCostData = "";
                        $htmlSpecs ="";
                        $price = ceil((UTILIDAD*$totalCostFrame)/1000)*1000;
                        $htmlCostData ='<tr>
                            <td>Marco '.$frame['reference'].'</td>
                            <td class="text-end">'.formatNum($totalCostFrame).'</td>
                            <td class="text-end">'.formatNum(ceil((UTILIDAD*$totalCostFrame)/1000)*1000).'</td>
                        </tr>';
                        array_push($arrCostData,array("name"=>"Referencia","value"=>$frame['reference']));
                        array_push($arrSpecs,
                            array("name"=>"Referencia","value"=>$frame['reference']),
                            array("name"=>"Material","value"=>ucfirst($frame['name'])),
                            array("name"=>"Orientación","value"=>$strOrientation),
                            array("name"=>"Medida imagen","value"=>$intWidth." x ".$intHeight." cm"),
                            array("name"=>"Medida marco","value"=>$intWidthM." x ".$intHeightM." cm")
                        );
                        $htmlSpecs.='<tr><td>Referencia</td><td>'.$frame['reference'].'</td></tr>';
                        $htmlSpecs.='<tr><td>Material</td><td>'.ucfirst($frame['name']).'</td></tr>';
                        $htmlSpecs.='<tr><td>Orientación</td><td>'.$strOrientation.'</td></tr>';
                        $htmlSpecs.='<tr><td>Medida imagen</td><td>'.$intWidth." x ".$intHeight." cm".'</td></tr>';
                        $htmlSpecs.='<tr><td>Medida marco</td><td>'.$intWidthM." x ".$intHeightM." cm".'</td></tr>';
                        
                        if($frame['name'] !="molduras importadas" && $frame['name'] !="bastidores"){
                            array_push($arrSpecs,array("name"=>"Color del marco","value"=>$strColorFrame));
                            $htmlSpecs.='<tr><td>Color del marco</td><td>'.$strColorFrame.'</td></tr>';
                        }
                        foreach ($data as $e ) {
                            $prop = $e['prop'];
                            $option = $e['option'];
                            $arrMaterial = $e['material'];
                            if($option['is_margin']){
                                array_push($arrSpecs,array("name"=>"Medida del ".$option['tag'],"value"=>$intMargin." cm"));
                                array_push($arrSpecs,array("name"=>"Color del ".$option['tag'],"value"=>$strColorMargin));
                                $htmlSpecs.='<tr><td>'."Medida del ".$option['tag'].'</td><td>'.$intMargin.'</td></tr>';
                                $htmlSpecs.='<tr><td>'."Color del ".$option['tag'].'</td><td>'.$strColorMargin.'</td></tr>';
                            }
                            if($option['is_bocel'] || $option['is_frame']){
                                array_push($arrSpecs,array("name"=>"Color del ".$option['tag_frame'],"value"=>$strColorBorder));
                                $htmlSpecs.='<tr><td>'."Color del ".$option['tag_frame'].'</td><td>'.$strColorBorder.'</td></tr>';
                            }
                            
                            array_push($arrSpecs,array("name"=>$prop['name'],"value"=>$option['name']));
                            $htmlSpecs.='<tr><td>'.$prop['name'].'</td><td>'.$option['name'].'</td></tr>';
                            if($prop['is_material']){
                                if($isPrint != 1){
                                    $arrMaterial = array_filter($arrMaterial,function($e){return $e['name'] != "Impresion";});
                                }
                                foreach ($arrMaterial as $d ) {
                                    $totalMaterial = $this->calcularCostoMaterial($d,$intHeight,$intWidth,$intMargin);
                                    $totalCostMaterial+= $totalMaterial;
                                    $price+=ceil((UTILIDAD*$totalMaterial)/1000)*1000;
                                    array_push($arrCostData,array("name"=>$d['name'], "total"=>$totalMaterial ));
                                    $htmlCostData.='
                                    <tr>
                                        <td>'.$d['name'].'</td>
                                        <td class="text-end">'.formatNum($totalMaterial).'</td>
                                        <td class="text-end">'.formatNum(ceil((UTILIDAD*$totalMaterial)/1000)*1000).'</td>
                                    </tr>';
                                }
                            }
                        }
                        $totalCost = $totalCostMaterial+$totalCostFrame;
                        $arrResponse = array(
                            "status"=>true,
                            "total"=>formatNum($price),
                            "total_cost"=>formatNum($totalCost),
                            "specs"=>$arrSpecs,
                            "cost"=>$arrCostData,
                            "html_cost"=>$htmlCostData,
                            "html_specs"=>$htmlSpecs,
                            "total_cost_clean"=>$totalCost,
                            "total_clean"=>$price,
                            "name"=>$request_config['name'],
                            "config"=>array(
                                "frame"=>$intId,
                                "config"=>$intIdConfig,
                                "margin"=>$intMargin,
                                "height"=>$intHeight,
                                "width"=>$intWidth,
                                "orientation"=>$strOrientation,
                                "color_frame"=>$intIdColorFrame,
                                "color_margin"=>$intIdColorMargin,
                                "color_border"=>$intIdColorBorder,
                                "props"=>$arrData,
                                "type_frame"=>$intIdTypeFrame
                            )
                        );
                    }
                    echo json_encode($arrResponse,JSON_UNESCAPED_UNICODE);
                }
            }
            die();
        }
        public function calcularCostoMaterial($data,float $intHeight, float $intWidth,int $intMargin){
            $total = 0;
            $type = $data['type'];
            $method = $data['method'];
            $factor = $data['factor'];
            $priceMaterial = $data['price_purchase'];
            $arrVariables = $data['variables'];
            $wasteMaterial = 0;
            $heightMaterial = 0;
            $widthMaterial = 0;
            $lengthMaterial = 0;
            $areaMaterial = 0;
            $costMaterial = 0;
            $heigth = $method == "completo" ?  ($intHeight+$intMargin) : $intHeight;
            $width = $method == "completo" ?  ($intWidth+$intMargin) : $intWidth;
            foreach ($arrVariables as $v ) {
                if($v['name'] == "Alto"){
                    $heightMaterial = $v['value'];
                }else if($v['name']=="Ancho"){
                    $widthMaterial = $v['value'];
                }else if($v['name'] == "Desperdicio"){
                    $wasteMaterial = $v['value'];
                }else if($v['name']=="Largo"){
                    $lengthMaterial = $v['value'];
                }
            }
            if($type == "area"){
                $areaMaterial = $widthMaterial * $heightMaterial;
                $areaMaterial = $areaMaterial > 0 ? $areaMaterial : 1;
                $costMaterial = ceil(($priceMaterial/$areaMaterial)*$factor); 
                $total+=$costMaterial*($heigth*$width); 
            }else{
                $lengthMaterial = $lengthMaterial > 0 ? $lengthMaterial : 1;
                $costMaterial = ceil(($priceMaterial/$lengthMaterial)*$factor); 
                $perimetro = (($heigth + $width)*2)+$wasteMaterial;
                $total+=$costMaterial*($perimetro); 
            }
            $total = ceil($total/1000)*1000;
            return $total;
        }
    }

?>