<section class="container mt-5 mb-5 section-service" v-if="arrAreas && arrAreas.length > 0">
    <div class="text-center">
        <h5 class="t-color-1 fw-bold fs-3 mb-4">Nuestras áreas de asesoría</h5>
        <h2 class="t-color-2 mb-5 fs-11 fw-bold">Lo que te ofrecemos</h2>
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-sm-12" v-for="(data,index) in arrAreas":key="index">
                <el-card class="card-product my-3">
                    <div class="card-product-img">
                        <img :src="data.url" alt="data.name">
                    </div>
                    <el-link :underline="false" :href="data.route" type="primary"><h3 class="t-color-2 fs-3 mt-2">{{data.name}}</h3></el-link>
                    
                    <p>{{data.short_description}}</p>
                    <div class="d-flex justify-content-center">
                        <el-link class="btn btn-bg-2 py-2 fs-5 px-3" :underline="false" :href="data.route" type="primary"><i class="fas fa-chevron-right"></i></el-link>
                    </div>
                </el-card>
            </div>
        </div>
    </div>
</section>