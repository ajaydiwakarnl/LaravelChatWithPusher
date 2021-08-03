<template>
    <div class="card">
        <div class="card-body">
            <input type="text" placeholder="Search Contacts" class="form-control" v-model="keyword">
            <ul class="chat" v-if="users.length > 0" style="margin-top: 30px;">
                <li class="left clearfix" v-for="user in users">
                    <div class="chat-body clearfix" @click="activeChat(user)">
                        <div class="header">
                            <strong class="primary-font">
                             {{ user.name }}
                            </strong>
                        </div>
                    </div>
                </li>
            </ul>
            <div  v-if="users.length === 0" class="text-center" style="margin-top: 30px;">
                No active user found
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "UserComponent",
    props: ['users'],
    data() {
        return {
            keyword: null,
        };
    },
    watch: {
        keyword(after, before) {
            this.getContact();
        }
    },
    methods: {
        activeChat: function (user) {
            window.eventBus.$emit('chatuser', user);
            return user
        },
        getContact(){
            window.eventBus.$emit('keyword', this.keyword);
            if(this.keyword !== null ){
                console.log(this.keyword);
                return this.keyword
            }

        }
    },
    mounted() {
        console.log("USERS" + this.users );
    }
}
</script>

