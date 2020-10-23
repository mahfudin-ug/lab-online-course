<template>
    <div>
        <form>
            <div class="form-action">
                <textarea
                    placeholder="Write your message..."
                    class="form-control"
                    v-model="body"
                    @keydown="handleInput"
                    >
                </textarea>
            </div>
        </form>
    </div>
</template>

<script>
    import moment from 'moment'
    import BusEvent from '../../bus'

    export default {
        data() {
            return {
                body: '',
            }
        },

        methods: {
            handleInput(e) {
                if (e.keyCode === 13 && !e.shiftKey) {
                    e.preventDefault()
                    this.submitMessage()
                }
            },

            submitMessage() {
                let subject = this.body.trim();

                if (subject == '') {
                    return
                }

                let newChat = {
                    subject,
                    created_at: moment().format('YYYY-MM-DD HH:mm:ss'),
                    user: {
                        'name': Laravel.user.name
                    }
                }

                axios.post('/api/chat', {subject})
                    .then(res => {
                        console.log(res)
                        BusEvent.$emit('chat.new', newChat);
                        this.body = ''
                    })

            }
        },

        mounted() {

        }
    }
</script>
