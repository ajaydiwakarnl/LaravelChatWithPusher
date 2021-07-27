<template>
    <div class="card">
        <div class="card-body">
            <ul class="chat">
                <li class="left clearfix" v-for="user in users">
                    <div class="chat-body clearfix">
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
    props: ['users']
}
</script>

<style scoped>

</style>
