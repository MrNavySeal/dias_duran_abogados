<?php 
    headerAdmin($data);
    getModal("modalCase");
    getModal("modalSearchServices");
    getModal("modalSearchCustomers");
?>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <h2 class="text-center"><?=$data['page_title']?></h2>
    <?php getComponent("buttonsAdmin",$data);?>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="intPorPagina" class="form-label">Por página</label>
                    <select class="form-control" aria-label="Default select example" id="intPorPagina" v-model="intPorPagina" @change="getBuscar(1,'casos')">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="1000">1000</option>
                    </select>
                </div>
            </div>
            <div class="col-md-10">
                <div class="mb-3">
                    <label for="strBuscar" class="form-label">Buscar</label>
                    <input type="text" class="form-control" id="strBuscar" v-model="strBuscar" @keyup="getBuscar(1,'casos')">
                </div>
            </div> 
        </div>
        <div class="table-responsive overflow-y no-more-tables" style="max-height:50vh">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Portada</th>
                        <th>Nombre</th>
                        <th>Tipo documento</th>
                        <th>No. documento</th>
                        <th>Correo</th>
                        <th>País</th>
                        <th>Departamento</th>
                        <th>Ciudad</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <?php getComponent("paginationAdmin","casos");?>
</div>
<?php footerAdmin($data)?>         