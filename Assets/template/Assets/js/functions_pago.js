window.addEventListener("load",function(){
    if(document.querySelector("#paypal-button-container")){
      const intIdOrder = document.querySelector("#idOrder").value;
      const paypalBtns=  window.paypal.Buttons({
              createOrder: async (data, actions) => {
                  const response = await fetch(base_url+"/pago/getOrden/"+intIdOrder);
                  const objData = await response.json();
                  return actions.order.create({
                      purchase_units: [{
                          amount: {
                              value: objData.total
                          }
                      }]
                  });
              },
              onApprove: (data, actions) => {
                  return actions.order.capture().then(async function(arrOrden) {
                      const formData = new FormData();
                      formData.append("data",JSON.stringify(arrOrden));
                      formData.append("id",intIdOrder);
                      const response = await fetch(base_url+"/pago/setOrden",{method:"POST",body:formData});
                      const objData = await response.json();
                      if(objData.status){
                          window.location.href=base_url+"/pago/confirmado/"+intIdOrder;
                      }else{
                          window.location.href=base_url+"/pago/error";
                      }
                  });
              }
          },
      );
      paypalBtns.render("#paypal-button-container");
    }
});
const App = {
    data() {
      return {
        
      };
    },mounted(){

    },methods:{
      
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");



// Example function to show a result to the user. Your site's UI library can be used instead.
function resultMessage(message) {
    const container = document.querySelector("#result-message");
    container.innerHTML = message;
}