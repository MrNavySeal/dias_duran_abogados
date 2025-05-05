const App = {
    data() {
      return {
        arrBanners: [],
      };
    },mounted(){
      this.getInitialData();
    },methods:{
      getInitialData: async function(){
        const response = await fetch(base_url+"/Home/getInitialData");
        const objData = await response.json();
        console.log(objData);
        this.arrBanners = objData.banners;
      }
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");