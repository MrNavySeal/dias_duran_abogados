<?php headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("blogAside",$data)?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="blog">
                    <div class="blog-card mb-4">
                        <div class="blog-img">
                            <el-link :underline="false" href="#" type="primary"><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></el-link>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-detail fs-5 mt-3">
                                <li><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></li>
                                <li class="me-2 ms-2 t-color-2"><h4 class="m-0">Vilma ladino</h4></li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-1">Categoría</li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-2">Oct 12, 2025</li>
                            </ul>
                            <el-link :underline="false" href="#" type="primary"><h2>Habrá justicia para ti si eres inocente</h2></el-link>
                            <p class="t-color-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid vero suscipit eos, reiciendis officia earum temporibus aut quas animi necessitatibus laborum, autem doloremque iste voluptates ut dolorem ipsam alias. Voluptatibus.</p>
                            <el-link class="btn btn-bg-2 py-2 px-3 mt-4" :underline="false" href="#" type="primary">Leer más</el-link>
                        </div>
                    </div>
                    <div class="blog-card mb-4">
                        <div class="blog-img">
                            <el-link :underline="false" href="#" type="primary"><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></el-link>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-detail fs-5 mt-3">
                                <li><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></li>
                                <li class="me-2 ms-2 t-color-2"><h4 class="m-0">Vilma ladino</h4></li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-1">Categoría</li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-2">Oct 12, 2025</li>
                            </ul>
                            <el-link :underline="false" href="#" type="primary"><h2>Habrá justicia para ti si eres inocente</h2></el-link>
                            <p class="t-color-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid vero suscipit eos, reiciendis officia earum temporibus aut quas animi necessitatibus laborum, autem doloremque iste voluptates ut dolorem ipsam alias. Voluptatibus.</p>
                            <el-link class="btn btn-bg-2 py-2 px-3 mt-4" :underline="false" href="#" type="primary">Leer más</el-link>
                        </div>
                    </div>
                    <div class="blog-card mb-4">
                        <div class="blog-img">
                            <el-link :underline="false" href="#" type="primary"><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></el-link>
                        </div>
                        <div class="blog-info">
                            <ul class="blog-detail fs-5 mt-3">
                                <li><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></li>
                                <li class="me-2 ms-2 t-color-2"><h4 class="m-0">Vilma ladino</h4></li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-1">Categoría</li>
                                <li class="me-2 ms-2 t-color-3">|</li>
                                <li class="t-color-2">Oct 12, 2025</li>
                            </ul>
                            <el-link :underline="false" href="#" type="primary"><h2>Habrá justicia para ti si eres inocente</h2></el-link>
                            <p class="t-color-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid vero suscipit eos, reiciendis officia earum temporibus aut quas animi necessitatibus laborum, autem doloremque iste voluptates ut dolorem ipsam alias. Voluptatibus.</p>
                            <el-link class="btn btn-bg-2 py-2 px-3 mt-4" :underline="false" href="#" type="primary">Leer más</el-link>
                        </div>
                    </div>
                    <?php getComponent("paginationPage",$data)?>
                </div>
            </div>
        </div>
    </section>
</main>
<?php footerPage($data); ?>