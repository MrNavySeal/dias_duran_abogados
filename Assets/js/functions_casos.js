

const App = {
    data() {
        return {
            //Modales
            modal:"",
            modalClientes:"",
            modalServicios:"",

            //Paginacion y filtros
            intPagina:1,
            intInicioPagina:1,
            intTotalPaginas:1,
            intTotalBotones:1,
            intPorPagina:25,
            intTotalResultados:0,
            arrData:[],
            arrDataModal:[],
            arrBotones:[],
            strBuscar:"",

            //Variables
            intId:0,
            strImgUrl:base_url+'/Assets/images/uploads/category.jpg',
            strImagen:"",
            strNombre:"",
            strDescripcion:"",
            strDescripcionCorta:"",
            strEstado:"confirmado",
            strTitulo:"",
            strTituloModal:"",
            strMoneda:"",
            intValorBase:0,
            intValorObjetivo:0,
            strFecha:"",
            strHora: "",
            objServicio:{id:"",name:""},
            objCliente:{id:"",firstname:"",lastname:"",currency:"COP"},
        };
    },mounted(){
        //this.getBuscar(1,"casos");
        this.getDatosIniciales();
    },computed:{
        valorBase:function() {
            return formatMoney(this.intValorBase)
        },
        valorObjetivo:function() {
            return formatMoney(this.intValorObjetivo)
        },
    },methods:{
        setBase:function(e){
            const input = e.target.value;
            const numericValue = input.replace(/[^0-9,]/g, "");
            const parts = numericValue.split(",");
            let valor = numericValue;
            if (parts.length > 2) {valor = parts[0] + "," + parts[1];}
            else {valor = numericValue;}
            this.intValorBase = valor;
            this.getConversion(0);
        },
        setObjetivo:function(e){
            const input = e.target.value;
            const numericValue = input.replace(/[^0-9,]/g, "");
            const parts = numericValue.split(",");
            let valor = numericValue;
            if (parts.length > 2) {valor = parts[0] + "," + parts[1];}
            else {valor = numericValue;}
            this.intValorObjetivo = valor;
            this.getConversion(1);
        },
        getDatosIniciales:async function(){
            const response = await fetch(base_url+"/casos/getDatosIniciales");
            const objData = await response.json();
            this.strMoneda = objData.currency;
        },
        showModal:function(tipo="crear"){
            if(tipo == "crear"){ 
                this.strTituloModal = "Nuevo caso";
                this.strEstado= 1;
                this.intId = 0;
                this.intValorBase=0;
                this.intValorObjetivo=0;
                this.strTitulo="";
                this.strFecha="";
                this.strHora="";
                this.objServicio={id:"",name:""};
                this.objCliente={id:"",firstname:"",lastname:"",currency:"COP"};
                setTinymce("#strDescripcion");
                document.querySelector("#strDescripcion").value ="";
                this.modal = new bootstrap.Modal(document.querySelector("#modalCase")); this.modal.show();
            }
            if(tipo == "clientes"){ this.modalClientes = new bootstrap.Modal(document.querySelector("#modalSearchCustomers")); this.modalClientes.show();this.getBuscar(1,"clientes")}
            if(tipo == "servicios"){ this.modalServicios = new bootstrap.Modal(document.querySelector("#modalSearchServices")); this.modalServicios.show();this.getBuscar(1,"servicios")}
            
        },
        setDatos: async function(){
            if(this.objCliente.id == "" || this.objServicio.id == "" || this.strFecha == "" || this.strHora=="" || this.intValorBase=="" || this.intValorObjetivo==""){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            if(this.intValorBase <= 0 || this.intValorObjetivo <=0){
                Swal.fire("Error","El valor y su conversión no puede ser menor o igual a cero","error");
                return false;
            }
            tinymce.triggerSave();
            this.strDescripcion = document.querySelector("#strDescripcion").value;
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("nombre",this.strNombre);
            formData.append("servicio",this.objServicio.id);
            formData.append("cliente",this.objCliente.id);
            formData.append("moneda_base",this.strMoneda);
            formData.append("moneda_objetivo",this.objCliente.currency);
            formData.append("fecha",this.strFecha);
            formData.append("hora",this.strHora);
            formData.append("valor_base",this.intValorBase);
            formData.append("valor_objetivo",this.intValorObjetivo);
            formData.append("descripcion",this.strDescripcion);
            formData.append("titulo",this.strTitulo);

            const response = await fetch(base_url+"/Casos/setCaso",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                if(this.intId == 0){
                    this.intValorBase=0;
                    this.intValorObjetivo=0;
                    this.strTitulo="";
                    this.strFecha="";
                    this.strHora="";
                    this.objServicio={id:"",name:""};
                    this.objCliente={id:"",firstname:"",lastname:"",currency:"COP"};
                    this.strEstado= 1;
                }
                this.modal.hide();
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
            //await this.getBuscar(1,"casos");
        },
        getBuscar:async function (intPagina=1,strTipo = ""){
            this.intPagina = intPagina;
            const formData = new FormData();
            formData.append("paginas",this.intPorPagina);
            formData.append("pagina",this.intPagina);
            formData.append("buscar",this.strBuscar);
            formData.append("tipo_busqueda",strTipo);
            const response = await fetch(base_url+"/casos/getBuscar",{method:"POST",body:formData});
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
              this.strEstado= objData.data.status,
              setTinymce("#strDescripcion");
              document.querySelector("#strDescripcion").value = objData.data.description,
              this.modal = new bootstrap.Modal(document.querySelector("#modalCase"));
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
        setItem:function(data,tipo){
            if(tipo == "servicios"){this.objServicio=data;this.modalServicios.hide()}
            if(tipo == "clientes"){this.objCliente=data;this.modalClientes.hide();this.getConversion()}
        },
        getBotones:function(){
            this.arrBotones = [];
            for (let i = this.intInicioPagina; i < this.intTotalBotones; i++) {
                this.arrBotones.push(i);
            }
        },
        getConversion:async function(flag=0){
            const formData = new FormData();
            formData.append("base",this.strMoneda);
            formData.append("objetivo",this.objCliente.currency);
            formData.append("valor_base",this.intValorBase);
            formData.append("valor_objetivo",this.intValorObjetivo);
            formData.append("modo",flag);
            const response = await fetch(base_url+"/casos/getConversion",{method:"POST",body:formData});
            const objData = await response.json();
            if(flag){ this.intValorBase = objData.data; }
            else { this.intValorObjetivo = objData.data; }
           
        }
    }
};
const app = Vue.createApp(App);
app.mount("#app");