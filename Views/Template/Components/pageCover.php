<div class="page-cover">
    <img src="<?=$data['url']?>">
    <div class="page-cover-content">
        <h3 class="t-color-4 fs-11 text-center"><?=$data['page_name']?></h3>
        <nav class="mt-4">
            <ul>
                <li class="t-color-4 mx-2"><el-link :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link></li>
                <li class="t-color-4 mx-2">|</li>
                <?php if(isset($data['category'])){?>
                    <li class="t-color-3 mx-2"><el-link :underline="false" href="<?=$data['category']['url']?>" type="primary"><?=$data['category']['name']?></el-link></li>
                    <li class="t-color-4 mx-2">|</li>
                <?php }?>
                <li class="t-color-3 mx-2"><?=$data['page_name']?></li>
            </ul>
        </nav>
    </div>
</div>