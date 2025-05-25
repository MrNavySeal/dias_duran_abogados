<?php
    headerPage($data);
?>
    <main class="container mt-4 mb-4 ">
        <div class="text-center d-flex align-items-center justify-content-center flex-column" style="height:50vh">
            <h2 class="fs-1 text-secondary">Gracias por tu compra!</h2>
            <p class="m-0">El pago ha sido realizado</p>
            <p class="m-0">Factura de venta: <?=setDesencriptar($data['id_orden'])?></p>
            <p class="m-0">Transacción: <?=setDesencriptar($data['id_transaction'])?></p>
            <p class="fw-bold">Puedes ver el detalle ingresando a tu perfil de usuario en la sección de casos</p>
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
    </main>
<?php
    footerPage($data);
?>