<?php 
    $url = !empty($_GET['url']) ? $_GET['url'] : 'home/home';
    require_once ("Config/Config.php");
    require_once ("Libraries/core/Errores.php");
    require_once ("Helpers/Helpers.php");
    require_once("Libraries/Core/Autoload.php");
    require_once ("Libraries/core/Router.php");
    require_once ("Libraries/TCPDF/tcpdf.php");
    require_once ("Libraries/vendor/autoload.php");
    require_once ("Libraries/html2pdf/vendor/autoload.php");
?>