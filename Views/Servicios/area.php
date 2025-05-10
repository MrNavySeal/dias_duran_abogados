<?php  headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <section>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <?php getComponent("navAside");?>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12"></div>
        </div>
    </section>
</main>
<?php footerPage($data);?>