<div class="modal fade" id="modalCase">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{strTituloModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="getBuscar(1,'casos')"></button>
            </div>
            <div class="modal-body">
                <form id="formItem" name="formItem" class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Asignar servicio <span class="text-danger">*</span></label>
                                        <div class="d-flex">
                                            <button type="button" @click="showModal('servicios')" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                            <input type="text" class="form-control"  :value="objServicio.name" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Asignar cliente <span class="text-danger">*</span></label>
                                        <div class="d-flex">
                                            <button :disabled="strEstado =='approved' && intId > 0" type="button" @click="showModal('clientes')" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                            <input type="text" class="form-control"  :value="objCliente.firstname+' '+objCliente.lastname" required disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Fecha de cita <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" v-model="strFecha">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Hora de cita <span class="text-danger">*</span></label>
                                        <input type="time" class="form-control" v-model="strHora">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Valor <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">{{strMoneda}}</span>
                                        <input :disabled="strEstado =='approved' && intId > 0" type="text" class="form-control text-end" :value="valorBase" aria-describedby="basic-addon1" @keyup="setBase($event)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="form-label">Conversión <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">{{objCliente.currency}}</span>
                                        <input :disabled="strEstado =='approved' && intId > 0" type="text" class="form-control text-end" :value="valorObjetivo" aria-describedby="basic-addon1" @keyup="setObjetivo($event)">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="" class="form-label">Titulo del caso</label>
                                        <input type="text" class="form-control" v-model="strTitulo">
                                    </div>
                                </div>
                                <div class="col-md-12" v-if="intId > 0">
                                    <div class="mb-3">
                                        <label for="strEstado" class="form-label">Estado del caso <span class="text-danger">*</span></label>
                                        <select class="form-control" aria-label="Default select example" id="strEstado" v-model="strEstado" name="strEstado" required>
                                            <option v-for="(data,index) in arrEstados" :key="index" :value="data" >{{data}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                            <div class="mb-3">
                                <label for="strDescripcionNosotros" class="form-label">Detalles del caso </label>
                                <textarea class="form-control" id="strDescripcion" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="setDatos()" class="btn btn-primary" ref="btnAdd">Guardar <i class="fas fa-save"></i></button>
                        <button type="button" class="btn btn-secondary text-white" @click="getBuscar(1,'casos')" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>