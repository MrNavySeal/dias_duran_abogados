const App = {
    data() {
      return {
        arrTestimonios:[],
        arrEquipo:[],
        arrAreas:[],
        objNosotros:[],
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
            this.arrTestimonios = objData.testimonios;
            this.arrEquipo = objData.equipo;
            this.objNosotros = objData.nosotros;
            this.arrAreas = objData.areas;
            this.$refs.strDescripcion.innerHTML = this.objNosotros.description;
        },
        setCarousel:function(){
            $(".carousel-team").owlCarousel({
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            loop:true,
            margin:10,
            nav:false,
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
            nav:false,
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
        }
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");
