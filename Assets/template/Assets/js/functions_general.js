'use strict'
/*const activePage = window.location.pathname;
const desktop = document.querySelectorAll(".navigation a");
const mobile = document.querySelectorAll(".navigation-mobile a");
for (let i = 0; i < desktop.length; i++) {
    if(desktop[i].href.includes(activePage)){
        desktop[i].parentElement.classList.add("active");
        break;
    }
}
for (let i = 0; i < mobile.length; i++) {
    if(mobile[i].href.includes(activePage)){
        mobile[i].parentElement.classList.add("active");
        break;
    }
}
*/



/***************************General Shop Events****************************** */
//Scroll top
/*window.addEventListener("scroll",function(){
    if(window.scrollY > document.querySelector(".nav--bar").clientHeight){
        document.querySelector(".back--top").classList.remove("d-none");
    }else{
        document.querySelector(".back--top").classList.add("d-none");
    }
});*/

document.addEventListener("DOMContentLoaded",function(){
    let loading = document.querySelector(".loading");
    setTimeout(() => {
        loading.classList.add('hidden');
        setTimeout(() => {
            loading.remove();
        }, 500);
    }, 1500);
    /***************************Nav Events****************************** */
    const btnCart = document.querySelector("#btnCart");
    const navBar = document.querySelector(".navmobile");
    const navMask = document.querySelector(".navmobile--mask");
    const btnNav = document.querySelector("#btnNav");
    const closeNav = document.querySelector("#closeNav");
    const toastLive = document.getElementById('liveToast');



    /********************************Aside nav******************************** */
    btnNav.addEventListener("click",function(){
        navBar.classList.add("active");
        //document.querySelector("#mainNav").classList.remove("d-none");
        document.querySelector("#navProfile").classList.add("d-none");
        document.querySelector("#filterNav").classList.remove("d-none");
        document.querySelector("body").style.overflow="hidden";
    });
    closeNav.addEventListener("click",function(){
        navBar.classList.remove("active");
        document.querySelector("body").style.overflow="auto";
    });
    navMask.addEventListener("click",function(){
        navBar.classList.remove("active");
        document.querySelector("body").style.overflow="auto";
    });

    if(document.querySelector("#myAccount")){
        let myAccount = document.querySelector("#myAccount");
        myAccount.addEventListener("click",function(e){
            openLoginModal();
        });
    }
});
/***************************Essentials Functions****************************** */
function logout(){
    let url = base_url+"/logout";
    request(url,"","get").then(function(objData){ window.location.reload(false);});
}
function openLoginModal(){
    let modalView = new bootstrap.Modal(document.querySelector("#modalLogin"));
    modalView.show();

    let formLogin = document.querySelector("#formLogin");
    let formReset = document.querySelector("#formReset");
    let btnForgot = document.querySelector("#forgotBtn");

    btnForgot.addEventListener("click",function(){
        formReset.classList.remove("d-none");
        formLogin.classList.add("d-none");
    });

    formLogin.addEventListener("submit",function(e){
        e.preventDefault();
        let strEmail = document.querySelector('#txtLoginEmail').value;
        let strPassword = document.querySelector('#txtLoginPassword').value;
        let loginBtn = document.querySelector("#loginSubmit");
        if(strEmail == "" || strPassword ==""){
            Swal.fire("Error", "Por favor, completa los campos", "error");
            return false;
        }else{

            let url = base_url+'/Login/loginUser'; 
            let formData = new FormData(formLogin);
            loginBtn.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            loginBtn.setAttribute("disabled","");
            request(url,formData,"post").then(function(objData){
                loginBtn.innerHTML=`Iniciar sesión`;
                loginBtn.removeAttribute("disabled");
                if(objData.status){
                    window.location.reload(false);
                    modalView.hide();
                }else{
                    Swal.fire("Error", objData.msg, "error");
                }
            });
        }
    });
    formReset.addEventListener("submit",function(e){
        e.preventDefault();
        let btnReset = document.querySelector("#resetSubmit");
        let strEmail = document.querySelector("#txtEmailReset").value;
        let url = base_url+'/Login/resetPass'; 
        let formData = new FormData(formReset);
        if(strEmail == ""){
            Swal.fire("Error", "Por favor, completa los campos", "error");
            return false;
        }
        if(!fntEmailValidate(strEmail)){
            Swal.fire("Error","El correo es invalido","error");
            return false;
        }
        btnReset.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        btnReset.setAttribute("disabled","");
        request(url,formData,"post").then(function(objData){
            btnReset.innerHTML=`Recuperar contraseña`;
            btnReset.removeAttribute("disabled");
            if(objData.status){
                Swal.fire({
                    title: "Recuperar contraseña",
                    text: objData.msg,
                    icon: "success",
                    confirmButtonText: 'Ok',
                    showCancelButton: true,
                }).then(function(result){
                    if(result.isConfirmed){
                        window.location.reload(false);
                    }
                });
            }else{
                Swal.fire("Error",objData.msg,"error");
            }
        });
    });
}
function addCart(element){

    let idProduct = element.getAttribute("data-id");
    let topic = element.getAttribute("data-topic");
    let type = element.getAttribute("data-type");
    let formData = new FormData();
    let variant = null;
    let intQty = 1;
    if(document.querySelector("#txtQty")){
        intQty = document.querySelector("#txtQty").value;
    }else if(document.querySelector("#txtQQty")){
        intQty = document.querySelector("#txtQQty").value; 
    }
    if(type == 2){
        if(document.querySelector(".btnv.active")){
            variant = document.querySelector(".btnv.active").getAttribute("data-idv");
        }else{
            variant = document.querySelectorAll(".btnv")[0].getAttribute("data-idv");
        }
        
    }
    formData.append("idProduct",idProduct);
    formData.append("topic",topic);
    formData.append("txtQty",intQty);
    formData.append("type",type);
    formData.append("variant",variant);

    element.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
    element.setAttribute("disabled","");
    request(base_url+"/carrito/addCart",formData,"post").then(function(objData){
        element.innerHTML=`<i class="fas fa-shopping-cart"></i>`;
        element.removeAttribute("disabled");
        document.querySelector(".toast-header img").src=objData.data.image;
        document.querySelector(".toast-header img").alt=objData.data.name;
        document.querySelector("#toastProduct").innerHTML=objData.data.reference+" "+objData.data.name;
        document.querySelector(".toast-body").innerHTML=objData.msg;
        if(objData.status){
            document.querySelector("#qtyCart").innerHTML=objData.qty;
            document.querySelector("#qtyCartbar").innerHTML=objData.qty;
        }

        const toast = new bootstrap.Toast(toastLive);
        toast.show();
    });
}
function showMore(elements,max=null,handler){
    let currentElement = 0;
    if(max!=null){
        if(elements.length >= max){
            handler.classList.remove("d-none");
            for (let i = max; i < elements.length; i++) {
                elements[i].classList.add("d-none");
            }
        }
    }
    handler.addEventListener("click",function(){
        currentElement+=max;
        for (let i = currentElement; i < currentElement+max; i++) {
            if(elements[i]){
                elements[i].classList.remove("d-none");
            }
            if(i >= elements.length){
                document.querySelector("#showMore").classList.add("d-none");
            }
        }
        
    })
}
function checkPopup(){
    let status = localStorage.getItem(COMPANY+"popup");
    return status;
}
function delProduct(elements){
    for (let i = 0; i < elements.length; i++) {
        let element = elements[i];
        element.addEventListener("click",function(){
            let formData = new FormData();
            let id = element.parentElement.getAttribute("data-id");
            formData.append("id",id);
            element.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            element.setAttribute("disabled","");
            request(base_url+"/carrito/delCart",formData,"post").then(function(objData){
                element.innerHTML=`<i class="fas fa-times"></i>`;
                element.removeAttribute("disabled");
                if(objData.status){
                    document.querySelector("#qtyCart").innerHTML=objData.qty;
                    document.querySelector("#totalCart").innerHTML = objData.subtotal;
                    document.querySelector("#qtyCartbar").innerHTML=objData.qty;
                    element.parentElement.remove();
                    if(objData.qty == 0){
                        document.querySelector("#btnsCartBar").classList.add("d-none");
                    }
                }
            });
        });
    }
}
function addWishList(element){
    
    let idProduct = element.getAttribute("data-id");
    let formData = new FormData();
    formData.append("idProduct",idProduct);
    element.classList.toggle("active");
    if(element.classList.contains("active")){
        element.innerHTML = `<span class="spinner-border text-primary spinner-border-sm" role="status" aria-hidden="true"></span>`;
        element.setAttribute("disabled","disabled");
        request(base_url+"/tienda/addWishList",formData,"post").then(function(objData){
            element.removeAttribute("disabled");
            if(objData.status){
                element.innerHTML = `<i class="fas fa-heart text-danger " title="Agregar a favoritos"></i>`;
            }else{
                openLoginModal();
                element.innerHTML = `<i class="far fa-heart" title="Agregar a favoritos"></i>`;
            }
        });
    }else{
        element.innerHTML = `<span class="spinner-border text-primary spinner-border-sm" role="status" aria-hidden="true"></span>`;
        element.setAttribute("disabled","disabled");
        request(base_url+"/tienda/delWishList",formData,"post").then(function(objData){
            element.removeAttribute("disabled");
            if(objData.status){
                element.innerHTML = `<i class="far fa-heart" title="Agregar a favoritos"></i>`;
            }else{
                element.innerHTML = `<i class="far fa-heart " title="Agregar a favoritos"></i>`;
                openLoginModal();
            }
        });
        
    }
    
}

