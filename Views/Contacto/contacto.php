<?php
    headerPage($data);
?>
<?php getComponent("pageCover",$data)?>
<main class="container">
    <?php getComponent("contactForm",$data); ?>
</main>
<?php
    footerPage($data);
?>