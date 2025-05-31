<?php  
    $company = getCompanyInfo();
    $arrServicios = getFooterServicios();
    $totalServicios = count($arrServicios);
?>

<footer class="container mt-4">
    <div class="row m-0">
        <div class="col-lg-4 p-5 t-color-4">
            <div class="logo">
                <img src="<?=media()."/images/uploads/".$company['logo']?>" alt="<?=$company['name']?>">
            </div>
            <p class="t-color-2"><?=$company['description']?></p>
            <p class="fw-bold fs-4 ">Síguenos</p>
            <ul class="social social--dark"> <?=getRedesSociales()?> </ul>
        </div>
        <div class="col-lg-8 p-0 bg-color-2 ">
            <div class="footer--info">
                <div class="row mb-5">
                    <div class="col-md-4">
                        <div class="footer--contact">
                            <i class="fas fa-map-marker-alt"></i>
                            <p><?=$company['addressfull']?></p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer--contact">
                            <i class="fas fa-phone"></i>
                            <p><?=$company['phone']." - ".$company['phones']?><br> Llámanos</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer--contact">
                            <i class="fas fa-envelope"></i>
                            <p><?=$company['email']?></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="footer--data">
                            <div class="footer--title">
                                <h3>Enlaces</h3>
                            </div>
                            <ul>
                                <li><el-link :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link></li>
                                <li><el-link :underline="false" href="<?=base_url()."/nosotros"?>" type="primary">Nosotros</el-link></li>
                                <li><el-link :underline="false" href="<?=base_url()."/servicios/areas"?>" type="primary">Servicios</el-link></li>
                                <li><el-link :underline="false" href="<?=base_url()."/blog"?>" type="primary">Blog</el-link></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="footer--data">
                            <div class="footer--title">
                                <h3>Servicios</h3>
                            </div>
                            <ul>
                                <?php for ($i=0; $i < $totalServicios; $i++) { ?>
                                <li><el-link :underline="false" href="<?=$arrServicios[$i]['route']?>" type="primary"><?=$arrServicios[$i]['name']?></el-link></li>
                                <?php }?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="footer--data">
                            <div class="footer--title">
                                <h3>Métodos de pago</h3>
                            </div>
                            <ul>
                                <li>Todas las tarjetas débito y crédito</li>
                                <li>Paypal</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0">
        <div class="col-md-12 p-0">
            <div class="footer--bar">
                <p>Copyright © <?=date("Y")." ".$company['name']?></p>
                <ul>
                    <li><a href="<?=base_url()?>">Inicio</a></li>
                    <li><a href="<?=base_url()?>/politicas/terminos">Términos y condiciones</a></li>
                    <li><a href="<?=base_url()?>/politicas/privacidad">Políticas de privacidad</a></li>
                    <li><a href="<?=base_url()?>/contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
</div>
    <!------------------------------Frameworks--------------------------------->
    <script src="<?= media();?>/frameworks/jquery/jquery.js"></script>
    <script src="<?= media(); ?>/frameworks/bootstrap/popper.min.js?n=1"></script>
    <script src="<?= media(); ?>/frameworks/bootstrap/bootstrap.min.js?n=1"></script>
    <!------------------------------Plugins--------------------------------->
    <script src="<?= media();?>/plugins/fontawesome/fontawesome.js"></script>
    <script src="<?= media();?>/plugins/sweetalert/sweetalert.js"></script>
    <script src="<?= media();?>/plugins/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= media();?>/plugins/datepicker/jquery-ui.min.js"></script>
    <script src="<?= media();?>/plugins/vue/vue.js"></script>
    <script src="<?= media();?>/plugins/element-plus/element-plus.js"></script>
    
    <!------------------------------My functions--------------------------------->
    <script>
        const base_url = "<?= base_url(); ?>";
        const MS = "<?=$company['currency']['symbol'];?>";
        const MD = "<?=$company['currency']['code']?>";
        const COMPANY = "<?=$company['name']?>";
        const SHAREDHASH ="<?=strtolower(str_replace(" ","",$company['name']))?>";
    </script>
    
    <script src="<?=media();?>/js/functions.js?v=<?=rand()?>"></script>
    <script src="<?=media();?>/template/Assets/js/functions_general.js?v=<?=rand()?>"></script>
    <?php if(isset($data['app'])){?>
    <script src="<?=media();?>/template/Assets/js/<?=$data['app']."?v=".rand()?>"></script>
    <?php }?>
    <?php if(isset($data['panelapp'])){?>
    <script src="<?=media();?>/js/<?=$data['panelapp']."?v=".rand()?>"></script>
    <?php }?>
</body>
</html>