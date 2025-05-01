<div class="modal fade" id="modalElement">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Nueva opción de propiedad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formItem" name="formItem" class="mb-4">
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="txtName" class="form-label">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="txtName" name="txtName" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="statusList" class="form-label">Propiedades <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" id="propList" name="propList" required></select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="orderList" class="form-label">Orden <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" id="orderList" name="orderList" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="txtTag" class="form-label">Etiqueta</label>
                                <input type="text" class="form-control" id="txtTag" name="txtTag" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="txtTag" class="form-label">Etiqueta doblemarco</label>
                                <input type="text" class="form-control" id="txtTagFrame" name="txtTagFrame" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="statusList" class="form-label">Estado <span class="text-danger">*</span></label>
                                <select class="form-control" aria-label="Default select example" id="statusList" name="statusList">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="isVisible">
                            <label class="form-check-label" for="isVisible">Habilitar si es visible en la tienda virtual</label> 
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isColor">
                                    <label class="form-check-label" for="isColor">Habilitar colores</label> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isDblFrame">
                                    <label class="form-check-label" for="isDblFrame">Habilitar doblemarco</label> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isBocel">
                                    <label class="form-check-label" for="isBocel">Habilitar bocel</label> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="isMargin">
                                    <label class="form-check-label" for="isMargin">Habilitar margen</label> 
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="mb-3 d-none" id="divMargin">
                        <label for="txtMargin" class="form-label">Margen máximo (cm)</label>
                        <input type="number" class="form-control" id="txtMargin" value="5">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btnAdd"><i class="fas fa-save"></i> Guardar</button>
                        <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>