<div class="modal fade" id="modalFaq">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{strTituloModal}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formItem" name="formItem" class="mb-4">
                    <div class="mb-3">
                        <label for="txtName" class="form-label">Pregunta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="strNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="txtName" class="form-label">Respuesta <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" v-model="strProfesion" required>
                    </div>
                    <div class="mb-3">
                        <label for="statusList" class="form-label">Estado </label>
                        <select class="form-control" aria-label="Default select example" v-model="intEstado" required>
                            <option value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        </select>
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