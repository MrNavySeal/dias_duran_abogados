const App = {
    data() {
      return {
        strFecha:"",
        arrAreas:[],
        arrNoticias:[],
      };
    },mounted(){
        const vueObject = this;
        Vue.nextTick(async function(){
            await this.getInitialData();
            vueObject.setCarousel();
        }.bind(vueObject));
    },methods:{
        getInitialData: async function(){
            const response = await fetch(base_url+"/Home/getInitialData");
            const objData = await response.json();
            this.arrAreas = objData.areas;
            this.arrNoticias = objData.noticias;
        },
        setCarousel:function(){
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
            $(".carousel-service").owlCarousel({
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
        }
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");

