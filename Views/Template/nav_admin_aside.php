<?php
    $notification = emailNotification(); 
    $comments = commentNotification();
    $reviews = $comments['total'];
?>
<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="#" class="navbar-brand mx-4 mb-3">
            <div class="d-flex flex-column text-center align-items-center">
                <div style="max-width:30%">
                    <img class="img-fluid" src="<?=media()."/images/uploads/".$companyData['logo']?>" alt="">
                </div>
                <h5 class="text-primary text-wrap fs-5 mt-2"><?= $companyData['name']?></h5>
            </div>
            
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="<?=media()."/images/uploads/".$_SESSION['userData']['image']?>" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?=$_SESSION['userData']['firstname']." ".$_SESSION['userData']['lastname']?></h6>
                <span><?=$_SESSION['userData']['role_name']?></span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <!-- Dashboard -->
            <?php if($_SESSION['permit'][1]['r']){ $active = $_SESSION['permitsModule']['module'] == "Dashboard" ? "active" :"";?>
            
            <a href="<?=base_url()?>/dashboard" class="nav-item nav-link <?=$active?>"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <?php } ?>
            <!-- Usuarios -->
            <?php  if($_SESSION['permit'][2]['r']){ $active = $_SESSION['permitsModule']['module'] == "Usuarios" ? "active" :"";?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$active?>" data-bs-toggle="dropdown"><i class="fas fa-users"></i>Usuarios</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?=base_url()?>/usuarios" class="dropdown-item">Usuarios</a>
                    <?php
                        if($_SESSION['idUser'] == 1 && $_SESSION['permit'][2]['r']){
                    ?>
                    <a href="<?=base_url()?>/roles" class="dropdown-item">Roles de usuario</a>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
             <!-- Clientes -->
            <?php  if($_SESSION['permit'][3]['r']){ $active = $_SESSION['permitsModule']['module'] == "Clientes" ? "active" :"";?>
            <a href="<?=base_url()?>/clientes" class="nav-item nav-link <?=$active?>"><i class="fas fa-user-tag"></i>Clientes</a>
            <?php } ?>

            <!-- Productos -->
            <?php  if($_SESSION['permit'][11]['r']){ $active = $_SESSION['permitsModule']['module'] == "Productos" ? "active" :"";?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$active?>" data-bs-toggle="dropdown"><i class="fas fa-shopping-bag"></i>Áreas de asesoría</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?=base_url()?>/Servicios/categorias" class="dropdown-item">Áreas</a>
                    <a href="<?=base_url()?>/Servicios/servicios" class="dropdown-item">Servicios</a>
                </div>
            </div>
            <?php } ?>
            <!-- Pedidos -->
            <?php if($_SESSION['permit'][6]['r']){ $active = $_SESSION['permitsModule']['module'] == "Pedidos" ? "active" :"";?>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle <?=$active?>" data-bs-toggle="dropdown"><i class="fas fa-receipt"></i>Mis pedidos</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="<?=base_url()?>/pedidos" class="dropdown-item">Pedidos</a>
                        <?php if($_SESSION['permit'][6]['w']){ ?>
                        <a href="<?=base_url()?>/PedidosPos/venta" class="dropdown-item">Punto de venta</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <!-- Administración -->
            <?php 
                if($_SESSION['permit'][5]['r']){
                    $emails = "";
                    if($notification>0){
                        $emails = '<span class="badge badge-sm bg-danger ms-auto">'.$notification.'</span>';
                    }else{
                        $emails = "";
                    }
            ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-cog"></i>Configuración</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <?php 
                        if($_SESSION['idUser']==1){
                    ?>
                    <a href="<?=base_url()?>/empresa" class="dropdown-item">Parámetros de empresa</a>
                    <?php } ?>
                    <a href="<?=base_url()?>/administracion/correo" class="dropdown-item">Correo <?=$emails?></a>
                    <a href="<?=base_url()?>/administracion/envios" class="dropdown-item">Envío</a>
                    <a href="<?=base_url()?>/paginas" class="dropdown-item">Páginas</a>
                    <a href="<?=base_url()?>/banners" class="dropdown-item">Banners</a>
                </div>
            </div>
            <?php } ?>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$active?>" data-bs-toggle="dropdown"><i class="fas fa-puzzle-piece"></i>Secciones</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?=base_url()?>/Secciones/paginas" class="dropdown-item">Paginas</a>
                    <a href="<?=base_url()?>/Secciones/banners" class="dropdown-item">Banners</a>
                    <a href="<?=base_url()?>/Secciones/equipo" class="dropdown-item">Equipo</a>
                    <a href="<?=base_url()?>/Secciones/testimonios" class="dropdown-item">Testimonios</a>
                    <a href="<?=base_url()?>/Secciones/faq" class="dropdown-item">FAQ</a>
                </div>
            </div>
            <?php if($_SESSION['permit'][10]['r']){$active = $_SESSION['permitsModule']['module'] == "Blog" ? "active" :"";?>                
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle <?=$active?>" data-bs-toggle="dropdown"><i class="far fa-newspaper"></i>Blog</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="<?=base_url()?>/Noticias/categorias" class="dropdown-item">Categorias</a>
                    <a href="<?=base_url()?>/Noticias/noticias" class="dropdown-item">Noticias</a>
                </div>
            </div>
            <?php } ?>
        </div>
    </nav>
</div>
<!-- Sidebar End -->