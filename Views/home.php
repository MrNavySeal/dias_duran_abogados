<?php
    headerPage($data);
    $social = getSocialMedia();
    $company = $data['company'];
    $links ="";
    $posts = $data['posts'];
    for ($i=0; $i < count($social) ; $i++) { 
        if($social[$i]['link']!=""){
            if($social[$i]['name']=="whatsapp"){
                $links.='<li><a href="https://wa.me/'.$social[$i]['link'].'" target="_blank"><i class="fab fa-'.$social[$i]['name'].'"></i></a></li>';
            }else{
                $links.='<li><a href="'.$social[$i]['link'].'" target="_blank"><i class="fab fa-'.$social[$i]['name'].'"></i></a></li>';
            }
        }
    }

    $tipos = $data['tipos'];
    $productos = $data['productos'];
    $proCant = 4;
    $sliders = round(count($productos)/$proCant);
    $activeSlider = "active";
    $indexProduct=0;
    $categories = $data['categories'];
    $tipos = $data['tipos'];
?>
    <div id="modalItem"></div>
    <div id="modalPoup"></div>
    <main>
        <?php getComponent("carousel",$data)?>
        <section class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    <el-card class="position-relative">
                        <div class="new-service-card mb-3">
                            <div class="new-service-main me-2">
                                <i class="fas fa-users-cog fs-2"></i>
                            </div>
                            <div class="new-service-main">
                                <h4><el-link :underline="false" class="fs-5" href="<?=base_url()?>" type="primary">Equipo de élite</el-link></h4>
                            </div>
                        </div>
                        <div class="new-service-description">
                            <p>Equipo multidisciplinario de abogados y especialistas que brindan un enfoque integral.</p>
                            <div class="d-flex justify-content-end">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </div>
                    </el-card>
                </div>
                <div class="col-md-3">
                    <el-card class="position-relative">
                        <div class="new-service-card mb-3">
                            <div class="new-service-main me-2">
                                <i class="fas fa-user-shield fs-2"></i>
                            </div>
                            <div class="new-service-main">
                                <h4><el-link :underline="false" class="fs-5" href="<?=base_url()?>" type="primary">Asesoría estratégica personalizada</el-link></h4>
                            </div>
                        </div>
                        <div class="new-service-description">
                            <p>Soluciones diseñadas a la medida, con enfoque práctico y orientado a resultados.</p>
                            <div class="d-flex justify-content-end">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </div>
                    </el-card>
                </div>
                <div class="col-md-3">
                    <el-card class="position-relative">
                        <div class="new-service-card mb-3">
                            <div class="new-service-main me-2">
                                <i class="fas fa-map-marked-alt fs-2"></i>
                            </div>
                            <div class="new-service-main">
                                <h4><el-link :underline="false" class="fs-5" href="<?=base_url()?>" type="primary">Innovación y tecnología</el-link></h4>
                            </div>
                        </div>
                        <div class="new-service-description">
                            <p>Atención digital y representación a distancia para colombianos dentro y fuera del país.</p>
                            <div class="d-flex justify-content-end">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </div>
                    </el-card>
                </div>
                <div class="col-md-3">
                    <el-card class="position-relative">
                        <div class="new-service-card mb-3">
                            <div class="new-service-main me-2">
                                <i class="fas fa-poll-h fs-2"></i>
                            </div>
                            <div class="new-service-main">
                                <h4><el-link :underline="false" class="fs-5" href="<?=base_url()?>" type="primary">Resultados comprobados</el-link></h4>
                            </div>
                        </div>
                        <div class="new-service-description">
                            <p>Trayectoria destacada en litigios, conciliaciones, y planificación jurídica y financiera.</p>
                            <div class="d-flex justify-content-end">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </div>
                    </el-card>
                </div>
            </div>
        </section>
        <section class="container mt-5 mb-5">
            <div class="section-about">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="section-about-img">
                            <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <h5 class="t-color-1 fw-bold fs-3 mb-4">Nosotros</h5>
                        <h2 class="t-color-2 mb-5 fs-1 fw-bold">Asesoría y Consultoría Especializada en Soluciones Legales, Financieras y de Seguridad Social</h2>
                        <p>Vilma Ladino, es una abogada y consultora especializada en brindar asesoría y consultoría integral a personas naturales y jurídicas en Colombia y en el exterior. Cuento con el respaldo de un equipo multidisciplinario que combina experiencia en las áreas legal, financiera y de seguridad social, para ofrecer estrategias sólidas y soluciones eficientes orientadas a la protección patrimonial, empresarial y laboral.</p>
                        <el-link class="btn btn-bg-2 py-2 fs-5 px-3 mt-4" :underline="false" href="#" type="primary">Leer más</el-link>
                    </div>
                </div>
            </div>
        </section>
        <section class="container mt-5 mb-5">
            <div class="text-center">
                <h5 class="t-color-1 fw-bold fs-3 mb-4">Nuestros servicios</h5>
                <h2 class="t-color-2 mb-5 fs-1 fw-bold">Lo que te ofrecemos</h2>
                <div class="row">
                    <div class="col-md-4">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-md-4">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-md-4">
                        <?php getComponent("cardProducts")?>
                    </div>
                </div>
            </div>
        </section>
        <?php if(!empty($posts)){?>
        <section class="mt-5">
            <h2 class="section--title">Últimos artículos publicados</h2>
            <div class="row">
                <?php for ($i=0; $i < count($posts) ; $i++) {
                    $img=media()."/images/uploads/category.jpg";
                    if($posts[$i]['picture'] !=""){
                        $img=media()."/images/uploads/".$posts[$i]['picture']; 
                    }
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card" style="width: 100%; height:100%;">
                        <img src="<?=$img?>" alt="<?=$posts[$i]['name']?>">
                        <div class="card-body">
                        <h5 class="card-title"><a class="t-color-2 link-hover-none" href="<?=base_url()."/blog/articulo/".$posts[$i]['route']?>"><?=$posts[$i]['name']?></a></h5>
                            <p class="card-text"><?=$posts[$i]['shortdescription']?></p>
                            <a href="<?=base_url()."/blog/articulo/".$posts[$i]['route']?>" class="btn btn-bg-2">Ver más</a>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>
        </section>
        <?php }?>
    </main>
<?php
    footerPage($data);
?>
    