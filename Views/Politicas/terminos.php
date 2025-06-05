<?php
    headerPage($data);
?>
<main>
    <?php getComponent("pageCover",$data)?>
    <div class="section-about container mt-5 mb-5">
        <div><?=$data['data']['description']?></div>
    </div>
</main>
<?php footerPage($data);?>