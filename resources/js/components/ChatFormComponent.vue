<template>
    <div class="input-group">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage"
            style="margin-left: 10px;margin-top: 4px;">
                Send
            </button>
        </span>
    </div>
</template>

<script>
export default {
    name: "ChatFormComponent",
    props: ['user'],
    data() {
        return {
            newMessage: '',
            recevier_id:''
        }
    },

    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                message: this.newMessage,
                sender_id: window.loggedInUserId,
                recevier_id: this.recevier_id,
                channel: `${this.user.id}:${this.recevier_id}`,
                type: 1,
            });

            this.newMessage = ''

        }
    },
    mounted() {
        window.eventBus.$on('chatuser', (payload) => {
            this.recevier_id = payload.id;
        });
        window.loggedInUserId = this.user.id;
    }
}
</script>

