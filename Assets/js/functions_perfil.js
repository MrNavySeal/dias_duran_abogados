


const App = {
    data() {
        return {
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
            strContrasenaConfirmada:"",
            intEstado:"",
            intTipoDocumento:"",
            intTelefonoCodigo:"",
            arrTiposDocumento:"",
            arrPaises:[],
            arrDepartamentos:[],
            arrCiudades:[],
        };
    },mounted(){
        this.getPerfil();
    },methods:{
        getPerfil:async function(){
            const response = await fetch(base_url+"/usuarios/getPerfil");
            const objData = await response.json();
            this.arrTiposDocumento = objData.tipos_documento;
            this.arrPaises = objData.paises;
            this.intId = objData.data.idperson;
            this.strImgUrl= objData.data.url,
            this.strNombre= objData.data.firstname,
            this.strApellido= objData.data.lastname,
            this.strDocumento= objData.data.identification,
            this.strCorreo= objData.data.email,
            this.intPais= objData.data.countryid,
            await this.setFiltro("paises");
            this.intDepartamento= objData.data.stateid,
            await this.setFiltro("departamentos");
            this.intCiudad= objData.data.cityid,
            this.strTelefono= objData.data.phone;
            this.strDireccion= objData.data.address;
            this.intTipoDocumento=objData.data.typeid;
            this.intTelefonoCodigo = objData.data.phone_country;
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
        setDatos: async function(){
            if(this.strNombre == "" || this.strApellido == "" || this.strTelefono == "" || this.intTelefonoCodigo ==""
                || this.intTipoDocumento == "" || this.intPais == "" || this.intDepartamento == "" || this.intCiudad == ""
                || this.strDocumento == ""
            ){
                Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
                return false;
            }
            if(this.strContrasena !=""){
                console.log(this.strContrasena);
                    if(this.strContrasena.length < 8){
                        Swal.fire("Error","La contraseña debe tener al menos 8 caracteres","error");
                        return false;
                    }
                    if(this.strContrasena != this.strContrasenaConfirmada){
                        Swal.fire("Error","Las contraseñas no coinciden","error");
                        return false;
                    }
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
            this.$refs.btnAdd.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            this.$refs.btnAdd.disabled = true;
            const response = await fetch(base_url+"/usuarios/updatePerfil",{method:"POST",body:formData});
            const objData = await response.json();
            this.$refs.btnAdd.innerHTML = `Guardar <i class="fas fa-save"></i>`;
            this.$refs.btnAdd.disabled = false;
            if(objData.status){
                Swal.fire("Guardado!",objData.msg,"success");
                this.strContrasena ="";
                this.strContrasenaConfirmada="";
                this.getPerfil();
            }else{
              Swal.fire("Error",objData.msg,"error");
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
        },
    }
};
const app = Vue.createApp(App);
app.mount("#app");

/*
let img = document.querySelector("#txtImg");
let imgLocation = ".uploadImg img";
img.addEventListener("change",function(){
    uploadImg(img,imgLocation);
});

let intCountry = document.querySelector("#countryList");
let intState = document.querySelector("#stateList");
let intCity = document.querySelector("#cityList");
let formProfile = document.querySelector("#formProfile");

request(base_url+"/usuarios/getSelectLocationInfo","","get").then(function(objData){
    intCountry.innerHTML = objData.countries;
    intState.innerHTML = objData.states;
    intCity.innerHTML = objData.cities;
});

intCountry.addEventListener("change",function(){
    let url = base_url+"/usuarios/getSelectCountry/"+intCountry.value;
    request(url,"","get").then(function(objData){
        intState.innerHTML = objData;
    });
    intCity.innerHTML = "";
});
intState.addEventListener("change",function(){
    let url = base_url+"/usuarios/getSelectState/"+intState.value;
    request(url,"","get").then(function(objData){
        intCity.innerHTML = objData;
    });
});

formProfile.addEventListener("submit",function(e){
    e.preventDefault();

    let url = base_url+"/usuarios/updateProfile";
    let strFirstName = document.querySelector("#txtFirstName").value;
    let strLastName = document.querySelector("#txtLastName").value;
    let strEmail = document.querySelector("#txtEmail").value;
    let strPhone = document.querySelector("#txtPhone").value;
    let intCountry = document.querySelector("#countryList").value;
    let intState = document.querySelector("#stateList").value;
    let intCity = document.querySelector("#cityList").value;
    let strAddress = document.querySelector("#txtAddress").value;
    let strDocument = document.querySelector("#txtDocument").value;
    let strPassword = document.querySelector("#txtPassword").value;
    let strConfirmPassword = document.querySelector("#txtConfirmPassword").value;
    let idusuarios = document.querySelector("#idUser").value;

    if(strFirstName == "" || strLastName == "" || strEmail == "" || strPhone == "" || intCountry == 0 || intState == 0
    || intCity == 0 || strAddress =="" || strDocument==""){
        Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
        return false;
    }
    if(strPassword!=""){
        if(strPassword.length < 8){
            Swal.fire("Error","La contraseña debe tener al menos 8 caracteres","error");
            return false;
        }
        if(strPassword != strConfirmPassword){
            Swal.fire("Error","Las contraseñas no coinciden","error");
            return false;
        }
    }
    if(!fntEmailValidate(strEmail)){
        Swal.fire("Error","El correo electrónico no es válido","error");
        return false;
    }
    if(strPhone.length < 10 || strPhone.length > 10){
        Swal.fire("Error","El número de teléfono debe tener 10 dígitos","error");
        return false;
    }
    if(strDocument.length < 8 || strDocument.length > 10){
        Swal.fire("Error","El número de cédula debe tener de 8 a 10 dígitos","error");
        return false;
    }
    let formData = new FormData(formProfile);
    let btnAdd = document.querySelector("#btnAdd");
    btnAdd.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
    btnAdd.setAttribute("disabled","");
    request(url,formData,"post").then(function(objData){
        if(objData.status){
            Swal.fire("Perfil",objData.msg,"success");
        }else{
            Swal.fire("Error",objData.msg,"error");
        }
        btnAdd.innerHTML="Actualizar";
        btnAdd.removeAttribute("disabled");
    })
})*/
