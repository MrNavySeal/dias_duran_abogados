<?php
    headerPage($data);
?>
    <main class="container mt-4 mb-4 ">
        <div class="text-center d-flex align-items-center justify-content-center flex-column" style="height:50vh">
            <h2 class="fs-1 text-secondary">Oops! Ha ocurrido un error con tu pago :(</h2>
            <p class="m-0">El pago ha sido rechazado</p>
            <hr>
            <div class="mt-3">
                <p class="m-0 fw-bold">Por favor, comunicate por nuestros medios de contacto para ayudarte.</p>
            </div>
            <div>
                <el-link class="btn btn-bg-2 py-2 px-3 mt-4" :underline="false" href="<?=base_url()?>" type="primary">Inicio</el-link>
            </div>
        </div>
    </main>
<?php
    footerPage($data);
?>