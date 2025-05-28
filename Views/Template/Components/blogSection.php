<section class="mt-5 mb-5 container section-blog" v-if="arrNoticias && arrNoticias.length > 0">
    <div class="text-center">
        <h5 class="t-color-1 fw-bold fs-3 mb-4 "><?=$data['section_subtitle']?></h5>
        <h2 class="t-color-2 mb-5 fs-11 fw-bold "><?=$data['section_title']?></h2>
        <div class="carousel-blog owl-carousel owl-theme mb-5" data-bs-ride="carousel">
            <div class="blog-card px-2" v-for="(data,index) in arrNoticias" :key="index">
                <div class="blog-img my-2">
                    <el-link :underline="false" :href="data.route" type="primary"><img :src="data.url" :alt="data.name"></el-link>
                </div>
                <div class="blog-info">
                    <el-link :underline="false" :href="data.route" type="primary"><h3>{{data.name}}</h3></el-link>
                    <ul class="blog-detail fs-5 mt-3">
                        <li><img :src="data.url_picture" alt="data.user_name"></li>
                        <li class="me-2 ms-2 t-color-2 text-start"><h4>{{data.user_name}}</h4></li>
                        <li class="me-2 ms-2 t-color-3">|</li>
                        <li class="t-color-1">{{data.date_format}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>