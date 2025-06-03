const App = {
    data() {
      return {
        
        strNombre:"",
        strApellido:"",
        strDocumento:"",
        strCorreo:"",
        intPais:"",
        intDepartamento:"",
        intCiudad:"",
        strTelefono:"",
        strDireccion:"",
        strComentario:"",
        intTelefonoCodigo:"",
        intServicio:"",
        arrAreas:[],
        arrPaises:[],
        arrDepartamentos:[],
        arrCiudades:[],
        arrServicios:[],
      };
    },mounted(){
        this.getInitialData();
    },methods:{
        getInitialData: async function(){
            const response = await fetch(base_url+"/contacto/getInitialData");
            const objData = await response.json();
            this.arrAreas = objData.areas;
            this.arrPaises = objData.paises;
            this.arrServicios= objData.servicios;
        },
        setDatos: async function(){
            if(this.strNombre == "" || this.strApellido == "" || this.strTelefono == "" || this.intTelefonoCodigo =="" 
                ||this.intPais == "" || this.intDepartamento == "" || this.intCiudad == "" || this.strComentario ==""
            ){
                Swal.fire("Error","Todos los campos son obligatorios","error");
                return false;
            }
            if(!fntEmailValidate(this.strCorreo) && this.strCorreo!=""){
                Swal.fire("Error","El email es invalido","error");
                return false;
            }
            const formData = new FormData();
            formData.append("nombre",this.strNombre);
            formData.append("apellido",this.strApellido);
            formData.append("correo",this.strCorreo);
            formData.append("pais",this.intPais);
            formData.append("departamento",this.intDepartamento);
            formData.append("ciudad",this.intCiudad);
            formData.append("pais_telefono",this.intTelefonoCodigo);
            formData.append("telefono",this.strTelefono);
            formData.append("direccion",this.strDireccion);
            formData.append("comentario",this.strComentario);
            formData.append("servicio",JSON.stringify(this.arrServicios.filter(function(e){return e.id == vueObject.intServicio})[0]));
            document.querySelector("#btnContacto").innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            document.querySelector("#btnContacto").setAttribute("disabled","");
            const response = await fetch(base_url+"/contacto/setContacto",{method:"POST",body:formData});
            const objData = await response.json();
            document.querySelector("#btnContacto").innerHTML = `Enviar ahora`;
            document.querySelector("#btnContacto").removeAttribute("disabled");
            if(objData.status){
                Swal.fire("Enviado!",objData.msg,"success");
                this.intServicio ="";
                this.strNombre ="";
                this.strComentario="";
                this.strApellido= "";
                this.strCorreo= "";
                this.intPais= "";
                this.intDepartamento= "";
                this.intCiudad= "";
                this.strTelefono= "";
                this.strDireccion="";
                this.intTelefonoCodigo="";
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
        },
        setFiltro:async function(tipo){
            if(tipo == "paises" && this.intPais != ""){
                this.intTelefonoCodigo = this.intPais;
                const response = await fetch(base_url+"/clientes/getEstados/estado/"+this.intPais);
                const objData = await response.json();
                this.arrDepartamentos = objData;
                this.intDepartamento ="";
                this.intCiudad ="";
                this.arrCiudades = [];
            }else if(tipo == "departamentos" && this.intDepartamento != ""){
                const response = await fetch(base_url+"/clientes/getEstados/ciudad/"+this.intDepartamento);
                const objData = await response.json();
                this.arrCiudades = objData;
                this.intCiudad ="";
            }
        },
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");