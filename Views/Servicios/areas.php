<?php  headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <!-- Servicios -->
    <section class="container mt-5 mb-5 section-service">
        <div class="text-center">
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
<?php footerPage($data);?>