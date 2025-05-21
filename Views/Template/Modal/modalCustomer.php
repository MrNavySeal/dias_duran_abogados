<div class="modal fade" id="modalCustomer">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{strTituloModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formItem" name="formItem" class="mb-4">
                    <div class="mb-3 uploadImg">
                        <img :src="strImgUrl">
                        <label for="strImagen"><a class="btn btn-info text-white"><i class="fas fa-camera"></i></a></label>
                        <input class="d-none" type="file" id="strImagen" @change="uploadImagen"  accept="image/*"> 
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="strNombre" class="form-label">Nombres <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="strNombre" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="txtLastName" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" v-model="strApellido" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="strDocumento" class="form-label">No. documento <span class="text-danger">*</span></label>
                                <div class="d-flex">
                                    <select class="form-control" v-model="intTipoDocumento" required>
                                        <option value="">Seleccione</option>
                                        <option v-for="(data,index) in arrTiposDocumento" :value="data.id">{{data.name}}</option>
                                    </select>
                                    <input type="text" class="form-control" v-model="strDocumento">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="strCorreo" class="form-label">Correo <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" v-model="strCorreo">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="listCountry" class="form-label">País <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" v-model="intPais" @change="setFiltro('paises')">
                                    <option value="">Seleccione</option>
                                    <option v-for="(data,index) in arrPaises" :value="data.id" >{{data.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="listState" class="form-label">Estado/departamento <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" v-model="intDepartamento" @change="setFiltro('departamentos')">
                                    <option value="">Seleccione</option>
                                    <option v-for="(data,index) in arrDepartamentos" :value="data.id">{{data.name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="listCity" class="form-label">Ciudad <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" v-model="intCiudad">
                                    <option value="">Seleccione</option>
                                    <option v-for="(data,index) in arrCiudades" :value="data.id">{{data.name}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="strTelefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                            <div class="d-flex">
                                <select class="form-control" aria-label="Default select example" v-model="intTelefonoCodigo">
                                    <option value="">Seleccione</option>
                                    <option v-for="(data,index) in arrPaises" :value="data.id">{{"(+"+data.phonecode+") "+data.name}}</option>
                                </select>
                                <input type="phone" class="form-control" v-model="strTelefono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="strDireccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" v-model="strDireccion">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="txtPassword" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" v-model="strContrasena">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="statusList" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" v-model="intEstado" required>
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="setDatos()" ref="btnAdd"><i class="fas fa-save"></i> Guardar</button>
                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>