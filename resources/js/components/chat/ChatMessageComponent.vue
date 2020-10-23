<template>
    <div class="chat-list">
        <div class="message-wrapper" v-for="chat in chats" v-bind:key="chat.id">
            <div class="user">
                {{ chat.user.name }} <span class="time">{{ chat.created_at }}</span>
            </div>
            <div class="message">
                {{ chat.subject }}
            </div>
        </div>
    </div>
</template>

<script>
    import BusEvent from '../../bus'

    export default {
        data() {
            return {
                chats: []
            }
        },

        mounted() {
            this.getChatList();
            BusEvent.$on('chat.new', (newChat) => {
                this.chats.push(newChat)
                this.scrollToBottom()
            })
        },

        methods: {
            getChatList() {
                axios.get('/api/chat').then(res => {
                    this.chats = res.data.reverse()
                })
                this.scrollToBottom();
            },

            scrollToBottom() {
                setTimeout(() => {
                    let e = document.getElementsByClassName('chat-list')[0];
                    e.scrollTop = e.scrollHeight

                }, 100)
            }
        }
    }
</script>

<style lang="scss">
.message-wrapper {
    margin-top: 5px;

    .time {
        font-weight: bold;
    }

    .message {
        font-size: 1.2rem;
    }
}

.chat-list {
    max-height: 300px;
    overflow: scroll;
}
</style>
