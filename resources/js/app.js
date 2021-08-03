/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import Echo from "laravel-echo"

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))
window.eventBus = new Vue();

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('chat-message-component',require('./components/ChatMessagesComponent.vue').default);
Vue.component('chat-form-component',require('./components/ChatFormComponent.vue').default);
Vue.component('user-component',require('./components/UserComponent.vue').default);
Vue.component('chat-default-component',require('./components/ChatDefaultComponent.vue').default);
Vue.component('chat-panel-heading-component',require('./components/ChatPanelheadingComponent.vue').default);
Vue.component('search-component',require('./components/SearchComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',

    data: {
        messages: [],
        users:[],
        receiver_id:'',
        keyword:'',
    },

    created() {
        this.fetchUsersList();

        window.Echo.private(`chat`).listen('MessageSent', (e) => {

            console.log(e.user);
            if(e.message.channel === `${window.loggedInUserId}:${this.receiver_id}` || e.message.channel === `${this.receiver_id}:${window.loggedInUserId}`) {
                this.messages.push({
                    message: e.message.message,
                    user: e.user
                });
            }
        });
    },

    methods: {

        fetchMessages() {
            console.log("call");
            axios.post(`/fetchmessages/${this.receiver_id}`).then(response => {
                this.messages = response.data;
                console.log(response.data);
            });
        },

        fetchUsers(){
            axios.post(`/searchUser/${this.keyword}`).then(response => {
                this.users = response.data;
                console.log(response.data);
            });
        },

        fetchUsersList(){
            axios.get(`/users`).then(response => {
                this.users = response.data;
                // $.each(response.data, function(key, value) {
                //    if(value.id !== null) {
                //        console.log(value);
                //        this.users = value;
                //    }
                // });


            });
        },


        addMessage(message) {
            this.messages.push(message);
            // console.log("MESSAGE", message);
            // message.channel = `${message.receiver_id}:${message.sender_id}`;
            // if(message.loggedUser === message.message.user_id) {
            //
            // }
            axios.post('/messages', message).then(response => {
                console.log(response.data);
            });
        },

    },
    mounted() {
        window.eventBus.$on('chatuser', (payload) => {
            this.receiver_id = payload.id;
            this.fetchMessages();
        })
        window.eventBus.$on('keyword', (payload) => {
            this.keyword = payload;
            this.fetchUsers();
        })
    }
});
