
const btnAdd = document.querySelector("#btnAdd");
const btnDownloadEdit = document.querySelector("#btnDownloadEdit");
const categoryList = document.querySelector("#categoryList");
const subCategoryContent = document.querySelector("#subCategoryContent");
const subcategoryList = document.querySelector("#subcategoryList");
if(categoryList.value == 0){
    subCategoryContent.classList.add("d-none");
}else{
    subCategoryContent.classList.remove("d-none");
}

btnDownloadEdit.addEventListener("click",function(){
    if(categoryList.value == 0){
        subcategoryList.value ="";
    }
    data = "action=editar&category="+categoryList.value+"&subcategory="+subcategoryList.value;
    window.open(base_url+"/ProductosMasivos/plantilla?"+data,"_blank");
})
function uploadFile(element,type){
    let inputFile = type == 1 ? document.querySelector("#formFile") : document.querySelector("#formFileEdit") ;
    if(inputFile.files.length == 0){
        Swal.fire("Error","Debe subir la plantilla.","error");
        return false;
    }
    let file = inputFile.files[0];
    let extension = file.name.split(".")[1];
    if(extension != "xlsx"){
        Swal.fire("Error","El archivo es incorrecto; por favor, utiliza nuestra plantilla.","error");
        return false;
    }
    let formData = new FormData();
    formData.append("template",file);
    formData.append("type",type);

    element.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Espere...`;  
    element.setAttribute("disabled","");
    request(base_url+"/ProductosMasivos/uploadProducts",formData,"post").then(function(objData){
        element.innerHTML="Cargar archivo";
        element.removeAttribute("disabled","");
        if(objData.status){
            inputFile.files[0] = "";
            Swal.fire("",objData.msg,"success");
        }
    });
}
function changeCategory(){
    if(categoryList.value != 0){
        subCategoryContent.classList.remove("d-none");
        let formData = new FormData();
        formData.append("idCategory",categoryList.value);
        request(base_url+"/ProductosCategorias/getSelectSubcategories",formData,"post").then(function(objData){
            subcategoryList.innerHTML = objData.data;
            subcategoryList.options[0].innerHTML = "Todos";
        });
    }else{
        subCategoryContent.classList.add("d-none");
    }
}