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
        <!-- Diferencial -->
        <?php getComponent("differentialSection")?>
        <!-- Nosotros -->
        <section class="container mt-5 mb-5">
            <div class="section-about">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="section-about-img">
                            <img :src="objNosotros.url" :alt="objNosotros.title">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 section-about-content">
                        <h5 class="t-color-1 fw-bold fs-3 mb-4">{{objNosotros.subtitle}}</h5>
                        <h2 class="t-color-2 mb-5 fs-11 fw-bold">{{objNosotros.title}}</h2>
                        <p>{{objNosotros.short_description}}</p>
                        <el-link class="btn btn-bg-2 py-2 fs-5 px-3 mt-4" :underline="false" href="<?=base_url()."/nosotros"?>" type="primary">Leer más</el-link>
                    </div>
                </div>
            </div>
        </section>
        <!-- Servicios -->
        <?php getComponent("serviceSection")?>
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