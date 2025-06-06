const App = {
    data() {
      return {
        //Paginacion y filtros
        intPagina:1,
        intInicioPagina:1,
        intTotalPaginas:1,
        intTotalBotones:1,
        intPorPagina:25,
        intTotalResultados:0,
        arrBotones:[],
        strBuscar:"",

        //Variables
        intTipoPagina:"",
        intId:0,
        arrRecibidos:[],
        arrEnviados:[],
        arrNuevos:[],
        strCorreo:"",
        strCorreoCopia:"",
        strAsunto:"",
        strMensaje:"",
        objMensaje:{id:""},
      };
    },mounted(){
        this.intTipoPagina = this.$refs.intTipoPagina.value;
        if(this.intTipoPagina == 3){
            this.getBuscar(1,'recibidos');
        }else if(this.intTipoPagina == 1){
            this.getMensaje();
        }
    },methods:{
        getBuscar:async function(intPagina=1,strTipo = ""){
            this.intPagina = intPagina;
            const formData = new FormData();
            formData.append("paginas",this.intPorPagina);
            formData.append("pagina",this.intPagina);
            formData.append("buscar",this.strBuscar);
            formData.append("tipo_busqueda",strTipo);
            const response = await fetch(base_url+"/mensajes/getBuscar",{method:"POST",body:formData});
            const objData = await response.json();
            if(strTipo =="recibidos"){
                this.arrRecibidos = objData.data;
                this.arrNuevos = objData.full_data.filter(function(e){return e.status == 2});
            }else{
                this.arrEnviados = objData.data;
            }
            this.intInicioPagina  = objData.start_page;
            this.intTotalBotones = objData.limit_page;
            this.intTotalPaginas = objData.total_pages;
            this.intTotalResultados = objData.total_records;
            this.getBotones();
        },
        getBotones:function(){
            this.arrBotones = [];
            for (let i = this.intInicioPagina; i < this.intTotalBotones; i++) {
                this.arrBotones.push(i);
            }
        },
        getDatos:function(id,tipo=1){
            if(tipo==1){
                window.location.href=base_url+'/mensajes/mensaje/'+id
            }else{
                window.location.href=base_url+'/mensajes/enviado/'+id
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
                  const response = await fetch(base_url+"/mensajes/delDatos",{method:"POST",body:formData});
                  const objData = await response.json();
                  if(objData.status){
                    Swal.fire("Eliminado!",objData.msg,"success");
                    objVue.getBuscar(1,strTipo);
                  }else{
                    Swal.fire("Error",objData.msg,"error");
                  }
              }else{
                objVue.getBuscar(1,strTipo);
              }
          });
        },
        getMensaje:async function(){
            this.intId = this.$refs.intId.value;
            const formData = new FormData();
            formData.append("id",this.intId);
            const response = await fetch(base_url+"/mensajes/getMensaje",{method:"POST",body:formData});
            const objData = await response.json();
            this.objMensaje = objData.data;
        },
        setMensaje:async function(){
            if(this.intTipoPagina == 3){
                if(this.strCorreo == "" || this.strMensaje ==""){
                    Swal.fire("Error", "Todos los campos con (*) son obligatorios", "error");
                    return false;
                }
            }else{
                if(this.strMensaje ==""){
                    Swal.fire("Error", "Debes escribir el mensaje!", "error");
                    return false;
                }
            }
            
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("correo",this.strCorreo);
            formData.append("correo_copia",this.strCorreoCopia);
            formData.append("asunto",this.strAsunto);
            formData.append("mensaje",this.strMensaje);

            this.$refs.btnAdd.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            this.$refs.btnAdd.disabled = true;
            const response = await fetch(base_url+"/mensajes/setMensaje",{method:"POST",body:formData});
            const objData = await response.json();
            this.$refs.btnAdd.innerHTML = `Guardar <i class="fas fa-paper-plane"></i>`;
            this.$refs.btnAdd.disabled = false;
            if(objData.status){
                this.strCorreo ="";
                this.strCorreoCopia ="";
                this.strAsunto ="";
                this.strMensaje ="";
                this.getMensaje();
                Swal.fire("Enviado",objData.msg,"success");
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
        },
        openBotones:function(tipo,dato){ 
            if(tipo == "correo")window.open('mailto:'+dato);
            if(tipo == "llamar")window.open('tel:'+dato);
            if(tipo == "wpp")window.open('https://wa.me/'+dato);
        },
    }
  };
const app = Vue.createApp(App);
app.mount("#app");