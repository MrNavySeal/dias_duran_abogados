<div class="modal fade" id="modalCase">
    <div class="modal-dialog modal-fullscreen modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{strTituloModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formItem" name="formItem" class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Asignar servicio <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <button type="button" @click="showModal('servicios')" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    <input type="text" class="form-control"  :value="objServicio.name" required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Asignar cliente <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <button type="button" @click="showModal('clientes')" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    <input type="text" class="form-control"  :value="objCliente.firstname+' '+objCliente.lastname" required disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Fecha de cita</label>
                                <input type="date" class="form-control" v-model="strFecha">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Hora de cita</label>
                                <input type="time" class="form-control" v-model="strHora">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Valor <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">{{strMoneda}}</span>
                                <input type="text" class="form-control" v-model="intValorBase" aria-describedby="basic-addon1" @keyup="getConversion()">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Conversión <span class="text-danger">*</span></label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">{{objCliente.currency}}</span>
                                <input type="text" class="form-control" v-model="intValorObjetivo" aria-describedby="basic-addon1" @keyup="getConversion(true)">
                            </div>
                        </div>    
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Titulo del caso</label>
                        <input type="text" class="form-control" v-model="strTitulo">
                    </div>
                    <div class="mb-3">
                        <label for="strDescripcionNosotros" class="form-label">Detalles del caso </label>
                        <textarea class="form-control" id="strDescripcion" rows="5"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="setDatos()" class="btn btn-primary" ref="btnAdd">Guardar <i class="fas fa-save"></i></button>
                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>