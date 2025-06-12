<?php
    class Router{
        private $arrRoutes;
        private $strUrl;
        public function __construct($url){
            $this->strUrl = $url;
            $this->loadRoutes();
        }
        public function setRoute($name,$route){
            $name = $this->normalizeRoute($name);
            $arrRoute = $this->validRoute($route);
            $arrParams = $this->getParams($name,$this->strUrl);
            
            $this->arrRoutes[$name] = [
                "name"=>$name,
                "controller"=>$arrRoute['controller'],
                "method"=>$arrRoute['method'],
                "params"=>$arrParams,
                "file"=>$arrRoute['file'],
            ];
        }
        public function getRoutes(){
            return $this->arrRoutes;
        }
        public function dispatch(){
            //Se obtiene la ruta nombrada, en caso de no encontrarla, despacha la automática.
            $arrUrl = $this->getRoute();
            if(!empty($arrUrl)){
                $controllerFile = $arrUrl['file'];
                $controller = $arrUrl['controller'];
                $method=$arrUrl['method'];
                $params=$arrUrl['params'];
                $route = $arrUrl['name'];
                $arrControllerFile = explode(".php",$controllerFile);
                $controllerFile = count($arrControllerFile) > 1 ? $controllerFile : $controllerFile.".php";
                require_once $controllerFile;
                $controller = str_replace(".php","",$controller);
                $controller = new $controller(); //Creo la instancia del controlador
                $controller->load($controllerFile);
                if(method_exists($controller, $method)){//Valido si existe el método
                    $controller->{$method}($params);//Utilizo el método
                }else{
                    getError(3);
                }
            }else{
                getError(404);
            }
        }
        private function loadRoutes(){
            $arrRoutes = glob("Routes/*.php");
            foreach ($arrRoutes as $route) {
                $file = basename($route,'.php').".php";
                $router = $this;
                require_once "Routes/".$file;
            }
        }
        private function normalizeRoute($name){
            $arrName = explode("/",$name);
            foreach ($arrName as &$data) {
                $data = strtolower($data);
            }
            unset($data);
            return implode("/",$arrName);
        }
        private function getRoute(){
            $arrUrl = explode("/",$this->normalizeRoute($this->strUrl));
            $strName = "";
            foreach ($arrUrl as $name) {
                if(isset($this->arrRoutes[$strName])){
                    break;
                }else{
                    $strName.=$name."/";
                    $strName = str_replace(".php","",$strName);
                }
            }
            $arrRouteContent = $this->arrRoutes[$strName];
            if(empty($arrRouteContent)){
                $arrUrl = explode("/",$this->strUrl);
                $controllerFile = "Controllers/";
                $controller = "";
                $method="";
                $params="";
                for ($i=0; $i < count($arrUrl); $i++) {
                    $cont = str_replace(".php","",ucwords($arrUrl[$i])).".php";
                    if(file_exists($controllerFile.$cont)){
                        $controller = $cont;
                        $method = isset($arrUrl[$i+1]) ? $arrUrl[$i+1] : $cont;
                        $method = str_replace(".php","",$method);
                        if(isset($arrUrl[$i+2])){
                            $params = implode(",",array_slice($arrUrl,$i+2));
                            $params = str_replace(".php","",$params);
                        }
                        $controllerFile = $controllerFile.$controller;
                        $routeName = strtolower(str_replace(".php","",$controller))."/".$method;
                        $routeName.= $params!= "" ? "/".str_replace(",","/",$params):"";
                        $route = BASE_URL."/".$routeName;
                        $arrRouteContent = array("controller"=>$controller,"method"=>$method,"params"=>$params,"file"=>$controllerFile,"name"=>$route);
                        break;
                    }else{
                        $controllerFile.=str_replace(".php","",$cont)."/";
                    }
                }
            }else{
                $routeName = $arrRouteContent['name'];
                $routeName.= $arrRouteContent['params']!= "" ? $arrRouteContent['params']:"";
                $route = BASE_URL."/".$routeName;
                $arrRouteContent['name'] = $route;
            }
            return $arrRouteContent;
        }
        private function getParams($name,$url){
            $url = str_replace(".php","",$url);
            $arrName = explode("/",$name);
            $arrName = array_filter($arrName,function($e){return $e != "";});
            $arrUrl = explode("/",$url);
            $arrParams = array_slice($arrUrl,count($arrName));
            $arrParams = implode(",",$arrParams);
            return $arrParams;
        }
        private function validRoute($route){
            $arrUrl = explode("/",$route);
            $controllerFile = "Controllers/";
            $controller = "";
            $method="";
            $params="";
            for ($i=0; $i < count($arrUrl); $i++) {
                $cont = str_replace(".php","",ucwords($arrUrl[$i])).".php";
                if(file_exists($controllerFile.$cont)){
                    $controller = $cont;
                    $method = isset($arrUrl[$i+1]) ? $arrUrl[$i+1] : $cont;
                    $method = str_replace(".php","",$method);
                    if(isset($arrUrl[$i+2])){
                        $params = implode(",",array_slice($arrUrl,$i+2));
                        $params = str_replace(".php","",$params);
                    }
                    $controllerFile = $controllerFile.$controller;
                    break;
                }else{
                    $controllerFile.=str_replace(".php","",$cont)."/";
                }
            }
            return array("controller"=>$controller,"method"=>$method,"params"=>$params,"file"=>$controllerFile);
        }
    }
    $router = new Router($url);
    $router->dispatch();
?>
