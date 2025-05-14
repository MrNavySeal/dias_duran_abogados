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
    <?php 
        $data['section_title'] = "Noticias más recientes"; 
        $data['section_subtitle'] = "Nuestro blog"; 
        getComponent("blogSection",$data);
    ?>
</main>
<?php footerPage($data);?>