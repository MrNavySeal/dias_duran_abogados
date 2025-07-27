<?php
    class ExChangeProvider implements CurrencyConversionInterface{

        public function getConversion(string $base, string $target, $valueBase){

            $url = "https://v6.exchangerate-api.com/v6/30b568ac6f23a849d3c00aac/pair/$base/$target";
            $responseJson = file_get_contents($url);
            $arrData = [];
            if(false !== $responseJson) {
                try {
                    $response = json_decode($responseJson);
                    if('success' === $response->result) {
                        $target = $response->conversion_rate;
                        //$this->model->updateConversion($request['id'],$intValorConversionObjetivo,$strFechaActual);
                        $result = round(($valueBase * $target));
                        $arrData = ["status"=>true,"rate"=>$target,"conversion"=>$result];
                    }
                }
                catch(Exception $e) {
                    $arrData = ["status"=>false,"msg"=>$e];
                }
            }
            return $arrData;
        }
    }
?>