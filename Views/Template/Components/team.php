<section class="container mt-5 mb-5 section-team" v-if="arrEquipo && arrEquipo.length > 0">
    <div class="text-center">
        <h5 class="t-color-1 fw-bold fs-3 mb-4 ">Nuestros equipo</h5>
        <h2 class="t-color-2 mb-5 fs-11 fw-bold ">Nuestro equipo de expertos</h2>
        <div class="carousel-team owl-carousel owl-theme mb-5" data-bs-ride="carousel">
            <div class="team-card" v-for="(data,index) in arrEquipo" :key="index">
                <div class="team-img">
                    <img :src="data.url" :alt="data.name">
                </div>
                <div class="team-info shadow-sm p-3">
                    <el-link :underline="false" href="#" type="primary"><h4 class="t-color-2 fw-bold">{{data.name}}</h4></el-link>
                    <span class="t-color-1 fw-bold">{{data.profession}}</span>
                </div>
            </div>
        </div>
    </div>
</section>