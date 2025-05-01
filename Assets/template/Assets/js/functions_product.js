let productImages = document.querySelectorAll(".product-image-item");
let btnPrevP = document.querySelector(".slider-btn-left");
let btnNextP = document.querySelector(".slider-btn-right");
let innerP = document.querySelector(".product-image-inner");
let btnReview = document.querySelector("#btnReview");
let modal = new bootstrap.Modal(document.querySelector("#modalReview"));

/***************************Product Page Events****************************** */

window.addEventListener("load",function(){
    rateProduct();
    if(document.querySelector("#showMore")){
        showMore(document.querySelectorAll(".comment-block"),4,document.querySelector("#showMore"));
    }
    $(".product-slider-cat").owlCarousel({
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:true,
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:2
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
})

//Select image
for (let i = 0; i < productImages.length; i++) {
    let productImage = productImages[i];
    productImage.addEventListener("click",function(e){
        for (let j = 0; j < productImages.length; j++) {
            productImages[j].classList.remove("active");
        }
        productImage.classList.add("active");
        let image = productImage.children[0].src;
        document.querySelector(".product-image img").src = image;
    })
}
if(document.querySelector("#sortReviews")){
    let sortReview = document.querySelector("#sortReviews");
    sortReview.addEventListener("change",function(){
        let idProduct = document.querySelector("#idProduct").value;
        let intSort = sortReview.value;
        let formData = new FormData();
    
        formData.append("id",idProduct);
        formData.append("sort",intSort);
        request(base_url+"/tienda/sortReviews",formData,"post").then(function(objData){
            document.querySelector(".comment-list").innerHTML= objData;
        });
    });
}
btnPrevP.addEventListener("click",function(){
    innerP.scrollBy(-100,0);
})
btnNextP.addEventListener("click",function(){
    innerP.scrollBy(100,0);
});
btnReview.addEventListener("click",function(){
    modal.show();
})

let btnPPlus = document.querySelector("#btnPIncrement");
let btnPMinus = document.querySelector("#btnPDecrement");
let intPQty = document.querySelector("#txtQty");

if(document.querySelector("#btnPIncrement")){
    btnPPlus.addEventListener("click",function(){
        let maxStock = parseInt(intPQty.getAttribute("max"));
        if(intPQty.value >=maxStock){
            intPQty.value = maxStock;
        }else{
            intPQty.value++; 
        }
    });
    btnPMinus.addEventListener("click",function(){
        if(intPQty.value <=1){
            intPQty.value = 1;
        }else{
            --intPQty.value; 
        }
    });
    intPQty.addEventListener("input",function(){
        let maxStock = parseInt(intPQty.getAttribute("max"));
        if(intPQty.value >= maxStock){
            intPQty.value= maxStock;
        }else if(intPQty.value <= 1){
            intPQty.value= 1;
        }
    });
}

formReview.addEventListener("submit",function(e){
    e.preventDefault();
    let formData = new FormData(formReview);
    let intRate = document.querySelector("#intRate").value;
    let strReview = document.querySelector("#txtReview").value;
    let addReview = document.querySelector("#addReview");
    if(intRate ==0 || strReview ==""){
        Swal.fire("Error","Por favor, califique el producto y escriba su opinión","error");
        return false;
    }
    addReview.setAttribute("disabled","disabled");
    addReview.innerHTML = `<span class="spinner-border text-primary spinner-border-sm" role="status" aria-hidden="true"></span>`;
    request(base_url+"/tienda/setReview",formData,"post").then(function(objData){
        addReview.removeAttribute("disabled");
        addReview.innerHTML="Publicar";
        if(objData.status){
            document.querySelector("#intRate").value="";
            document.querySelector("#txtReview").value="";
            Swal.fire("¡Gracias por compartir su opinión!",objData.msg,"success");
            modal.hide();
        }else if(objData.login == false){
            openLoginModal();
            modal.hide();
        }else{
            Swal.fire("Error",objData.msg,"error");
            modal.hide();
        }
    });
});
function rateProduct(){
    let stars = document.querySelectorAll(".starBtn");
    for (let i = 0; i < stars.length; i++) {
        let star = stars[i];
        star.addEventListener("click",function(){
            document.querySelector("#intRate").value = i+1;
            for (let j = 0; j < stars.length; j++) {
                if(j>i){
                    stars[j].innerHTML =`<i class="far fa-star"></i>`;
                }else{
                    stars[j].innerHTML =`<i class="fas fa-star"></i>`;
                }
            }
        })
    }
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
function selVariant(element){
    let contentVariants = element.parentElement;
    let variants = contentVariants.children;
    for (let i = 0; i < variants.length; i++) {
        variants[i].classList.remove("active");
    }
    element.classList.add("active");
    let selectedVariants = document.querySelectorAll(".btnv.active");
    let arrSelected = [];
    selectedVariants.forEach(element => {
        arrSelected.push(element.getAttribute("data-name"));
    });
    let variant = arrSelected.join("-");
    
    let formData = new FormData();
    formData.append("id",element.getAttribute("data-idp"));
    formData.append("variant",variant);
    request(base_url+"/tienda/getProductVariant",formData,"post").then(function(objData){
        if(objData.status){
            let priceElement = document.querySelector("#productPrice");
            if(objData.percent != ""){
                if(document.querySelector("#productDiscount")){
                    document.querySelector("#productDiscount").classList.remove("d-none");
                    document.querySelector("#productDiscount").innerHTML = objData.percent;
                }
                priceElement.innerHTML = `<span class="current sale me-2">${objData.pricediscount}</span>
                <span class="compare">${objData.price}</span>`
            }else{
                if(document.querySelector("#productDiscount"))document.querySelector("#productDiscount").classList.add("d-none");
                priceElement.innerHTML = objData.price;
            }
            if(objData.is_stock && objData.stock > 0){
                document.querySelector("#showBtns").classList.remove("d-none");
                document.querySelector("#txtQty").setAttribute("max",objData.stock);
            }else if(objData.is_stock && objData.stock <= 0){
                document.querySelector("#showBtns").classList.add("d-none");
                if(document.querySelector("#productDiscount"))document.querySelector("#productDiscount").classList.add("d-none");
                priceElement.innerHTML = '<span class="current sale me-2">Agotado</span>';
            }else{
                document.querySelector("#showBtns").classList.remove("d-none");
            }
            if(document.querySelector("#txtQty"))document.querySelector("#txtQty").value=1;
        }
    })
}
function addFav(element){
    
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
                element.innerHTML = `<i class="fas fa-heart text-danger " title="Agregar a favoritos"></i> Mi favorito`;
            }else{
                openLoginModal();
                element.innerHTML = `<i class="far fa-heart" title="Agregar a favoritos"></i> Agregar a favoritos `;
            }
        });
    }else{
        element.innerHTML = `<span class="spinner-border text-primary spinner-border-sm" role="status" aria-hidden="true"></span>`;
        element.setAttribute("disabled","disabled");
        request(base_url+"/tienda/delWishList",formData,"post").then(function(objData){
            element.removeAttribute("disabled");
            if(objData.status){
                element.innerHTML = `<i class="far fa-heart" title="Agregar a favoritos"></i> Agregar a favoritos`;
            }else{
                element.innerHTML = `<i class="far fa-heart" title="Agregar a favoritos"></i> Agregar a favoritos`;
                openLoginModal();
            }
        });
        
    }
    
}
function addProductCart(element){

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
    if(type == 1){
        let selectedVariants = document.querySelectorAll(".btnv.active");
        let arrSelected = [];
        selectedVariants.forEach(element => {
            arrSelected.push(element.getAttribute("data-name"));
        });
        variant = arrSelected.join("-");
        
    }
    formData.append("idProduct",idProduct);
    formData.append("topic",topic);
    formData.append("txtQty",intQty);
    formData.append("type",type);
    formData.append("variant",variant);

    element.innerHTML=`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`;
    element.setAttribute("disabled","");
    request(base_url+"/carrito/addCart",formData,"post").then(function(objData){
        element.innerHTML=`<i class="fas fa-shopping-cart"></i> Agregar`;
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
