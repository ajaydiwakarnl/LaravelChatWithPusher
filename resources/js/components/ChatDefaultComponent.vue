<template>
    <div class="defaultChatUi text-center" >
        <div>
            <img :src="image"   alt="" height="50" width="50"/>
        </div>
        <div class="text-center">
            Lets  start your conversation with your friends
        </div>
    </div>
</template>

<script>
import image from "./assets/chat.png"
export default {
    name: "ChatDefaultComponent",
    data: function () {
        return {
            image: image
        }
    }
}
</script>

<style scoped>

</style>
