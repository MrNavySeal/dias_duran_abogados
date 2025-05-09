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
    const btnSearch = document.querySelector("#btnSearch");
    const closeSearch = document.querySelector("#closeSearch");
    const search = document.querySelector(".search");
    const cartbar = document.querySelector(".cartbar");
    const closeCart = document.querySelector("#closeCart");
    const btnCart = document.querySelector("#btnCart");
    const cartMask = document.querySelector(".cartbar--mask");
    const navBar = document.querySelector(".navmobile");
    const navMask = document.querySelector(".navmobile--mask");
    const btnNav = document.querySelector("#btnNav");
    const closeNav = document.querySelector("#closeNav");
    const toastLive = document.getElementById('liveToast');
    /********************************Search******************************** */
    btnSearch.addEventListener("click",function(){
        search.classList.add("active");
        document.querySelector("body").style.overflow="hidden";
    });
    closeSearch.addEventListener("click",function(){
        search.classList.remove("active");
        document.querySelector("body").style.overflow="auto";
    });
    search.addEventListener("click",function(e){
        if(e.target.classList.contains("active")){
            search.classList.remove("active");
        }
        document.querySelector("body").style.overflow="auto";
    })

    /********************************Aside cart******************************** */
    btnCart.addEventListener("click",function(){
        cartbar.classList.add("active");
        document.querySelector("body").style.overflow="hidden";
    });
    closeCart.addEventListener("click",function(){
        cartbar.classList.remove("active");
        document.querySelector("body").style.overflow="auto";
    });
    cartMask.addEventListener("click",function(){
        cartbar.classList.remove("active");
        document.querySelector("body").style.overflow="auto";
    })

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

    btnCart.addEventListener("click",function(){
        request(base_url+"/carrito/currentCart","","get").then(function(objData){
            //document.querySelector("#qtyCart").innerHTML=objData.qty;
            if(objData.items!=""){
                document.querySelector("#btnsCartBar").classList.remove("d-none");
                document.querySelector("#qtyCartbar").innerHTML=objData.qty;
                document.querySelector(".cartlist--items").innerHTML = objData.items;
                document.querySelector("#totalCart").innerHTML = objData.total;
                delProduct(document.querySelectorAll(".delItem"));
                let btnCheckoutCart = document.querySelector(".btnCheckoutCart");
                btnCheckoutCart.addEventListener("click",function(){
                    if(objData.status){
                        window.location.href=base_url+"/pago";
                    }else{
                        openLoginModal();
                    }
                });
            }else{
                document.querySelector("#btnsCartBar").classList.add("d-none");
            }
        })
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
    let modalItem = document.querySelector("#modalLogin");
    let modal= `
    <div class="modal fade" id="modalElementLogin">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn-close p-2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="login">
                    <div class="container">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="login">
                                <form id="formLogin" name="formLogin">
                                    <h2 class="mb-4">Iniciar sesión</h2>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-envelope"></i></div>
                                        <input type="email" class="form-control" id="txtLoginEmail" name="txtEmail" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-lock"></i></div>
                                        <input type="password" class="form-control" id="txtLoginPassword" name="txtPassword" placeholder="Contraseña" required></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end mb-3 t-p">
                                        <div class="c-p" id="forgotBtn">¿Olvidaste tu contraseña?</div>
                                    </div>
                                    <button type="submit" id="loginSubmit" class="btn btn-bg-2 w-100 mb-4" >Iniciar sesión</button>
                                    <div class="d-flex justify-content-center mb-3 t-p" >
                                        <div class="c-p" id="signBtn">¿Necesitas una cuenta?</div>
                                    </div>
                                </form>
                                <form id="formSign" class="d-none">
                                    <h2 class="mb-4">Registrarse</h2>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-user"></i></div>
                                        <input type="text" class="form-control" id="txtSignName" name="txtSignName" placeholder="Nombre" required>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-envelope"></i></div>
                                        <input type="email" class="form-control" id="txtSignEmail" name="txtSignEmail" placeholder="Email" required>
                                    </div>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-lock"></i></div>
                                        <input type="password" class="form-control" id="txtSignPassword" name="txtSignPassword" placeholder="Contraseña" required></textarea>
                                    </div>
                                    <p>Al registrarse en nuestro sitio web, aceptas <a href="${base_url}/politicas/terminos" target="_blank">nuestras políticas de uso</a> y 
                                    <a href="${base_url}/politicas/privacidad" target="_blank">de privacidad</a>.</p>
                                    <div class="d-flex justify-content-end mb-3 t-p" >
                                        <div class="c-p loginBtn">¿Ya tienes una cuenta? inicia sesión</div>
                                    </div>
                                    <button type="submit" id="signSubmit" class="btn btn-bg-2 w-100 mb-4" >Registrarse</button>
                                </form>
                                <form id="formConfirmSign" class="d-none">
                                    <h2 class="mb-4">Verificar correo</h2>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-lock-open"></i></div>
                                        <input type="text" class="form-control" id="txtCode" name="txtCode" placeholder="Código" required>
                                    </div>
                                    <p>Te hemos enviado un correo electrónico con tu codigo de verificación.</p>
                                    <button type="submit" id="confimSignSubmit" class="btn btn-bg-2 w-100 mb-4" >Verificar</button>
                                </form>
                                <form id="formReset" class="d-none">
                                    <h2 class="mb-4">Recuperar contraseña</h2>
                                    <div class="mb-3 d-flex">
                                        <div class="d-flex justify-content-center align-items p-3 bg-color-2 text-white"><i class="fas fa-envelope"></i></div>
                                        <input type="email" class="form-control" id="txtEmailReset" name="txtEmailReset" placeholder="Email" required>
                                    </div>
                                    <p>Te enviaremos un correo electrónico con las instrucciones a seguir.</p>
                                    <div class="d-flex justify-content-end mb-3 t-p" >
                                        <div class="c-p loginBtn">Iniciar sesión</div>
                                    </div>
                                    <button type="submit" id="resetSubmit" class="btn btn-bg-2 w-100 mb-4" >Recuperar contraseña</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    `;
    modalItem.innerHTML = modal;
    let modalView = new bootstrap.Modal(document.querySelector("#modalElementLogin"));
    modalView.show();
    modalView.hide();

    let formLogin = document.querySelector("#formLogin");
    let formReset = document.querySelector("#formReset");
    let formSign = document.querySelector("#formSign");
    let formConfirmSign = document.querySelector("#formConfirmSign");
    let btnForgot = document.querySelector("#forgotBtn");
    let btnLogin = document.querySelectorAll(".loginBtn");
    let btnSign = document.querySelector("#signBtn");

    btnForgot.addEventListener("click",function(){
        formReset.classList.remove("d-none");
        formLogin.classList.add("d-none");
    });
    btnSign.addEventListener("click",function(){
        formSign.classList.remove("d-none");
        formLogin.classList.add("d-none");
    });
    for (let i = 0; i < btnLogin.length; i++) {
        let btn = btnLogin[i];
        btn.addEventListener("click",function(){
            if(i == 0){
                formSign.classList.add("d-none");
                formLogin.classList.remove("d-none");
            }else{
                formReset.classList.add("d-none");
                formLogin.classList.remove("d-none");
            }
        })
    }

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
                    modalItem.innerHTML = "";
                }else{
                    Swal.fire("Error", objData.msg, "error");
                }
            });
        }
    });
    formSign.addEventListener("submit",function(e){
        e.preventDefault();

        let strName = document.querySelector('#txtSignName').value;
        let strEmail = document.querySelector('#txtSignEmail').value;
        let strPassword = document.querySelector('#txtSignPassword').value;
        let signBtn = document.querySelector("#signSubmit");

        if(strEmail == "" || strPassword =="" || strName ==""){
            Swal.fire("Error", "Por favor, completa los campos", "error");
            return false;
        }
        if(strPassword.length < 8){
            Swal.fire("Error","La contraseña debe tener al menos 8 carácteres","error");
            return false;
        }
        let url = base_url+'/tienda/validCustomer'; 
        let formData = new FormData(formSign);
        signBtn.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
        signBtn.setAttribute("disabled","");
        request(url,formData,"post").then(function(objData){
            signBtn.innerHTML=`Registrarse`;
            signBtn.removeAttribute("disabled");
            if(objData.status){
                formSign.classList.add("d-none");
                formConfirmSign.classList.remove("d-none");
            }else{
                Swal.fire("Error", objData.msg, "error");
            }
        });
    });
    formConfirmSign.addEventListener("submit",function(e){
        e.preventDefault();
        let strCode = document.querySelector('#txtCode').value;
        let strName = document.querySelector('#txtSignName').value;
        let strEmail = document.querySelector('#txtSignEmail').value;
        let strPassword = document.querySelector('#txtSignPassword').value;
        let signBtn = document.querySelector("#confimSignSubmit");
        if(strCode==""){
            Swal.fire("Error", "Por favor, completa los campos", "error");
            return false;
        }else{

            let url = base_url+'/tienda/setCustomer'; 
            let formData = new FormData(formConfirmSign);
            formData.append("txtSignName",strName);
            formData.append("txtSignEmail",strEmail);
            formData.append("txtSignPassword",strPassword);
            signBtn.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
            signBtn.setAttribute("disabled","");
            request(url,formData,"post").then(function(objData){
                signBtn.innerHTML=`Verificar`;
                signBtn.removeAttribute("disabled");
                if(objData.status){
                    window.location.reload(false);
                    modalView.hide();
                    modalItem.innerHTML = "";
                }else{
                    Swal.fire("Error", objData.msg, "error");
                    formSign.classList.add("d-none");
                    formLogin.classList.remove("d-none");
                    formConfirmSign.classList.add("d-none");
                    formConfirmSign.reset();
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

