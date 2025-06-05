<section class="container mt-5 mb-5">
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12 mb-2">
            <h5 class="t-color-1 fw-bold fs-3 mb-4">Nuestras áreas de asesoría</h5>
            <h2 class="t-color-2 mb-5 fs-11 fw-bold">Lo que te ofrecemos</h2>
            <div class="area-content">
                <div class="area-description">
                    <p>Brindamos asesoría legal en diversas áreas del derecho, adaptada a las necesidades de nuestros clientes</p>
                </div>
                <div class="area-img">
                    <img :src="objArea.url" :alt="objArea.name">
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 mb-2">
            <?php getComponent("navAside");?>
        </div>
    </div>
</section>