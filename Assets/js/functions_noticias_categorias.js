

const App = {
    data() {
        return {
            //Modales
            modal:"",

            //Paginacion y filtros
            intPagina:1,
            intInicioPagina:1,
            intTotalPaginas:1,
            intTotalBotones:1,
            intPorPagina:25,
            intTotalResultados:0,
            arrData:[],
            arrBotones:[],
            strBuscar:"",

            //Variables
            intId:0,
            strImagen:"",
            strNombre:"",
            strDescripcion:"",
            strDescripcionCorta:"",
            intEstado:"",
            strTituloModal:"",
        };
    },mounted(){
        this.getBuscar(1,"categorias");
    },methods:{
        showModal:function(){
            this.strTituloModal = "Nueva categoría";
            this.strNombre= "";
            this.intEstado= 1;
            this.intId = 0;
            this.modal = new bootstrap.Modal(document.querySelector("#modalCategory"));
            this.modal.show();
        },
        setDatos: async function(){
            if(this.strNombre == ""){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("nombre",this.strNombre);
            formData.append("estado",this.intEstado);
            this.$refs.btnAdd.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            this.$refs.btnAdd.disabled = true;
            const response = await fetch(base_url+"/Noticias/setCategoria",{method:"POST",body:formData});
            const objData = await response.json();
            this.$refs.btnAdd.innerHTML = `Guardar <i class="fas fa-save"></i>`;
            this.$refs.btnAdd.disabled = false;
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                if(this.intId == 0){
                    this.strNombre= "";
                    this.intEstado= 1;
                }
                this.modal.hide();
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
            await this.getBuscar(1,"categorias");
        },
        getBuscar:async function (intPagina=1,strTipo = ""){
            this.intPagina = intPagina;
            const formData = new FormData();
            formData.append("paginas",this.intPorPagina);
            formData.append("pagina",this.intPagina);
            formData.append("buscar",this.strBuscar);
            formData.append("tipo_busqueda",strTipo);
            const response = await fetch(base_url+"/Noticias/getBuscar",{method:"POST",body:formData});
            const objData = await response.json();
            this.arrData = objData.data;
            this.intInicioPagina  = objData.start_page;
            this.intTotalBotones = objData.limit_page;
            this.intTotalPaginas = objData.total_pages;
            this.intTotalResultados = objData.total_records;
            this.getBotones();
        },
        getDatos:async function(intId,strTipo){
          this.intId = intId;
          this.strTituloModal = "Editar categoría";
          const formData = new FormData();
          formData.append("id",this.intId);
          formData.append("tipo_busqueda",strTipo);
          const response = await fetch(base_url+"/Noticias/getDatos",{method:"POST",body:formData});
          const objData = await response.json();
          if(objData.status){
              this.strNombre= objData.data.name,
              this.intEstado= objData.data.status,
              this.modal = new bootstrap.Modal(document.querySelector("#modalCategory"));
              this.modal.show();
          }else{
              Swal.fire("Error",objData.msg,"error");
          }
        },
        delDatos:function(intId,strTipo){
            const objVue = this;
            Swal.fire({
              title:"¿Esta seguro de eliminarlo?",
              text:"Se eliminará para siempre...",
              icon: 'warning',
              showCancelButton:true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText:"Sí, eliminar",
              cancelButtonText:"No, cancelar"
          }).then(async function(result){
              if(result.isConfirmed){
                  objVue.intId = intId;
                  const formData = new FormData();
                  formData.append("id",objVue.intId);
                  formData.append("tipo_busqueda",strTipo);
                  const response = await fetch(base_url+"/Noticias/delDatos",{method:"POST",body:formData});
                  const objData = await response.json();
                  if(objData.status){
                    Swal.fire("Eliminado!",objData.msg,"success");
                    objVue.getBuscar(1,"categorias");
                  }else{
                    Swal.fire("Error",objData.msg,"error");
                  }
              }else{
                objVue.getBuscar(1,"categorias");
              }
          });
        },
        getBotones:function(){
            this.arrBotones = [];
            for (let i = this.intInicioPagina; i < this.intTotalBotones; i++) {
                this.arrBotones.push(i);
            }
        },
    }
};
const app = Vue.createApp(App);
app.mount("#app");