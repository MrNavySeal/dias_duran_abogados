<?php
    headerPage($data);
?>
<main>
    <?php getComponent("pageCover",$data)?>
    <div class="section-about container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="section-about-img">
                    <img src="<?=media()?>/images/uploads/about_img.jpg" alt="">
                </div>
            </div>
            <div class="col-md-6 mb-3 section-about-content">
                <h5 class="t-color-1 fw-bold fs-3 mb-4">Nosotros</h5>
                <h2 class="t-color-2 mb-5 fs-11 fw-bold">Asesoría y Consultoría Especializada en Soluciones Legales</h2>
                <p>Vilma Ladino, es una abogada y consultora especializada en brindar asesoría y consultoría integral a personas naturales y jurídicas en Colombia y en el exterior. Cuento con el respaldo de un equipo multidisciplinario que combina experiencia en las áreas legal, financiera y de seguridad social, para ofrecer estrategias sólidas y soluciones eficientes orientadas a la protección patrimonial, empresarial y laboral.</p>
            </div>
        </div>
    </div>
    <!-- Testimonios -->
    <?php getComponent("testimonial")?>
    <!-- Equipo -->
    <?php getComponent("team")?>
</main>
<?php footerPage($data);?>