<aside class="blog-aside">
    <div class="border p-5 mb-4">
        <h3 class="mb-5 fs-5">Buscar</h3>
        <div>
            <el-input v-model="strBuscar" placeholder="Buscar">
            <template #append>
                <el-button @click="getBuscar(intPagina = 1,'<?=$data?>','buscar')" class="btn btn-bg-2 h-100" type="primary"><i class="fas fa-search"></i></el-button>
            </template>
        </div>
    </div>
    <div class="border p-5 my-4">
        <h3 class="mb-5 fs-5">Categorías</h3>
        <div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-bottom" v-for="(data,index) in arrCategorias"><el-link :underline="false" :href="data.route"  type="primary" class="d-block">{{data.name}}</el-link></li>
            </ul>
        </div>
    </div>
    <div class="border p-5 my-4">
        <h3 class="mb-5 fs-5">Siguenos</h3>
        <ul class="social"> <?=getRedesSociales()?> </ul>
    </div>
    <div class="border p-5 my-4">
        <h3 class="mb-5 fs-5">Publicaciones recientes</h3>
        <div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item border-bottom" v-for="(data,index) in arrRecientes"><el-link :underline="false" :href="data.route" type="primary" class="d-block">{{data.name}} | {{data.date_format}}</el-link></li>
            </ul>
        </div>
    </div>
</aside>