

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
            strImgUrl:base_url+'/Assets/images/uploads/user.jpg',
            strImagen:"",
            strNombre:"",
            strApellido:"",
            strDocumento:"",
            strCorreo:"",
            intPais:"",
            intDepartamento:"",
            intCiudad:"",
            strTelefono:"",
            strDireccion:"",
            strContrasena:"",
            intEstado:"",
            intTipoDocumento:"",
            strTituloModal:"",
            intTelefonoCodigo:"",
            arrTiposDocumento:"",
            arrPaises:[],
            arrDepartamentos:[],
            arrCiudades:[],
        };
    },mounted(){
        this.getBuscar();
        this.getDatosIniciales();
    },methods:{
        getDatosIniciales:async function(){
            const response = await fetch(base_url+"/clientes/getDatosIniciales");
            const objData = await response.json();
            this.arrPaises = objData.paises;
            this.arrTiposDocumento = objData.tipos_documento;
        },
        setFiltro:async function(tipo){
            if(tipo == "paises" && this.intPais != ""){
                this.intTelefonoCodigo = this.intPais;
                const response = await fetch(base_url+"/clientes/getEstados/estado/"+this.intPais);
                const objData = await response.json();
                this.arrDepartamentos = objData;
                this.arrCiudades = [];
            }else if(tipo == "departamentos" && this.intDepartamento != ""){
                const response = await fetch(base_url+"/clientes/getEstados/ciudad/"+this.intDepartamento);
                const objData = await response.json();
                this.arrCiudades = objData;
            }
        },
        showModal:function(){
            this.strTituloModal = "Nuevo cliente";
            this.strImgUrl= base_url+'/Assets/images/uploads/user.jpg';
            this.strImagen= "";
            this.strApellido= "";
            this.strDocumento= "";
            this.strCorreo= "";
            this.intPais= "";
            this.intDepartamento= "";
            this.intCiudad= "";
            this.strTelefono= "";
            this.strDireccion="";
            this.strContrasena="";
            this.intTipoDocumento="";
            this.intEstado= 1;
            this.intId = 0;
            this.modal = new bootstrap.Modal(document.querySelector("#modalCustomer"));
            this.modal.show();
        },
        setDatos: async function(){
            if(this.strNombre == "" || this.strApellido == "" || this.strTelefono == "" || this.intTelefonoCodigo ==""
                || this.intTipoDocumento == "" || this.intPais == "" || this.intDepartamento == "" || this.intCiudad == ""
                || this.strDocumento == ""
            ){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            if(this.strContrasena.length < 8 && this.strContrasena!=""){
                Swal.fire("Error","La contraseña debe tener al menos 8 caracteres","error");
                return false;
            }
            if(!fntEmailValidate(this.strCorreo) && this.strCorreo!=""){
                Swal.fire("Error","El email es invalido","error");
                return false;
            }
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("imagen",this.strImagen);
            formData.append("nombre",this.strNombre);
            formData.append("apellido",this.strApellido);
            formData.append("tipo_documento",this.intTipoDocumento);
            formData.append("documento",this.strDocumento);
            formData.append("correo",this.strCorreo);
            formData.append("pais",this.intPais);
            formData.append("departamento",this.intDepartamento);
            formData.append("ciudad",this.intCiudad);
            formData.append("pais_telefono",this.intTelefonoCodigo);
            formData.append("telefono",this.strTelefono);
            formData.append("direccion",this.strDireccion);
            formData.append("contrasena",this.strContrasena);
            formData.append("estado",this.intEstado);
            const response = await fetch(base_url+"/clientes/setCliente",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                if(this.intId == 0){
                    this.strImgUrl= base_url+'/Assets/images/uploads/user.jpg';
                    this.strImagen= "";
                    this.strApellido= "";
                    this.strDocumento= "";
                    this.strCorreo= "";
                    this.intPais= "";
                    this.intDepartamento= "";
                    this.intCiudad= "";
                    this.strTelefono= "";
                    this.strDireccion="";
                    this.strContrasena="";
                    this.intTipoDocumento="";
                    this.intEstado= 1;
                }
                this.modal.hide();
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
            //await this.getBuscar(1,"clientes");
        },
        getBuscar:async function (intPagina=1,strTipo = ""){
            this.intPagina = intPagina;
            const formData = new FormData();
            formData.append("paginas",this.intPorPagina);
            formData.append("pagina",this.intPagina);
            formData.append("buscar",this.strBuscar);
            formData.append("tipo_busqueda",strTipo);
            const response = await fetch(base_url+"/clientes/getBuscar",{method:"POST",body:formData});
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
          this.strTituloModal = "Editar área";
          const formData = new FormData();
          formData.append("id",this.intId);
          formData.append("tipo_busqueda",strTipo);
          const response = await fetch(base_url+"/Areas/getDatos",{method:"POST",body:formData});
          const objData = await response.json();
          if(objData.status){
              this.strImgUrl= objData.data.url,
              this.strImagen= "",
              this.strNombre= objData.data.name,
              this.strDescripcionCorta= objData.data.short_description,
              this.intEstado= objData.data.status,
              this.modal = new bootstrap.Modal(document.querySelector("#modalAreas"));
              this.modal.show();
          }else{
              Swal.fire("Error",objData.msg,"error");
          }
        },
        openBotones:function(tipo,dato){ 
            if(tipo == "correo")window.open('mailto:'+dato);
            if(tipo == "llamar")window.open('tel:'+dato);
            if(tipo == "wpp")window.open('https://wa.me/'+dato);
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
                  const response = await fetch(base_url+"/Areas/delDatos",{method:"POST",body:formData});
                  const objData = await response.json();
                  if(objData.status){
                    Swal.fire("Eliminado!",objData.msg,"success");
                    objVue.getBuscar(1,"areas");
                  }else{
                    Swal.fire("Error",objData.msg,"error");
                  }
              }else{
                objVue.getBuscar(1,"areas");
              }
          });
        },
        getBotones:function(){
            this.arrBotones = [];
            for (let i = this.intInicioPagina; i < this.intTotalBotones; i++) {
                this.arrBotones.push(i);
            }
        },
        uploadImagen:function(e){
            this.strImagen = e.target.files[0];
            let type = this.strImagen.type;
            if(type != "image/png" && type != "image/jpg" && type != "image/jpeg" && type != "image/gif"){
                Swal.fire("Error","Solo se permite imágenes.","error");
            }else{
                let objectUrl = window.URL || window.webkitURL;
                let route = objectUrl.createObjectURL(this.strImagen);
                this.strImgUrl = route;
            }
        }
    }
};
const app = Vue.createApp(App);
app.mount("#app");