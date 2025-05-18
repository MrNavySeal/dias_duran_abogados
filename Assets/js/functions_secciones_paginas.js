
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

            strTituloContacto:"",
            strSubtituloContacto:"",
            strImagenContacto:"",
            strImagenUrlContacto:base_url+'/Assets/images/uploads/category.jpg',

            strTituloTerminos:"",
            strDescripcionTerminos:"",
            
            strTituloPrivacidad:"",
            strDescripcionPrivacidad:"",
        };
    },mounted(){
        this.getDatos();
    },methods:{
        setDatos: async function(){
            tinymce.triggerSave();
            this.strDescripcionNosotros = document.querySelector("#strDescripcionNosotros").value;
            this.strDescripcionTerminos = document.querySelector("#strDescripcionTerminos").value;
            this.strDescripcionPrivacidad = document.querySelector("#strDescripcionPrivacidad").value;
            const formData = new FormData();

            formData.append("nosotros_descripcion",this.strDescripcionNosotros);
            formData.append("nosotros_descripcion_corta",this.strDescripcionCortaNosotros);
            formData.append("nosotros_titulo",this.strTituloNosotros);
            formData.append("nosotros_subtitulo",this.strSubtituloNosotros);
            formData.append("nosotros_imagen",this.strImagenNosotros);
            formData.append("nosotros_pagina","nosotros");

            formData.append("contacto_titulo",this.strTituloContacto);
            formData.append("contacto_subtitulo",this.strSubtituloContacto);
            formData.append("contacto_imagen",this.strImagenContacto);
            formData.append("contacto_pagina","contacto");

            formData.append("terminos_descripcion",this.strDescripcionTerminos);
            formData.append("terminos_titulo",this.strTituloTerminos);
            formData.append("terminos_pagina","terminos");

            formData.append("privacidad_descripcion",this.strDescripcionPrivacidad);
            formData.append("privacidad_titulo",this.strTituloPrivacidad);
            formData.append("privacidad_pagina","privacidad");

            const response = await fetch(base_url+"/Secciones/setPagina",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                this.getDatos();
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
        },
        getDatos:async function(){
            
            const formData = new FormData();
            formData.append("tipo_busqueda","paginas");
            const response = await fetch(base_url+"/Secciones/getDatos",{method:"POST",body:formData});
            const objData = await response.json();
            if(objData.status){
                const data = objData.data;
                this.strDescripcionCortaNosotros=data.nosotros.short_description;
                this.strTituloNosotros=data.nosotros.title;
                this.strSubtituloNosotros=data.nosotros.subtitle;
                this.strImagenUrlNosotros=data.nosotros.url;
                this.strTituloContacto=data.contacto.title;
                this.strSubtituloContacto=data.contacto.subtitle;
                this.strImagenUrlContacto=data.contacto.url;
                this.strTituloTerminos=data.terminos.title;
                this.strTituloPrivacidad=data.privacidad.title;
                
                document.querySelector("#strDescripcionNosotros").value=data.nosotros.description;
                document.querySelector("#strDescripcionTerminos").value=data.terminos.description;
                document.querySelector("#strDescripcionPrivacidad").value=data.privacidad.description;
                
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
            setTinymce("#strDescripcionNosotros",null,false);
            setTinymce("#strDescripcionTerminos",null,false);
            setTinymce("#strDescripcionPrivacidad",null,false);
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
            if(this.strTipoPagina == "contacto"){this.strImagenContacto=imagen;this.strImagenUrlContacto=ruta;}
        }
    }
};
const app = Vue.createApp(App);
app.mount("#app");