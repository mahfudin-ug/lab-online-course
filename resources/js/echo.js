import BusEvent from './bus'

Echo.join('chat-channel')
    .here((users) => {
        BusEvent.$emit('chat.online', users)
        console.log('here', users)
    })
    .joining((user) => {
        BusEvent.$emit('chat.joining', user)
        console.log('join', user)
    })
    .leaving((user) => {
        BusEvent.$emit('chat.leaving', user)
        console.log('leaving', user)
    })

    .listen('ChatStoredEvent', (e) => {
        BusEvent.$emit('chat.new', e.data)
    })
