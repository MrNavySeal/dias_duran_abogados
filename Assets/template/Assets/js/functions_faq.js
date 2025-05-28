const App = {
    data() {
      return {
        arrAreas:[],
        arrFaq:[],
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
              const response = await fetch(base_url+"/Faq/getInitialData");
              const objData = await response.json();
              this.arrAreas = objData.areas;
              this.arrFaq = objData.faq;
        },
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");
