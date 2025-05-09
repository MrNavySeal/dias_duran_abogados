<?php
    $navCategories=getNavCat();
    $company = $data['company'];
    $title = $company['name'];
    $urlWeb = base_url();
    $urlImg =media()."/images/uploads/".$company['logo'];
    $description =$company['description'];
    if(!empty($data['product'])){
        $urlWeb = base_url()."/tienda/producto/".$data['product']['route'];
        $urlImg = $data['product']['image'][0]['url'];
        $title = $data['product']['name'];
        $description = $data['product']['shortdescription'];
    }else if(!empty($data['article'])){
        $urlWeb = base_url()."/blog/articulo/".$data['article']['route'];
        if($data['article']['picture']!=""){
            $urlImg = media()."/images/uploads/".$data['article']['picture'];
        }
        $title = $data['article']['name'];
        $description = $data['article']['shortdescription'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?=$company['description']?>">
    <meta name="author" content="<?=$company['name']?>" />
    <meta name="copyright" content="<?=$company['name']?>"/>
    <meta name="robots" content="index,follow"/>
    <meta name="keywords" content="<?=$company['keywords']?>"/>

    <title><?=$data['page_title']?></title>
    <link rel ="shortcut icon" href="<?=media()."/images/uploads/".$company['logo']?>" sizes="114x114" type="image/png">

    <meta property="fb:app_id"          content="1234567890" /> 
    <meta property="og:locale" 		content='es_ES'/>
    <meta property="og:type"        content="article" />
    <meta property="og:site_name"	content="<?= $company['name']; ?>"/>
    <meta property="og:description" content="<?=$description?>"/>
    <meta property="og:title"       content="<?= $title; ?>" />
    <meta property="og:url"         content="<?= $urlWeb; ?>" />
    <meta property="og:image"       content="<?= $urlImg; ?>" />
    <meta name="twitter:card" content="summary"></meta>
    <meta name="twitter:site" content="<?= $urlWeb; ?>"></meta>
    <meta name="twitter:creator" content="<?= $company['name']; ?>"></meta>
    <link rel="canonical" href="<?= $urlWeb?>"/>

    <!------------------------------Frameworks--------------------------------->
    <link rel="stylesheet" href="<?=media();?>/frameworks/bootstrap/bootstrap.min.css">
    
    <!------------------------------Plugins--------------------------------->
    <link href="<?= media();?>/plugins/datepicker/jquery-ui.min.css" rel="stylesheet">
    <link href="<?=media();?>/plugins/fontawesome/font-awesome.min.css">
    <link rel="stylesheet" href="<?=media();?>/plugins/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=media();?>/plugins/owlcarousel/owl.theme.default.min.css">
    <script src="<?= media();?>/plugins/tinymce/tinymce.min.js"></script>
    <link href="<?= media();?>/plugins/element-plus/element-plus.css" rel="stylesheet">
    <!------------------------------------Styles--------------------------->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?=media()?>/template/Assets/css/normalize.css">
    <link rel="stylesheet" href="<?=media()."/template/Assets/css/style.css?v=".rand()?>">
    <style> [v-cloak]{display : none;} </style>
</head>
<body>
    <div class="loading">
        <div class="loading-door loading-door-right"></div>
        <div class="loading-door loading-door-left"></div>
        <div class="loading-bar"></div>
    </div>
<div id="app" v-cloak>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
        <img src="..." class="rounded me-2" alt="..." height="20" width="20">
        <strong class="me-auto" id="toastProduct"></strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
        Hello, world! This is a toast message.
        </div>
    </div>
</div>
    <?php getComponent("navbar",$data)?>
    <!--<a href="#" class="back--top d-none"><i class="fas fa-backward"></i></a><a id="btnWhatsapp" href="<?="https://wa.me/".$company['phonecode'].$company['phone']?>" target="_blank"><i class="fab fa-whatsapp"></i></a>-->
    <div id="modalLogin"></div>
    
    