<section class="mt-5 mb-5 container section-blog">
    <div class="text-center">
        <h5 class="t-color-1 fw-bold fs-3 mb-4 "><?=$data['section_subtitle']?></h5>
        <h2 class="t-color-2 mb-5 fs-11 fw-bold "><?=$data['section_title']?></h2>
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