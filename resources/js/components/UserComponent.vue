<template>
    <div class="card">
        <div class="card-body">
            <ul class="chat">
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
        </div>
    </div>
</template>

<script>
export default {
    name: "UserComponent",
    props: ['users'],
    methods: {
        activeChat: function (user) {
            window.eventBus.$emit('chatuser', user);
            return user
        }
    }
}
</script>

