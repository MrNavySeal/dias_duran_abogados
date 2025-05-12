<?php headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <aside class="blog-aside">
                    <div class="border p-5 mb-4">
                        <h3 class="mb-5 fs-5">Buscar</h3>
                        <div>
                            <el-input v-model="input1" placeholder="Buscar">
                            <template #append>
                                <el-button onclick="" class="btn btn-bg-2 h-100" type="primary"><i class="fas fa-search"></i></el-button>
                            </template>
                        </div>
                    </div>
                    <div class="border p-5 my-4">
                        <h3 class="mb-5 fs-5">Categorías</h3>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Categoria</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Categoria</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Categoria</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Categoria</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Categoria</el-link></li>
                            </ul>
                        </div>
                    </div>
                    <div class="border p-5 my-4">
                        <h3 class="mb-5 fs-5">Siguenos</h3>
                        <ul class="social">
                            <li><a href="https://web.facebook.com/BuhoMyG" target="_blank"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="https://www.instagram.com/buhos_myg/" target="_blank"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="https://wa.me/573108714741" target="_blank"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="border p-5 my-4">
                        <h3 class="mb-5 fs-5">Publicaciones recientes</h3>
                        <div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Habrá justicia para ti si eres inocente. Mayo 11, 2025</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Habrá justicia para ti si eres inocente. Mayo 11, 2025</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Habrá justicia para ti si eres inocente. Mayo 11, 2025</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Habrá justicia para ti si eres inocente. Mayo 11, 2025</el-link></li>
                                <li class="list-group-item border-bottom"><el-link :underline="false" href="#" type="primary">Habrá justicia para ti si eres inocente. Mayo 11, 2025</el-link></li>
                            </ul>
                        </div>
                    </div>
                </aside>
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
                    <div class="pagination">
                        <ul>
                            <li><i class="fas fa-angle-left"></i></li>
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li><i class="fas fa-angle-right"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php footerPage($data); ?>