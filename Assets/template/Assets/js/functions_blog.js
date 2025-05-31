const App = {
    data() {
      return {
        arrCategorias:[],
        arrRecientes:[],
        arrAreas:[],
        arrNoticias:[],
        strCategoria:"",
        objData:{id:""},

        //Paginacion y filtros
        intPagina:1,
        intInicioPagina:1,
        intTotalPaginas:1,
        intTotalBotones:1,
        intPorPagina:6,
        intTotalResultados:0,
        arrData:[],
        arrBotones:[],
        strBuscar:"",
      };
    },mounted(){
      const vueObject = this;
      Vue.nextTick(async function(){
        if(vueObject.$refs.intIdNoticia){
          await vueObject.getNoticia(vueObject.$refs.intIdNoticia.value);
        }
        await vueObject.getBuscar(1,"noticias");
        await vueObject.getInitialData();
        vueObject.setCarousel();
      }.bind(vueObject));
      
    },methods:{
      getInitialData: async function(){
          const formData = new FormData();
          formData.append("id",this.$refs.intId ? this.$refs.intId.value :"" );
          const response = await fetch(base_url+"/Blog/getInitialData",{method:"POST",body:formData});
          const objData = await response.json();
          this.arrCategorias = objData.categorias;
          this.arrAreas = objData.areas;
          this.arrRecientes = objData.recientes;
      },
      getNoticia:async function(id){
        const formData = new FormData();
        formData.append("id",id);
        const response = await fetch(base_url+"/Blog/getNoticia",{method:"POST",body:formData});
        const objData = await response.json();
        this.objData = objData;
        this.$refs.strDescripcion.innerHTML = this.objData.description;
        this.arrNoticias = objData.related;
      },
      getBuscar:async function (intPagina=1,strTipo = "",modo=""){
          if(modo == "buscar"){ window.location.href=base_url+"/blog/buscar/"+this.strBuscar;}
          this.strBuscar = this.$refs.strBuscar ? this.$refs.strBuscar.value : this.strBuscar;
          this.intPagina = intPagina;
          const formData = new FormData();
          formData.append("paginas",this.intPorPagina);
          formData.append("pagina",this.intPagina);
          formData.append("buscar",this.strBuscar);
          formData.append("tipo_busqueda",strTipo);
          formData.append("categoria",this.$refs.intCategoria ? this.$refs.intCategoria.value :"");
          const response = await fetch(base_url+"/Blog/getBuscar",{method:"POST",body:formData});
          const objData = await response.json();
          this.arrData = objData.data;
          this.intInicioPagina  = objData.start_page;
          this.intTotalBotones = objData.limit_page;
          this.intTotalPaginas = objData.total_pages;
          this.intTotalResultados = objData.total_records;
          this.getBotones();
      },
      getBotones:function(){
          this.arrBotones = [];
          for (let i = this.intInicioPagina; i < this.intTotalBotones; i++) {
              this.arrBotones.push(i);
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
        
      }
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");
