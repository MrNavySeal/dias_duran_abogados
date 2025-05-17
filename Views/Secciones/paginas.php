<?php 
    headerAdmin($data);
?>
<div class="body flex-grow-1 px-3" id="<?=$data['page_name']?>">
    <h2 class="text-center"><?=$data['page_title']?></h2>
    <?php getComponent("buttonsAdmin",$data);?>
    <ul class="nav nav-pills mb-3" id="product-tab">
        <li class="nav-item">
            <button class="nav-link active" @click="strTipoPagina = 'nosotros'" id="navNosotros-tab" data-bs-toggle="tab" data-bs-target="#navNosotros" type="button" role="tab" aria-controls="navNosotros" aria-selected="true">Nosotros</button>
        </li>
        <li class="nav-item">
            <button class="nav-link " @click="strTipoPagina = 'contacto'" id="navContacto-tab" data-bs-toggle="tab" data-bs-target="#navContacto" type="button" role="tab" aria-controls="navContacto" aria-selected="true">Contacto</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" @click="strTipoPagina = 'terminos'" id="navTerminos-tab" data-bs-toggle="tab" data-bs-target="#navTerminos" type="button" role="tab" aria-controls="navTerminos" aria-selected="true">Términos y condiciones</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" @click="strTipoPagina = 'privacidad'" id="navPoliticas-tab" data-bs-toggle="tab" data-bs-target="#navPoliticas" type="button" role="tab" aria-controls="navPoliticas" aria-selected="true">Políticas de privacidad</button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="navNosotros">
            <div class="mb-3">
                <div class="mb-3 uploadImg">
                    <img :src="strImagenUrlNosotros">
                    <label for="strImagenUrlNosotros"><a class="btn btn-info text-white"><i class="fas fa-camera"></i></a></label>
                    <input class="d-none" id="strImagenUrlNosotros" type="file" accept="image/*" @change="uploadImagen"> 
                </div>
            </div>
            <div class="mb-3">
                <label for="txtName" class="form-label">Título <span class="text-danger">*</span></label>
                <input type="text" class="form-control" v-model="strTituloNosotros" required>
            </div>
            <div class="mb-3">
                <label for="txtName" class="form-label">Subtítulo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" v-model="strSubtituloNosotros" required>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Descripción corta</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" v-model="strDescripcionCortaNosotros" required rows="4"></textarea>
            </div>
            <div class="mb-3">
                <label for="strDescripcionNosotros" class="form-label">Descripción <span class="text-danger">*</span></label>
                <textarea class="form-control" id="strDescripcionNosotros" rows="5"></textarea>
            </div>
        </div>
        <div class="tab-pane fade show active" id="navContacto">

        </div>
        <div class="tab-pane fade show active" id="navTerminos">

        </div>
        <div class="tab-pane fade show active" id="navPoliticas">

        </div>
    </div>
</div>
<?php footerAdmin($data)?>