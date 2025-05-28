<?php  headerPage($data); ?>
<main>
    <?php getComponent("pageCover",$data)?>
    <!-- Servicios -->
    <?php getComponent("serviceSection")?>
    <!-- Blog -->
    <?php 
        $data['section_title'] = "Noticias más recientes"; 
        $data['section_subtitle'] = "Nuestro blog"; 
        getComponent("blogSection",$data);
    ?>
</main>
<?php footerPage($data);?>