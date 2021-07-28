<template>
    <div>
        {{ user }}
    </div>
</template>

<script>

export default {
    name: "ChatPanelheadingComponent",
    data() {
        return {
            userName: '',
        }
    },
    computed: {
        user: function() {
            return this.userName && this.userName.length > 0 ? `Let's chat with ${this.userName}` : `Let's chat`
        },
    },
    mounted() {
        window.eventBus.$on('chatuser', (payload) => {
            this.userName = payload.name;
        })
    }
}
</script>

<style scoped>

</style>
