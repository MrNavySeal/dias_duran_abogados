const App = {
    data() {
      return {
        intId:"",
        arrAreas:[],
        objData:{id:""},
        arrNoticias:[],
        objArea:{url:"",name:""},
      };
    },mounted(){
        const vueObject = this;
        Vue.nextTick(async function(){
            await this.getInitialData();
            vueObject.setCarousel();
        }.bind(vueObject));
    },methods:{
        getInitialData: async function(){
            const formData = new FormData();
            formData.append("id",this.$refs.intId ? this.$refs.intId.value :"" );
            formData.append("tipo",this.$refs.strTipo ? this.$refs.strTipo.value :"" );
            const response = await fetch(base_url+"/Servicios/getInitialData",{method:"POST",body:formData});
            const objData = await response.json();
            this.arrAreas = objData.areas;
            this.objArea = objData.areas[0];
            this.arrNoticias = objData.noticias;
            if(objData.data){
                this.objData = objData.data;
                this.$refs.strDescripcion.innerHTML = this.objData.description;
            }
        },
        setCarousel:function(){
            $(".carousel-blog").owlCarousel({
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
              nav:false,
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

