
<?php
    headerPage($data);
?>
    <main class="container mt-4 mb-4 text-center">
        <div class="d-flex justify-content-center align-items-center p-5 text-center">
            <div>
                <h1 class="fs-1 t-color-2">Error 404</h1>
                <h2 class="fs-2 text-secondary mb-3">¡Uy! Te has perdido.</h2>
                <hr>
                <div class="mt-3 d-flex align-items-center justify-content-center">
                    <el-button onclick="window.location.href='<?=base_url()?>'" class="btn btn-bg-2" type="primary">Inicio</el-button>
                    <?php if(isset($_SESSION['login'])){ ?>
                        <el-button onclick="window.location.href='<?=base_url()?>/usuarios/perfil'" class="btn btn-bg-2" type="primary">Mi perfil</el-button>
                    <?php }else {?>
                        <el-button onclick="openLoginModal();" class="btn btn-bg-2" type="primary">Iniciar sesión</el-button>
                    <?php }?>
                </div>
            </div>
        </div>
    </main>
<?php
    footerPage($data);
?>