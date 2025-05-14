const App = {
    data() {
      return {
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

    },methods:{
      
    }

  };
const app = Vue.createApp(App);
app.use(ElementPlus);
app.mount("#app");
