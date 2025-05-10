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
        <button class="btn btn-primary" type="button">Agregar <?= $data['page_tag']?> <i class="fas fa-plus"></i></button>
        <?php
        }
        ?>
    </div>

    <div class="mt-3">
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="perPage" class="form-label">Por página</label>
                    <select class="form-control" aria-label="Default select example" id="perPage" v-model="selectPorPagina">
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="250">250</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                        <option value="">Todo</option>
                    </select>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="txtSearchNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="txtSearchNombre" v-model="txtSearchNombre">
                </div>
            </div>

            <div class="col-md-3">
                <div class="mb-3">
                    <label for="txtSearchDocumento" class="form-label">Documento</label>
                    <input type="text" class="form-control" id="txtSearchDocumento" v-model="txtSearchDocumento">
                </div>
            </div>

            <div class="col-md-1 d-flex align-items-end">
                <div class="mb-3 w-100">
                    <button type="button" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </div>

        <div class="table-responsive overflow-y no-more-tables" style="max-height:50vh">
            <table class="table align-middle table-hover">
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
                <tbody>
                    <tr v-for="(item,index) in arrClientes" :key="index">
                        <td>
                            <img v-bind:src="item.image" alt="Imagen de cliente" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>{{ item.nombre_cliente }}</td>
                        <td>{{ item.identification }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.date }}</td>
                        <td>
                            <span :class="item.status == '1' ? 'bg-success' : 'bg-danger'" class="badge text-white">
                                {{ item.status == '1' ? "Activo" : "Inactivo" }}
                            </span>
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
</div>
<?php footerAdmin($data)?>         