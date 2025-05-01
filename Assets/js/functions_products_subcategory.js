'use strict';

let modal = document.querySelector("#modalElement") ? new bootstrap.Modal(document.querySelector("#modalElement")) :"";
let table = new DataTable("#tableData",{
    "dom": 'lfBrtip',
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
    },
    "ajax":{
        "url": " "+base_url+"/ProductosCategorias/getSubCategories",
        "dataSrc":""
    },
    columns: [
        { data: 'idsubcategory'},
        { data: 'name' },
        { data: 'category' },
        { data: 'status' },
        { data: 'options' },
    ],
    responsive: true,
    buttons: [
        {
            "extend": "excelHtml5",
            "text": "<i class='fas fa-file-excel'></i> Excel",
            "titleAttr":"Exportar a Excel",
            "className": "btn btn-success mt-2"
        }
    ],
    order: [[0, 'desc']],
    pagingType: 'full',
    scrollY:'400px',
    //scrollX: true,
    "aProcessing":true,
    "aServerSide":true,
    "iDisplayLength": 10,
});
if(document.querySelector("#btnNew")){
    document.querySelector("#btnNew").classList.remove("d-none");
    let btnNew = document.querySelector("#btnNew");
    btnNew.addEventListener("click",function(){
        document.querySelector(".modal-title").innerHTML="Nueva subcategoria";
        document.querySelector("#idSubCategory").value = "";
        document.querySelector("#txtName").value = "";
        document.querySelector("#statusList").value = 1;
        document.querySelector("#categoryList").value = 0;
        modal.show();
    });
}
if(document.querySelector("#formItem")){
    request(base_url+"/ProductosCategorias/getSelectCategories","","get").then(function(objData){
        document.querySelector("#categoryList").innerHTML = objData.data;
    });
    let form = document.querySelector("#formItem");
    form.addEventListener("submit",function(e){
        e.preventDefault();

        let strName = document.querySelector("#txtName").value;
        let idCategory = document.querySelector("#categoryList").value;

        if(strName == "" || idCategory == ""){
            Swal.fire("Error","Todos los campos marcados con (*) son obligatorios","error");
            return false;
        }
        
        let formData = new FormData(form);
        let btnAdd = document.querySelector("#btnAdd");
        btnAdd.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btnAdd.setAttribute("disabled","");

        request(base_url+"/ProductosCategorias/setSubCategory",formData,"post").then(function(objData){
            btnAdd.innerHTML=`<i class="fas fa-save"></i> Guardar`;
            btnAdd.removeAttribute("disabled");
            if(objData.status){
                Swal.fire("Guardado",objData.msg,"success");
                form.reset();
                modal.hide();
                table.ajax.reload();
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
        });
    })
}

function editItem(id){
    let url = base_url+"/ProductosCategorias/getSubCategory";
    let formData = new FormData();
    formData.append("idSubCategory",id);
    request(url,formData,"post").then(function(objData){
        if(objData.status){
            document.querySelector(".modal-title").innerHTML="Actualizar subcategoria";
            document.querySelector("#idSubCategory").value = objData.data.idsubcategory;
            document.querySelector("#txtName").value = objData.data.name;
            document.querySelector("#statusList").value = objData.data.status;
            document.querySelector("#categoryList").value = objData.data.categoryid;
            modal.show();
        }else{
            Swal.fire("Error",objData.msg,"error");
        }
    });
}
function deleteItem(id){
    Swal.fire({
        title:"¿Estás seguro de eliminarlo?",
        text:"Se eliminará para siempre...",
        icon: 'warning',
        showCancelButton:true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText:"Sí, eliminar",
        cancelButtonText:"No, cancelar"
    }).then(function(result){
        if(result.isConfirmed){
            let url = base_url+"/ProductosCategorias/delSubCategory"
            let formData = new FormData();
            formData.append("idSubCategory",id);
            request(url,formData,"post").then(function(objData){
                if(objData.status){
                    Swal.fire("Eliminado",objData.msg,"success");
                    table.ajax.reload();
                }else{
                    Swal.fire("Error",objData.msg,"error");
                }
            });
        }
    });
}
