<?php 
    headerAdmin($data);
    getModal("modalUser");
?>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <h2 class="text-center"><?=$data['page_title']?></h2>
    <?php getComponent("buttonsAdmin",$data);?>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="intPorPagina" class="form-label">Por página</label>
                    <select class="form-control" aria-label="Default select example" id="intPorPagina" v-model="intPorPagina" @change="getBuscar(1,'areas')">
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
                    <input type="text" class="form-control" id="strBuscar" v-model="strBuscar" @keyup="getBuscar(1,'areas')">
                </div>
            </div> 
        </div>
        <div class="table-responsive overflow-y no-more-tables" style="max-height:50vh">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Portada</th>
                        <th>Rol</th>
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
                    <tr v-for="(data,index) in arrData" :key="index">
                        <td data-title="ID" class="text-center">{{data.id}}</td>
                        <td data-title="Portada">
                            <img :src="data.url" :alt="data.name" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td data-title="Rol">{{data.role}}</td>
                        <td data-title="Nombre">{{data.firstname+" "+data.lastname}}</td>
                        <td data-title="Tipo documento">{{data.tipo_documento}}</td>
                        <td data-title="No. documento">{{data.identification}}</td>
                        <td data-title="Correo">{{data.email}}</td>
                        <td data-title="País">{{data.pais}}</td>
                        <td data-title="Departamento">{{data.departamento}}</td>
                        <td data-title="Ciudad">{{data.ciudad}}</td>
                        <td data-title="Teléfono" class="text-nowrap">{{data.telefono}}</td>
                        <td data-title="Dirección">{{data.address}}</td>
                        <td data-title="Fecha">{{data.date}}</td>
                        <td data-title="Estado" class="text-center">
                            <span :class="data.status == '1' ? 'bg-success' : 'bg-danger'" class="badge text-white">
                                {{ data.status == '1' ? "Activo" : "Inactivo" }}
                            </span>
                        </td>
                        <td data-title="Opciones">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-info text-white m-1" type="button" title="Correo" v-if="data.edit" @click="openBotones('correo',data.email)" target="_blank"><i class="fa fa-envelope"></i></button>
                                <button class="btn btn-primary m-1" type="button" title="Correo" v-if="data.edit" @click="openBotones('llamar',data.phonecode+data.phone)" target="_blank"><i class="fa fa-phone"></i></button>
                                <button class="btn btn-success m-1"  title="Whatsapp" v-if="data.edit" @click="openBotones('wpp',data.phonecode+data.phone)"><i class="fab fa-whatsapp"></i></button>
                                <button class="btn btn-success m-1" type="button" title="Editar" v-if="data.edit" @click="getDatos(data.id)" ><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger m-1" type="button" title="Eliminar" v-if="data.delete" @click="delDatos(data.id)" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php getComponent("paginationAdmin","areas");?>
</div>
<?php footerAdmin($data)?>         