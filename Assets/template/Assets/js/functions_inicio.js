const App = {
    data() {
      return {
        arrBanners: [],
        arrTestimonios:[],
        arrAreas:[],
        arrNoticias:[],
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        }
      };
    },mounted(){
      this.getInitialData();
    },methods:{
      getInitialData: async function(){
        const response = await fetch(base_url+"/Home/getInitialData");
        const objData = await response.json();
        console.log(objData);
        this.arrBanners = objData.banners;
        this.arrTestimonios = objData.testimonios;
        this.arrAreas = objData.areas;
        this.arrNoticias = objData.noticias;
      }
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");

$(".carousel-team").owlCarousel({
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
          items:4
      }
  }
});
$(".carousel-testimonial").owlCarousel({
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
          items:1
      },
      1000:{
          items:1
      }
  }
});
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