// import './bootstrap';
// import { createApp } from 'vue';
// import router from './router'
// const app = createApp({});
// import ExampleComponent from './components/ExampleComponent.vue';
// import IndexComponent from './components/invoices/Index.vue';
// import CreateInvoice from './components/invoices/Create.vue';
// import ShowInvoice from './components/invoices/Show.vue';
// app.component('example-component', ExampleComponent);
// app.component('index-component', IndexComponent);
// app.component('create-component', CreateInvoice);
// app.component('show-component', ShowInvoice);
// app.use(router);
// app.mount('#app');


// fixed routes!
import './bootstrap';
import { createApp } from 'vue'
import app from './components/App.vue';
import router from './router/index.js';
createApp(app).use(router).mount('#app')