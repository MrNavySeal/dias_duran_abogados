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
        <div class="block text-center">
            <el-carousel >
                <el-carousel-item v-for="(data,index) in arrBanners":key="index">
                    <img :src="data.url" class="carousel-cover" :alt="data.name">
                    <div class="carousel-item-container">
                        <div class="carousel-item-content">
                            <h2 class="fs-4 mb-3 t-color-4">{{ data.name }}</h2>
                            <h3 class="fs-11 mb-3 t-color-4 fw-bold">{{ data.description}}</h3>
                            <el-link class="btn btn-bg-1 p-2 fs-5" :underline="false" :href="data.link" type="primary">{{ data.button }}</el-link>
                        </div>
                    </div>
                </el-carousel-item>
            </el-carousel>
        </div>
        <section class="container mt-5 mb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-12 my-2">
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
                <div class="col-xl-3 col-lg-6 col-sm-12 my-2">
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
                <div class="col-xl-3 col-lg-6 col-sm-12 my-2">
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
                <div class="col-xl-3 col-lg-6 col-sm-12 my-2">
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
        <!-- Nosotros -->
        <section class="container mt-5 mb-5">
            <div class="section-about">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="section-about-img">
                            <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 section-about-content">
                        <h5 class="t-color-1 fw-bold fs-3 mb-4">Nosotros</h5>
                        <h2 class="t-color-2 mb-5 fs-11 fw-bold">Asesoría y Consultoría Especializada en Soluciones Legales</h2>
                        <p>Vilma Ladino, es una abogada y consultora especializada en brindar asesoría y consultoría integral a personas naturales y jurídicas en Colombia y en el exterior. Cuento con el respaldo de un equipo multidisciplinario que combina experiencia en las áreas legal, financiera y de seguridad social, para ofrecer estrategias sólidas y soluciones eficientes orientadas a la protección patrimonial, empresarial y laboral.</p>
                        <el-link class="btn btn-bg-2 py-2 fs-5 px-3 mt-4" :underline="false" href="#" type="primary">Leer más</el-link>
                    </div>
                </div>
            </div>
        </section>
        <!-- Servicios -->
        <section class="container mt-5 mb-5 section-service">
            <div class="text-center">
                <h5 class="t-color-1 fw-bold fs-3 mb-4">Nuestros servicios</h5>
                <h2 class="t-color-2 mb-5 fs-11 fw-bold">Lo que te ofrecemos</h2>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <?php getComponent("cardProducts")?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contacto -->
        <section class="container mt-5 mb-5">
            <?php getComponent("contactForm"); ?>
        </section>
        <!-- Equipo -->
        <section class="container mt-5 mb-5 section-team">
            <div class="text-center">
                <h5 class="t-color-1 fw-bold fs-3 mb-4 ">Nuestros equipo</h5>
                <h2 class="t-color-2 mb-5 fs-11 fw-bold ">Nuestro equipo de expertos</h2>
                <div class="carousel-team owl-carousel owl-theme mb-5" data-bs-ride="carousel">
                    <div class="team-card ">
                        <div class="team-img">
                            <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                        </div>
                        <div class="team-info shadow-sm p-3">
                            <el-link :underline="false" href="#" type="primary"><h4 class="t-color-2 fw-bold">Vilma Ladino</h4></el-link>
                            <span class="t-color-1 fw-bold">Abogada</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Testimonios -->
        <section class="mt-5 mb-5 bg-color-2">
            <div>
                <div class="testimonial">
                    <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                    <div class="testimonial-container">
                        <div class="testimonial-content container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="testimonial-titles">
                                        <h5 class="t-color-1 fw-bold fs-3">Testimonios</h5>
                                        <h2 class="t-color-4 mb-5 fs-11 fw-bold">Lo que dicen nuestros clientes de nosotros</h2>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="carousel-testimonial owl-carousel owl-theme" data-bs-ride="carousel">
                                        <div class="testimonial-info">
                                            <div class="testimonial-img">
                                                <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                                            </div>
                                            <div class="testimonial-description">
                                                <h6 class="t-color-2 fs-3 fw-bold">Vilma Ladino</h6>
                                                <span class="t-color-1 fw-bold">Abogada</span>
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe hic quo quaerat obcaecati quasi iste odio quibusdam, cupiditate suscipit veritatis atque quisquam impedit doloremque maxime nisi commodi, nobis veniam! Sunt.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog -->
        <section class="mt-5 mb-5 container section-blog">
            <div class="text-center">
                <h5 class="t-color-1 fw-bold fs-3 mb-4 ">Nuestro blog</h5>
                <h2 class="t-color-2 mb-5 fs-11 fw-bold ">Noticias más recientes</h2>
                <div class="carousel-blog owl-carousel owl-theme mb-5" data-bs-ride="carousel">
                    <div class="blog-card px-2">
                        <div class="blog-img my-2">
                            <el-link :underline="false" href="#" type="primary"><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></el-link>
                        </div>
                        <div class="blog-info">
                            <el-link :underline="false" href="#" type="primary"><h3>Habrá justicia para ti si eres inocente</h3></el-link>
                            <ul class="blog-detail fs-5 mt-3">
                                <li><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></li>
                                <li class="me-2 ms-2 t-color-2"><h4>Vilma ladino</h4></li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-1">Oct 12, 2025</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
<?php
    footerPage($data);
?>