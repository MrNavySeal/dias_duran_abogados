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
                <el-form :model="form" label-width="auto">
                    <div class="row">
                        <div class="col-md-12">
                            <el-form-item >
                                <el-select  placeholder="Seleccione servicio" v-model="intServicio">
                                    <el-option v-for="(data,index) in arrServicios" :value="data.id" :label="data.name" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-md-6">
                            <el-form-item>
                                <el-input v-model="strNombre" placeholder="Nombre" />
                            </el-form-item>
                        </div>
                        <div class="col-md-6">
                            <el-form-item>
                                <el-input v-model="strApellido" placeholder="Apellido" />
                            </el-form-item>
                        </div>
                        <div class="col-md-12">
                            <el-form-item>
                                <el-input v-model="strCorreo" placeholder="Correo electrónico" type="email" />
                            </el-form-item>
                        </div>
                        <div class="col-md-4">
                            <el-form-item >
                                <el-select  placeholder="País" v-model="intPais" @change="setFiltro('paises')">
                                    <el-option v-for="(data,index) in arrPaises" :value="data.id" :label="data.name" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-md-4">
                            <el-form-item >
                                <el-select  placeholder="Estado/Departamento" v-model="intDepartamento" @change="setFiltro('departamentos')">
                                    <el-option v-for="(data,index) in arrDepartamentos" :value="data.id" :label="data.name" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-md-4">
                            <el-form-item >
                                <el-select  placeholder="Ciudad" v-model="intCiudad">
                                    <el-option v-for="(data,index) in arrCiudades" :value="data.id" :label="data.name" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-4">
                            <el-form-item >
                                <el-select  placeholder="Seleccione" v-model="intTelefonoCodigo">
                                    <el-option v-for="(data,index) in arrPaises" :value="data.id" :label="'(+'+data.phonecode+') '+data.name" />
                                </el-select>
                            </el-form-item>
                        </div>
                        <div class="col-8">
                            <el-form-item>
                                <el-input v-model="strTelefono" placeholder="Teléfono" type="phone" />
                            </el-form-item>
                        </div>
                        <div class="col-md-12">
                            <el-form-item>
                                <el-input v-model="strDireccion" placeholder="Dirección" />
                            </el-form-item>
                        </div>
                    </div>
                    <el-form-item>
                        <el-input v-model="strComentario" type="textarea" rows="4" placeholder="Escribe comentarios"/>
                    </el-form-item>
                    <el-button class="btn btn-bg-1 p-4 fs-5" type="primary" id="btnContacto" @click="setDatos">Enviar ahora</el-button>
                </el-form>
                <ul class="social social--white mt-5"> <?=getRedesSociales()?></ul>
            </div>
        </div>
    </div>
</section>
