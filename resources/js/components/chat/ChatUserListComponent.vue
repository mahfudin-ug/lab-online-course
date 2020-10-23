<template>
    <div>
        <h3>Online user list: {{ users.length }}</h3>
        <ul>
            <li v-for="user in users">{{ user.name }}</li>
        </ul>
    </div>

</template>

<script>
    import BusEvent from '../../bus'

    export default {
        data() {
            return {
                users: [],
            }
        },

        mounted() {
            BusEvent.$on('chat.online', (users) => {
                this.users = users

            }).$on('chat.joining', (user) => {
                this.users.push(user)

            }).$on('chat.leaving', (user) => {
                this.users = this.users.filter((u) => u.id !== user.id)
            })
        }
    }
</script>
