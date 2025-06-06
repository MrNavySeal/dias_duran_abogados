<?php
    $arrData = $data;
    $strTipoBusqueda = is_array($data) ? $data['tipo'] : $data;
    $strVariable = is_array($data) ? $data['variable'] : "arrData";
    $strFuncion = is_array($data) ? $data['funcion'] : "getBuscar";
?>
<div v-if="<?=$strVariable?>.length > 0">
    <p class="text-center m-0 mb-1"><strong>Total de registros: </strong> {{intTotalResultados}}</p>
    <p class="text-center m-0 mb-1">Página {{ intPagina }} de {{ intTotalPaginas }}</p>
    <nav aria-label="Page navigation example" class="d-flex justify-content-center w-100">
        <ul class="pagination" id="pagination">
            <li class="page-item" v-show="intPagina > 1">
                <a class="page-link text-secondary" href="#" @click="<?=$strFuncion?>(intPagina = 1,'<?=$strTipoBusqueda?>')" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
            <li class="page-item" v-show="intPagina > 1">
                <a class="page-link text-secondary" href="#" @click="<?=$strFuncion?>(--intPagina,'<?=$strTipoBusqueda?>')" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </a>
            </li>
            <li v-for="(pagina,index) in arrBotones" :key="index"  @click="<?=$strFuncion?>(pagina,'<?=$strTipoBusqueda?>')" class="page-item">
                <a :class="intPagina == pagina ?  'bg-primary text-white' : 'text-secondary'" class="page-link" href="#">{{pagina}}</a>
            </li>
            <li class="page-item" v-show="intPagina < intTotalPaginas" @click="<?=$strFuncion?>(++intPagina,'<?=$strTipoBusqueda?>')">
                <a class="page-link text-secondary" href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </a>
            </li>
            <li class="page-item" v-show="intPagina < intTotalPaginas" @click="<?=$strFuncion?>(intPagina = intTotalPaginas,'<?=$strTipoBusqueda?>')">
                <a class="page-link text-secondary" href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        </ul>
    </nav>
</div>