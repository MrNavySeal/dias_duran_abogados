<section class="container mt-5 mb-5">
    <div class="row ">
        <div class="col-md-5 p-0">
            <div class="contact-form">
                <img class="contact-form-img" src="<?=$data['url']?>" alt="">
            </div>
        </div>
        <div class="col-md-7 bg-color-2 p-0">
            <div class="contact-form p-5">
                <h5 class="t-color-1 fw-bold fs-3 mb-4">Contáctanos</h5>
                <h2 class="t-color-4 mb-5 fs-1 fw-bold">Haz una cita</h2>
                <el-form :model="form" label-width="auto" style="max-width: 600px">
                    <el-form-item>
                        <el-input v-model="form.name" placeholder="Nombre" />
                    </el-form-item>
                    <el-form-item>
                        <el-input v-model="form.name" placeholder="Correo electrónico" type="email" />
                    </el-form-item>
                    <el-form-item>
                        <el-input v-model="form.name" placeholder="Teléfono" type="phone" />
                    </el-form-item>
                    <el-form-item>
                        <el-input v-model="form.desc" type="textarea" rows="4" placeholder="Escribe comentarios"/>
                    </el-form-item>
                    <el-button class="btn btn-bg-1 p-4 fs-5" type="primary" @click="onSubmit">Enviar ahora</el-button>
                </el-form>
                <ul class="social social--white mt-5"> <?=getRedesSociales()?></ul>
            </div>
        </div>
    </div>
</section>
