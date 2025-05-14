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
                <h5 class="t-color-1 fw-bold fs-3 mb-4">Nuestras áreas de asesoría</h5>
                <h2 class="t-color-2 mb-5 fs-11 fw-bold">Lo que te ofrecemos</h2>
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-sm-12">
                        <el-card class="card-product my-3">
                            <div class="card-product-img">
                                <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                            </div>
                            <el-link :underline="false" href="#" type="primary"><h3 class="t-color-2 fs-3 mt-2">Derecho Tributario y Planeación Fiscal</h3></el-link>
                            
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur ullam ex maiores atque nemo velit voluptas assumenda molestias ea</p>
                            <div class="d-flex justify-content-center">
                                <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" href="#" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                            </div>
                        </el-card>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contacto -->
        <?php getComponent("contactForm"); ?>
        <!-- Equipo -->
        <?php getComponent("team")?>
        <!-- Testimonios -->
        <?php getComponent("testimonial")?>
        <!-- Blog -->
        <?php 
            $data['section_title'] = "Noticias más recientes"; 
            $data['section_subtitle'] = "Nuestro blog"; 
            getComponent("blogSection",$data);
        ?>
    </main>
<?php footerPage($data); ?>