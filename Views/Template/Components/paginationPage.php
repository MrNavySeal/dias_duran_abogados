<div class="pagination">
    <ul>
        <li class="page-item" v-show="intPagina > 1"  @click="getBuscar(intPagina = 1,'<?=$data?>')"><i class="fas fa-angle-double-left"></i></li>
        <li v-show="intPagina > 1" @click="getBuscar(--intPagina,'<?=$data?>')"><i class="fas fa-angle-left"></i></li>
        <li  :class="intPagina == pagina ?  'bg-color-2' : ''" v-for="(pagina,index) in arrBotones" :key="index"  @click="getBuscar(pagina,'<?=$data?>')">{{pagina}}</li>
        <li v-show="intPagina < intTotalPaginas" @click="getBuscar(++intPagina,'<?=$data?>')"><i class="fas fa-angle-right"></i></li>
        <li class="page-item" v-show="intPagina < intTotalPaginas" @click="getBuscar(intPagina = intTotalPaginas,'<?=$data?>')"><i class="fas fa-angle-double-right"></i></li>
    </ul>
</div>