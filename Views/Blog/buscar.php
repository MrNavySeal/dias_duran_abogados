<?php headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <input type="hidden" name="" ref="strBuscar" value="<?=$data['buscar']?>">
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("blogAside",$data)?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <p class="t-color-2 fw-bold text-center" v-if="arrData.length == 0">No se han encontrado resultados :(</p>
                <div class="blog">
                    <div class="blog-card mb-4" v-for="(data,index) in arrData" :key="index">
                        <div class="blog-img" v-if="data.url !=''">
                            <el-link :underline="false" :href="data.route" type="primary"><img :src="data.url" :alt="data.name"></el-link>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-detail fs-5 mt-3">
                                <li class="t-color-1">{{data.categoria}}</li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-2">{{data.date_format}}</li>
                            </ul>
                            <el-link :underline="false" :href="data.route" type="primary"><h2 class="fs-3">{{data.name}}</h2></el-link>
                            <p class="t-color-2">{{data.shortdescription}}</p>
                            <el-link class="btn btn-bg-2 py-2 px-3 mt-4" :underline="false" :href="data.route" type="primary">Leer más</el-link>
                        </div>
                    </div>
                    <?php getComponent("paginationPage","blog")?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php footerPage($data); ?>