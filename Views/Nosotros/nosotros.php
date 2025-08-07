<?php
    headerPage($data);
?>
<main>
    <?php getComponent("pageCover",$data)?>
    <div class="section-about container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="section-about-img">
                    <img :src="objNosotros.url" :alt="objNosotros.title">
                </div>
            </div>
            <div class="col-md-6 mb-3 section-about-content">
                <h5 class="t-color-1 fw-bold fs-3 mb-4">{{objNosotros.subtitle}}</h5>
                <h2 class="t-color-2 mb-5 fs-1 fw-bold">{{objNosotros.title}}</h2>
                <p>{{objNosotros.short_description}}</p>
            </div>
        </div>
        <div ref="strDescripcion"></div>
    </div>
    <!-- Diferencial -->
    <?php getComponent("differentialSection")?>
    <!-- Servicios -->
    <?php getComponent("serviceSection")?>
    <!-- Testimonios -->
    <?php getComponent("testimonial")?>
    <!-- Equipo -->
    <?php getComponent("team")?>
</main>
<?php footerPage($data);?>