<?php
    headerPage($data);
    $company = $data['company'];
    $blog = $data['blog'];
    $strRoute = $blog['route'];
?>
<main>
    <?php getComponent("pageCover",$data)?>
    <input type="hidden" name="" ref="intIdNoticia" value="<?=$data['id']?>">
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
                <?php getComponent("blogAside",$data)?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
                <div class="blog">
                    <h1 class="t-color-2 fs-2 mt-0">{{objData.name}}</h1>
                    <div class="blog-img" v-if="objData.url != ''">
                        <img :src="objData.url" :alt="objData.name">
                    </div>
                    <ul class="blog-detail fs-5 mt-3">
                        <li class="t-color-1">{{objData.category}}</li>
                        <li class="me-2 ms-2 t-color-3">|</li>
                        <li class="t-color-2">{{objData.date_format}}</li>
                    </ul>
                    <div class="my-5">
                        <span class="">Compartir en:</span>
                        <ul class="social">
                            <li title="Compartir en facebook"><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?=$strRoute?>&amp;t=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li title="Compartir en twitter"><a href="#" onclick="window.open('https://twitter.com/intent/tweet?text=<?=$strRoute?>&amp;url=<?=$strRoute?>&amp;hashtags=<?=$company['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li title="Compartir en linkedin"><a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?url=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li title="Compartir en whatsapp"><a href="#" onclick="window.open('https://api.whatsapp.com/send?text=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="mb-4">{{objData.shortdescription}}</div>
                    <div class="area-article" ref="strDescripcion"></div>
                    <div class="my-5">
                        <span class="">Compartir en:</span>
                        <ul class="social">
                            <li title="Compartir en facebook"><a href="#" onclick="window.open('http://www.facebook.com/sharer.php?u=<?=$strRoute?>&amp;t=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li title="Compartir en twitter"><a href="#" onclick="window.open('https://twitter.com/intent/tweet?text=<?=$strRoute?>&amp;url=<?=$strRoute?>&amp;hashtags=<?=$company['name']?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                            <li title="Compartir en linkedin"><a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?url=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-linkedin-in" aria-hidden="true"></i></a></li>
                            <li title="Compartir en whatsapp"><a href="#" onclick="window.open('https://api.whatsapp.com/send?text=<?=$strRoute?>','share','toolbar=0,status=0,width=650,height=450')"><i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <ul class="blog-next">
                        <li v-if="objData.previous && objData.previous.route != ''">
                            <el-link :underline="false" :href="objData.previous.url" type="primary"> <i class="fas fa-arrow-left"></i> Nota anterior</el-link>
                        </li>
                        <li v-if="objData.next && objData.next.route != ''">
                            <el-link :underline="false" :href="objData.next.url" type="primary"> Siguiente nota <i class="fas fa-arrow-right"></i></el-link>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Blog -->
        <?php 
            $data['section_title'] = "Notas jurídicas relacionadas"; 
            $data['section_subtitle'] = ""; 
            getComponent("blogSection",$data);
        ?>
</main>
<?php  footerPage($data); ?>