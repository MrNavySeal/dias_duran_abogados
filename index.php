<?php 
    require_once ("Config/Config.php");
    require_once ("Helpers/Helpers.php");
    require_once ("Libraries/TCPDF/tcpdf.php");
    require_once ("Libraries/vendor/autoload.php");
    require_once ("Libraries/html2pdf/vendor/autoload.php");
    $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';//Si la url está vacía, me devuelva al inicio
    $arrUrl = explode("/",$url); // Dividie o explota la url
    $controllerFile = "Controllers/";
    $controller = "";
    $method="";
    $params="";
    for ($i=0; $i < count($arrUrl); $i++) { 
        $cont = ucwords($arrUrl[$i]);
        if(file_exists($controllerFile.$cont.".php")){
            $controller = $cont;
            $method = isset($arrUrl[$i+1]) ? $arrUrl[$i+1] : $cont;
            $params = $arrUrl[$i+2];
            $controllerFile = $controllerFile.$controller.".php";
            break;
        }else{
            $controllerFile.=$cont."/";
        }
    }
    require_once("Libraries/Core/Autoload.php");
    require_once("Libraries/Core/Load.php");
?>