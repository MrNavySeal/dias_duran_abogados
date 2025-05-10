<div class="page-cover">
    <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
    <div class="page-cover-content">
        <h3 class="t-color-4 fs-11"><?=$data['page_name']?></h3>
        <nav class="mt-4">
            <ul>
                <li class="t-color-4 mx-2"><el-link :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link></li>
                <li class="t-color-4 mx-2">|</li>
                <li class="t-color-3 mx-2"><?=$data['page_name']?></li>
            </ul>
        </nav>
    </div>
</div>