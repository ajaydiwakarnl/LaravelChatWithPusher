<template>
   <div>
        <ul class="chat">
            <div v-if="messages.length === 0">
                <div class="defaultChatUi text-center" >
                    <div>
                        <img :src="image"   alt="" height="50" width="50"/>
                    </div>
                    <div class="text-center">
                        Lets  start your conversation with your friends
                    </div>
                </div>
            </div>
            <li class="left clearfix" v-for="message in messages">
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.sender_id }}
                        </strong>
                    </div>
                    <p>
                        {{ message.message }}
                    </p>
                </div>
            </li>
        </ul>
   </div>
</template>

<script>
import image from "./assets/chat.png";

export default {
    name: "ChatMessagesComponent",
    props: ['messages'],
    data: function () {
        return {
            image: image
        }
    }
}
</script>

