<?php  headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("navAside");?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="area-content">
                    <div class="area-img">
                        <img src="<?=media()?>/images/uploads/service_product.jpg" alt="">
                    </div>
                    <div class="area-description">
                        <h1>Optimización fiscal para personas y empresas</h1>
                        <div class="fs-3 fw-bold my-2">$350.000</div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet in delectus quasi repellendus harum commodi, voluptatibus nobis repudiandae assumenda ratione, consectetur quibusdam hic? Error, quidem libero. Reprehenderit illum ut voluptas.</p>
                        <div>Área de asesoría: <strong>Derecho Tributario y Planeación Fiscal</strong></div>
                        <div class="d-flex flex-wrap align-items-center my-4">
                            <div>
                                <el-date-picker
                                    v-model="strFecha"
                                    type="datetime"
                                    placeholder="Seleccione fecha y hora"
                                    format="DD/MM/YYYY HH:mm"
                                />
                            </div>
                            <el-button onclick="" class="btn btn-bg-2" type="primary">Agendar</el-button>
                        </div>
                        <div class="area-article">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum harum quasi impedit inventore exercitationem tempore nesciunt accusamus hic! Officia odit ea ad repellat voluptatum porro distinctio ab perferendis fugiat dolor.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5 mb-5 container section-blog">
        <div class="text-center">
            <h2 class="t-color-2 mb-5 fw-bold ">Servicios de Derecho Tributario y Planeación Fiscal</h2>
            <div class="carousel-service owl-carousel owl-theme mb-5" data-bs-ride="carousel">
                <div class="service-card px-2">
                    <div class="service-img my-2">
                        <el-link :underline="false" href="<?=base_url()?>/servicios/servicio" type="primary"><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></el-link>
                    </div>
                    <div class="service-info">
                        <el-link :underline="false" href="<?=base_url()?>/servicios/servicio" type="primary" ><h3 class="fs-4">Optimización fiscal para personas y empresas</h3></el-link>
                        <div class="mb-2 fs-5 fw-bold">$350.000</div>
                        <div>
                            <el-button onclick="" class="btn btn-bg-2" type="primary">Agendar</el-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php footerPage($data);?>