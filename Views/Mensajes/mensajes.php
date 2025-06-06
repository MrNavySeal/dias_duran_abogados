<?php  headerAdmin($data); ?>
<div id="modalItem"></div>
<input type="hidden" ref="intTipoPagina" value="<?=$data['tipo_pagina']?>">
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <?php getComponent("buttonsAdmin",$data);?>
    <ul class="nav nav-pills" id="product-tab" role="tablist">
        <?php if($_SESSION['permitsModule']['w']){?>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="new-tab" data-bs-toggle="tab" data-bs-target="#new" type="button" role="tab" aria-controls="new" aria-selected="true">Enviar mensaje</button>
        </li>
        <?php }?>
        <li class="nav-item" role="presentation" @click="getBuscar(1,'recibidos')">
            <button class="nav-link active" id="inbox-tab" data-bs-toggle="tab" data-bs-target="#inbox" type="button" role="tab" aria-controls="inbox" aria-selected="true">
                Bandeja de entrada
                <span class="badge bg-danger" v-if="arrNuevos.length > 0">{{arrNuevos.length}}</span>
            </button>
        </li>
        <li class="nav-item" role="presentation" @click="getBuscar(1,'enviados')">
            <button class="nav-link" id="sent-tab" data-bs-toggle="tab" data-bs-target="#sent" type="button" role="tab" aria-controls="sent" aria-selected="false">Enviados</button>
        </li>
    </ul>
    
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade" id="new" role="tabpanel" aria-labelledby="new-tab">
            <form id="formEmail" name="formEmail" class="mb-4 mt-4">
                <div class="mb-3">
                    <label for="txtEmail" class="form-label">Para: <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" id="txtEmail" v-model="strCorreo" placeholder="Escribe un correo" required>
                </div>
                <div class="mb-3">
                    <label for="txtEmailCC" class="form-label">CC:</label>
                    <input type="email" class="form-control" id="txtEmailCC" v-model="strCorreoCopia" placeholder="Escribe un correo">
                </div>
                <div class="mb-3">
                    <label for="txtSubject" class="form-label">Asunto:</label>
                    <input type="text" class="form-control" id="txtSubject" v-model="strAsunto" placeholder="Escribe un asunto">
                </div>
                <div class="mb-3">
                    <label for="txtMessage" class="form-label">Mensaje: <span class="text-danger">*</span></label>
                    <textarea class="form-control" v-model="strMensaje" rows="5" placeholder="Escribe tu mensaje"></textarea>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="setMensaje" ref="btnAdd">Enviar <i class="fas fa-paper-plane"></i></button>
                </div>
            </form>
        </div>
        <div class="tab-pane show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
            <div class="table-responsive overflow-y no-more-tables" style="max-height:60vh">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Nombre</th>
                            <th>Asunto</th>
                            <th>Teléfono</th>
                            <th>Correo</th>
                            <th>País</th>
                            <th>Departamento</th>
                            <th>Ciudad</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index) in arrRecibidos" :key="index">
                            <td data-title="Nombre" class="text-nowrap">{{data.name+" "+data.lastname}}</td>
                            <td data-title="Asunto" >{{data.asunto}}</td>
                            <td data-title="Teléfono" class="text-nowrap">{{data.telefono}}</td>
                            <td data-title="Correo" class="text-nowrap">{{data.email}}</td>
                            <td data-title="País" class="text-center">{{data.pais}}</td>
                            <td data-title="Departamento" class="text-center">{{data.departamento}}</td>
                            <td data-title="Ciudad" class="text-center">{{data.ciudad}}</td>
                            <td data-title="Fecha" class="text-center">{{data.date}}</td>
                            <td data-title="Estado" class="text-center">
                                <span :class="data.reply != '' ? 'bg-success text-white' : data.status == '1' ? 'bg-warning text-dark' : 'bg-danger text-white'" class="badge ">
                                    {{ data.reply != '' ? "respondido" : data.status == '1' ? "leído" : "sin leer" }}
                                </span>
                            </td>
                            <td data-title="Opciones" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-info m-1 text-white" type="button" title="Ver mensaje" v-if="data.edit" @click="getDatos(data.id)" ><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-success m-1"  title="Whatsapp" v-if="data.edit" @click="openBotones('wpp',data.phonecode+data.phone)"><i class="fab fa-whatsapp"></i></button>
                                    <button class="btn btn-danger m-1" type="button" title="Eliminar" v-if="data.delete" @click="delDatos(data.id,'recibidos')" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="arrRecibidos.length == 0">
                            <td colspan="9" class="text-center fw-bold">No hay datos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php getComponent("paginationAdmin",["tipo" =>"recibidos","variable" =>"arrRecibidos","funcion" =>"getBuscar"]);?>
        </div>
        <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
            <div class="table-responsive overflow-y no-more-tables" style="max-height:60vh">
                <table class="table align-middle table-hover">
                    <thead>
                        <tr class="text-center">
                            <th>Correo</th>
                            <th>Asunto</th>
                            <th>Fecha</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(data,index) in arrEnviados" :key="index">
                            <td data-title="Correo" class="text-nowrap">{{data.email}}</td>
                            <td data-title="Asunto" >{{data.subject}}</td>
                            <td data-title="Fecha" class="text-center">{{data.date}}</td>
                            <td data-title="Opciones" class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-info m-1 text-white" type="button" title="Ver mensaje" v-if="data.edit" @click="getDatos(data.id,2)" ><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-danger m-1" type="button" title="Eliminar" v-if="data.delete" @click="delDatos(data.id,'enviados')" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr v-if="arrEnviados.length == 0">
                            <td colspan="4" class="text-center fw-bold">No hay datos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php getComponent("paginationAdmin",["tipo" =>"enviados","variable" =>"arrEnviados","funcion" =>"getBuscar"]);?>
        </div>
    </div>
</div> 
<?php footerAdmin($data)?>        