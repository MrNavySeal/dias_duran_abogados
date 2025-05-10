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

$(".carousel-blog").owlCarousel({
  autoplay:true,
  autoplayTimeout:5000,
  autoplayHoverPause:true,
  loop:true,
  margin:10,
  nav:true,
  responsive:{
      0:{
          items:1
      },
      600:{
          items:2
      },
      1000:{
          items:3
      }
  }
});