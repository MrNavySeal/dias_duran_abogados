<?php 
    headerAdmin($data);
    getModal("modalCustomer");
    getModal("modalViewCustomer");
?>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <h2 class="text-center"><?=$data['page_title']?></h2>
    <div class="d-flex justify-content-end mb-3">
        <?php
            if($_SESSION['permitsModule']['w']){
        ?>
        <button class="btn btn-primary d-none" type="button" id="btnNew">Agregar <?= $data['page_tag']?> <i class="fas fa-plus"></i></button>
        <?php
        }
        ?>
    </div>
    <table class="table align-middle" id="tableData">
        <thead>
            <tr>
                <th>Portada</th>
                <th>Nombre</th>
                <th>CC/NIT</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
<main class="addFilter container mb-3" id="<?=$data['page_name']?>">
    <div class="row">
        <div class="col-12 col-lg-9 col-md-12">
        </div>
    </div>
</main>
<?php footerAdmin($data)?>         