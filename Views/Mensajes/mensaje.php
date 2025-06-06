<?php 
    headerAdmin($data);
?>
<div id="modalItem"></div>
<input type="hidden" ref="intTipoPagina" value="<?=$data['tipo_pagina']?>">
<input type="hidden" ref="intId" value="<?=$data['id']?>">
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <?php getComponent("buttonsAdmin",$data);?>
    <h2 class="fs-5">Asunto: {{objMensaje.id !="" ? objMensaje.asunto : ""}}</h2>
    <p></p>
    <div class="d-flex justify-content-between flex-wrap">
        <div>
            <p class="m-0"><strong>De: </strong>{{objMensaje.id !="" ? objMensaje.name+" "+objMensaje.lastname+" <"+objMensaje.email+">" : ""}}</p>
            <p class="m-0"><strong>Teléfono: </strong>{{objMensaje.id !="" ? objMensaje.telefono : ""}}</p>
            <p class="m-0"><strong>Dirección: </strong>{{objMensaje.id !="" ? objMensaje.pais+"/"+objMensaje.departamento+"/"+objMensaje.ciudad+"/"+objMensaje.address : ""}}</p>
        </div>
        <p class="m-0">{{objMensaje.id !="" ? objMensaje.date : ""}}</p>
    </div>
    <hr>
    <label for="" class="fw-bold">Mensaje:</label>
    <p class="m-0">{{objMensaje.id !="" ? objMensaje.message : ""}}</p>
    <hr>
    <div v-if="objMensaje.id != '' && objMensaje.reply != ''">
        <div class="mb-3 d-flex justify-content-between flex-wrap">
            <div>
                <p><strong>Respuesta: </strong></p>
                <p class="m-0">{{objMensaje.id !="" ? objMensaje.reply : ""}}</p>
            </div>
            <p class="m-0">{{objMensaje.id !="" ? objMensaje.date_updated : ""}}</p>
        </div>
        <hr>
    </div>
    <?php if($_SESSION['permitsModule']['w']){?>
        <div class="mb-3" v-if="objMensaje.id != '' && objMensaje.reply == ''">
            <textarea class="form-control" v-model="strMensaje" rows="5" placeholder="Escribe tu respuesta"></textarea>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" @click="setMensaje" ref="btnAdd">Enviar <i class="fas fa-paper-plane"></i></button>
            </div>
        </div>
    <?php }?>
</div>

<?php footerAdmin($data)?>        