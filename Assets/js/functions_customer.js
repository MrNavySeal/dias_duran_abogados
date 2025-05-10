const App = {
    data() {
        return {
            //Paginación
            paginaActual: 1,
            intInicioPagina:1,
            intTotalPaginas:1,
            intTotalBotones:1,
            selectPorPagina:25,

            //Variables formulario
            arrClientes: [],
            txtSearchNombre: '',
            txtSearchDocumento: '',
            
        };
    },
    mounted(){
        this.getInitialData();
    },
    methods:{
        async getInitialData(intPagina=1) {
            let formData = new FormData();
            formData.append("search_nombre", this.txtSearchNombre);
            formData.append("search_documento", this.txtSearchDocumento);
            formData.append("limite_pagina", this.selectPorPagina);
            formData.append("pagina_actual", this.paginaActual);
            const response = await fetch(base_url+"/Clientes/getClientes",{method:"POST",body:formData});
            const objData = await response.json();
            this.arrClientes = objData.arr_clientes;
        },
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");