

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
            strImgUrl:base_url+'/Assets/images/uploads/category.jpg',
            strImagen:"",
            strNombre:"",
            strDescripcion:"",
            strProfesion:"",
            intEstado:"",
            strTituloModal:"",
        };
    },mounted(){
        this.getBuscar(1,"testimonios");
    },methods:{
        showModal:function(){
            this.strTituloModal = "Nuevo testimonio";
            this.strImgUrl= base_url+'/Assets/images/uploads/category.jpg';
            this.strImagen= "";
            this.strNombre= "";
            this.strDescripcion= "";
            this.strProfesion= "";
            this.intEstado= 1;
            this.modal = new bootstrap.Modal(document.querySelector("#modalTestimonial"));
            this.modal.show();
        },
        setDatos: async function(){
            if(this.strNombre == "" || this.strDescripcion == ""){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("imagen",this.strImagen);
            formData.append("nombre",this.strNombre);
            formData.append("descripcion",this.strDescripcion);
            formData.append("profesion",this.strProfesion);
            formData.append("estado",this.intEstado);
            const response = await fetch(base_url+"/Secciones/setTestimonio",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                if(this.intId == 0){
                  this.strImgUrl= base_url+'/Assets/images/uploads/category.jpg';
                  this.strImagen= "";
                  this.strNombre= "";
                  this.strDescripcion= "";
                  this.strProfesion= "";
                  this.intEstado= 1;
                }else{
                  this.modal.hide();
                }
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
            await this.getBuscar(1,"testimonios");
        },
        getBuscar:async function (intPagina=1,strTipo = ""){
            this.intPagina = intPagina;
            const formData = new FormData();
            formData.append("paginas",this.intPorPagina);
            formData.append("pagina",this.intPagina);
            formData.append("buscar",this.strBuscar);
            formData.append("tipo_busqueda",strTipo);
            const response = await fetch(base_url+"/secciones/getBuscar",{method:"POST",body:formData});
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
          this.strTituloModal = "Editar testimonio";
          const formData = new FormData();
          formData.append("id",this.intId);
          formData.append("tipo_busqueda",strTipo);
          const response = await fetch(base_url+"/Secciones/getDatos",{method:"POST",body:formData});
          const objData = await response.json();
          if(objData.status){
              this.strImgUrl= objData.data.url,
              this.strImagen= "",
              this.strNombre= objData.data.name,
              this.strDescripcion= objData.data.description,
              this.strProfesion= objData.data.profession,
              this.intEstado= objData.data.status,
              this.modal = new bootstrap.Modal(document.querySelector("#modalBanner"));
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
                  obj.intId = intId;
                  const formData = new FormData();
                  formData.append("id",obj.intId);
                  formData.append("tipo_busqueda",strTipo);
                  const response = await fetch(base_url+"/Secciones/delDatos",{method:"POST",body:formData});
                  const objData = await response.json();
                  if(objData.status){
                    Swal.fire("Eliminado!",objData.msg,"success");
                    objVue.getBuscar(1,"testimonios");
                  }else{
                    Swal.fire("Error",objData.msg,"error");
                  }
              }else{
                objVue.getBuscar(1,"testimonios");
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