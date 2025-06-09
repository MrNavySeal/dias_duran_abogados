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
                        <th>Transacción</th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>País</th>
                        <th>Cita</th>
                        <?php if($_SESSION['userData']['roleid'] != 2) {?>
                        <th>Valor</th>
                        <?php }?>
                        <th>Total</th>
                        <th>Estado de pago</th>
                        <th>Estado de caso</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(data,index) in arrData" :key="index">
                        <td data-title="ID" class="text-center">{{data.idorder}}</td>
                        <td data-title="Transacción">{{data.idtransaction}}</td>
                        <td data-title="Nombre">{{data.firstname+" "+data.lastname}}</td>
                        <td data-title="Documento">{{data.identification}}</td>
                        <td data-title="Teléfono" class="text-nowrap">{{data.telefono}}</td>
                        <td data-title="Correo">{{data.email}}</td>
                        <td data-title="País">{{data.pais}}</td>
                        <td data-title="Cita" class="text-center text-nowrap">{{data.date}}</td>
                        <?php if($_SESSION['userData']['roleid'] != 2) {?>
                        <td data-title="Valor" class="text-end text-nowrap">{{data.currency_base+" "+formatMoney(data.value_base)}}</td>
                        <?php }?>
                        <td data-title="Total" class="text-end text-nowrap">{{data.currency_target+" "+formatMoney(data.value_target)}}</td>
                        <td data-title="Estado" class="text-center">
                            <span :class="data.status == 'approved' ? 'bg-success text-white' : data.status == 'pendent' ? 'bg-warning text-black' :'bg-danger text-white'" class="badge">
                                {{ data.status == 'approved' ? "pagado" : data.status == 'pendent' ? "pendiente" : "anulado" }}
                            </span>
                        </td>
                        <td data-title="Estado" class="text-center">
                            <span :class="data.statusorder == 'confirmado' ? 'bg-black text-white' : data.statusorder == 'en proceso' ? 'bg-warning text-black' : data.statusorder == 'finalizado' ? 'bg-success text-white' :'bg-danger text-white'" class="badge">
                                {{ data.statusorder}}
                            </span>
                        </td>
                        <td data-title="Opciones">
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-primary text-white m-1" :id="'btnPopover'+data.idorder" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="Copiado!" type="button" title="Paypal"  @click="copiar(data,'btnPopover'+data.idorder)" v-if="data.status != 'approved'"><i class="fab fa-paypal"></i></button>
                                <button class="btn btn-info text-white m-1" type="button" title="Correo" v-if="data.edit" @click="openBotones('correo',data.email)" ><i class="fa fa-envelope"></i></button>
                                <button class="btn btn-success m-1"  title="Whatsapp" v-if="data.edit" @click="openBotones('wpp',data.phonecode+data.phone)"><i class="fab fa-whatsapp"></i></button>
                                <button class="btn btn-success m-1" type="button" title="Editar" v-if="data.edit" @click="getDatos(data.idorder)" ><i class="fas fa-pencil-alt"></i></button>
                                <button class="btn btn-danger m-1" type="button" title="Eliminar" v-if="data.delete && data.status != 'approved'" @click="delDatos(data.idorder)" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <?php getComponent("paginationAdmin","casos");?>
</div>
<?php footerAdmin($data)?>         