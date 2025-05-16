<?php 
    headerAdmin($data);
    getModal("modalFaq");
?>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <h2 class="text-center"><?=$data['page_title']?></h2>
    <?php getComponent("buttonsAdmin",$data);?>
    <div class="mt-3">
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="intPorPagina" class="form-label">Por página</label>
                    <select class="form-control" aria-label="Default select example" id="intPorPagina" v-model="intPorPagina" @change="getBuscar(1,'faq')">
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
                    <input type="text" class="form-control" id="strBuscar" v-model="strBuscar" @keyup="getBuscar(1,'faq')">
                </div>
            </div> 
        </div>
        <div class="table-responsive overflow-y no-more-tables" style="max-height:50vh">
            <table class="table align-middle table-hover">
                <thead>
                    <tr class="text-center">
                        <th>ID</th>
                        <th>Pregunta</th>
                        <th>Respuesta</th>
                        <th>Estado</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data,index) in arrData" :key="index">
                        <td data-title="ID" class="text-center">{{data.id}}</td>
                        <td data-title="Pregunta">{{data.question}}</td>
                        <td data-title="Respuesta">{{data.answer}}</td>
                        <td data-title="Estado">
                            <span :class="data.status == '1' ? 'bg-success' : 'bg-danger'" class="badge text-white">
                                {{ data.status == '1' ? "Activo" : "Inactivo" }}
                            </span>
                        </td>
                        <td data-title="Opciones">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-success m-1" type="button" title="Editar" v-if="data.edit" @click="getDatos(data.id_banner,'faq')" ><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger m-1" type="button" title="Eliminar" v-if="data.delete" @click="delDatos(data.id_banner,'faq')" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php getComponent("paginationAdmin","faq");?>
    </div>
</div>
<?php footerAdmin($data)?>