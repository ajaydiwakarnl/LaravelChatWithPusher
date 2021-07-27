<template>
   <div>
        <ul class="chat">
            <div v-if="messages.length === 0">
                <div class="chat-body clearfix text-center">
                    No previous chat found
                </div>
            </div>
            <li class="left clearfix" v-for="message in messages">
                <div class="chat-body clearfix">
                    <div class="header">
                        <strong class="primary-font">
                            {{ message.user.name }}
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
export default {
    name: "ChatMessagesComponent",
    props: ['messages']
}
</script>

