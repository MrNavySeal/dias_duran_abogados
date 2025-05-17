
window.addEventListener("load",function(){setTinymce("#strDescripcionNosotros");});
const App = {
    data() {
        return {
            strTipoPagina:"nosotros",
            strDescripcionNosotros:"",
            strDescripcionCortaNosotros:"",
            strTituloNosotros:"",
            strSubtituloNosotros:"",
            strImagenNosotros:"",
            strImagenUrlNosotros:base_url+'/Assets/images/uploads/category.jpg',
        };
    },mounted(){
        
    },methods:{
        setDatos: async function(){
            tinymce.triggerSave();
            this.strDescripcionNosotros = document.querySelector("#strDescripcionNosotros").value;
            console.log(this.strDescripcionNosotros);
            const formData = new FormData();
            formData.append("id",this.intId);
            formData.append("nosotros_descripcion",this.strDescripcionNosotros);
            formData.append("nosotros_descripcion_corta",this.strDescripcionCortaNosotros);
            formData.append("nosotros_titulo",this.strSubtituloNosotros);
            formData.append("nosotros_subtitulo",this.strSubtituloNosotros);
            formData.append("nosotros_imagen",this.strImagenNosotros);
            formData.append("")
            formData.append("pagina",this.strTipoPagina);
            const response = await fetch(base_url+"/Secciones/setPagina",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
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
              this.modal = new bootstrap.Modal(document.querySelector("#modalTestimonial"));
              this.modal.show();
          }else{
              Swal.fire("Error",objData.msg,"error");
          }
        },
        uploadImagen:function(e){
            const imagen = e.target.files[0];
            let ruta ="";
            let type = imagen.type;
            if(type != "image/png" && type != "image/jpg" && type != "image/jpeg" && type != "image/gif"){
                Swal.fire("Error","Solo se permite imágenes.","error");
            }else{
                let objectUrl = window.URL || window.webkitURL;
                ruta = objectUrl.createObjectURL(imagen);
            }
            if(this.strTipoPagina == "nosotros"){this.strImagenNosotros=imagen;this.strImagenUrlNosotros=ruta;}
        }
    }
};
const app = Vue.createApp(App);
app.mount("#app");