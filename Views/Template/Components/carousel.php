<div class="block text-center">
    <el-carousel >
        <el-carousel-item v-for="(data,index) in arrBanners":key="index">
            <img :src="data.url" class="d-block w-100" :alt="data.name">
            <div class="carousel-item-container">
                <div class="carousel-item-content">
                    <h2 class="fs-4 mb-3 t-color-4">{{ data.name }}</h2>
                    <h3 class="fs-1 mb-3 t-color-4 fw-bold">{{ data.description}}</h3>
                    <el-link class="btn btn-bg-1 p-2 fs-5" :underline="false" :href="data.link" type="primary">{{ data.button }}</el-link>
                </div>
            </div>
        </el-carousel-item>
    </el-carousel>
</div>