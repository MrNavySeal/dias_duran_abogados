<?php headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <input type="hidden" name="" ref="intId" :value="<?=$data['id']?>">
    <input type="hidden" name="" ref="strTipo" :value="<?=$data['tipo']?>">
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("navAside");?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="area-content">
                    <div class="area-img">
                        <img :src="objData.url" :alt="objData.name">
                    </div>
                    <div class="area-description">
                        <h1>{{objData.name}}</h1>
                        <p>{{objData.short_description}}</p>
                        <div>Área de asesoría: <strong>{{objData.category}}</strong></div>
                        <div class="d-flex flex-wrap align-items-center my-4">
                            <el-link :underline="false" class="btn btn-bg-2 px-2 py-1 fs-5" href="<?=base_url()?>/contacto" type="primary" >Agendar</el-link>
                        </div>
                        <div class="area-article" ref="strDescripcion"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-5 mb-5 container section-blog">
        <div class="text-center">
            <div class="text-center">
            <h2 class="t-color-2 mb-5 fw-bold ">Servicios de {{objData.category}}</h2>
            <div class="carousel-service owl-carousel owl-theme mb-5" data-bs-ride="carousel">
                <div class="service-card px-2" v-for="(data,index) in objData.services" :key="index">
                    <div class="service-img my-2">
                        <el-link :underline="false" :href="data.route" type="primary"><img :src="data.url" :alt="data.name"></el-link>
                    </div>
                    <div class="service-info">
                        <el-link :underline="false" :href="data.route" type="primary" ><h3 class="fs-4">{{data.name}}</h3></el-link>
                        <div>
                            <el-link :underline="false" class="btn btn-bg-2 px-2 py-1 fs-5" href="<?=base_url()?>/contacto" type="primary" >Agendar</el-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>
<?php footerPage($data);?>