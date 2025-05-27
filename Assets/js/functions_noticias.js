

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
            strDescripcionCorta:"",
            intEstado:"",
            strTituloModal:"",
            arrCategorias:[],
            intCategoria:"",
        };
    },mounted(){
        this.getBuscar(1,"noticias");
        this.getDatosIniciales();
    },methods:{
        getDatosIniciales:async function(){
            const response = await fetch(base_url+"/Noticias/getSelectCategorias");
            const objData = await response.json();
            this.arrCategorias = objData;
        },
        showModal:function(){
            this.strTituloModal = "Nueva noticia";
            this.strImgUrl= base_url+'/Assets/images/uploads/category.jpg';
            this.strImagen= "";
            this.strNombre= "";
            this.strDescripcionCorta= "";
            this.strDescripcion= "";
            this.intEstado= 1;
            this.intId = 0;
            this.intCategoria = "";
            setTinymce("#strDescripcion",500);
            document.querySelector("#strDescripcion").value ="";
            this.modal = new bootstrap.Modal(document.querySelector("#modalNews"));
            this.modal.show();
        },
        setDatos: async function(){
            if(this.strNombre == "" || this.intCategoria == ""){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            tinymce.triggerSave();
            this.strDescripcion = document.querySelector("#strDescripcion").value;
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("imagen",this.strImagen);
            formData.append("nombre",this.strNombre);
            formData.append("categoria",this.intCategoria);
            formData.append("descripcion_corta",this.strDescripcionCorta);
            formData.append("descripcion",this.strDescripcion);
            formData.append("estado",this.intEstado);
            const response = await fetch(base_url+"/Noticias/setNoticia",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                if(this.intId == 0){
                    this.strImgUrl= base_url+'/Assets/images/uploads/category.jpg';
                    this.strImagen= "";
                    this.strNombre= "";
                    this.strDescripcionCorta= "";
                    this.strDescripcion= "";
                    this.intEstado= 1;
                    this.intCategoria = "";
                }
                this.modal.hide();
            }else{
              Swal.fire("Error",objData.msg,"error");
            }
            await this.getBuscar(1,"noticias");
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
          this.strTituloModal = "Editar noticia";
          const formData = new FormData();
          formData.append("id",this.intId);
          formData.append("tipo_busqueda",strTipo);
          const response = await fetch(base_url+"/Noticias/getDatos",{method:"POST",body:formData});
          const objData = await response.json();
          if(objData.status){
              this.strImgUrl= objData.data.url,
              this.strImagen= "",
              this.strNombre= objData.data.name,
              this.strDescripcionCorta= objData.data.shortdescription,
              this.intEstado= objData.data.status,
              this.intCategoria = objData.data.category_id;
              setTinymce("#strDescripcion",500);
              document.querySelector("#strDescripcion").value = objData.data.description,
              this.modal = new bootstrap.Modal(document.querySelector("#modalNews"));
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
                    objVue.getBuscar(1,"noticias");
                  }else{
                    Swal.fire("Error",objData.msg,"error");
                  }
              }else{
                objVue.getBuscar(1,"noticias");
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