<?php
    headerPage($data);
    $company = $data['company'];
?>
<main>
    <?php getComponent("pageCover",$data)?>
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("blogAside",$data)?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="blog">
                    <h1 class="t-color-2 fs-1 mt-0">Habrá justicia para ti si eres inocente</h1>
                    <div class="blog-img">
                        <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                    </div>
                    <ul class="blog-detail fs-5 mt-3">
                        <li><img src="<?=media()?>/images/uploads/about_img.jpg" alt=""></li>
                        <li class="me-2 ms-2 t-color-2"><h4 class="mb-0">Vilma ladino</h4></li>
                        <li class="me-2 ms-2 t-color-3">|</li>
                        <li class="t-color-1">Categoría</li>
                        <li class="me-2 ms-2 t-color-3">|</li>
                        <li class="t-color-2">Oct 12, 2025</li>
                    </ul>
                    <div class="my-5">
                        <span class="">Compartir en:</span>
                        <ul class="social">
                            <li title="Compartir en facebook"><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?=$urlShare?>&amp;t=<?=$articulo['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li title="Compartir en twitter"><a href="#" onclick="window.open('https://twitter.com/intent/tweet?text=<?=$articulo['name']?>&amp;url=<?=$urlShare?>&amp;hashtags=<?=$company['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li title="Compartir en linkedin"><a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?url=<?=$urlShare?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li title="Compartir en whatsapp"><a href="#" onclick="window.open('https://api.whatsapp.com/send?text=<?=$urlShare?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="mb-4">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi deleniti qui nulla, praesentium odio ad beatae maxime, omnis tempore, et perferendis soluta? Quibusdam, necessitatibus blanditiis dignissimos eveniet ipsum iste reiciendis.
                    </div>
                    <div>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi quibusdam id provident a necessitatibus? Corrupti nulla magnam ea quia quos maiores odit libero veritatis illum! Harum blanditiis reprehenderit dicta quod!
                    </div>
                    <div class="my-5">
                        <span class="">Compartir en:</span>
                        <ul class="social">
                            <li title="Compartir en facebook"><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?=$urlShare?>&amp;t=<?=$articulo['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li title="Compartir en twitter"><a href="#" onclick="window.open('https://twitter.com/intent/tweet?text=<?=$articulo['name']?>&amp;url=<?=$urlShare?>&amp;hashtags=<?=$company['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li title="Compartir en linkedin"><a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?url=<?=$urlShare?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li title="Compartir en whatsapp"><a href="#" onclick="window.open('https://api.whatsapp.com/send?text=<?=$urlShare?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <ul class="blog-next">
                        <li>
                            <el-link :underline="false" href="#" type="primary"> <i class="fas fa-arrow-left"></i> Noticia anterior</el-link>
                        </li>
                        <li>
                            <el-link :underline="false" href="#" type="primary"> Siguiente noticia <i class="fas fa-arrow-right"></i></el-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Blog -->
        <?php 
            $data['section_title'] = "Noticias relacionadas"; 
            $data['section_subtitle'] = ""; 
            getComponent("blogSection",$data);
        ?>
</main>
<?php  footerPage($data); ?>