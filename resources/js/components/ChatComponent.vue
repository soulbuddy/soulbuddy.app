<template>
    <div>
        <div v-if="isInChatRoom">
            <div class="card card-default">
                <div class="card-header"><span><b-icon icon="box-arrow-left"
                                                       @click="enterChatRoom"></b-icon></span><span>   </span>Messages
                </div>
                <div class="card-body p-0">
                    <ul class="list-unstyled" style="height:300px; overflow-y:scroll" v-chat-scroll>
                        <li class="p-2" v-for="message in messages[toUserId]" :key="message.id">
                            <div v-bind:class="dialogClassObject(message.user.id)">
                                <strong>{{ message.user.name }}</strong>
                                {{ message.message }}
                            </div>
                        </li>
                    </ul>
                </div>

                <input
                    @keydown="sendTypingEvent"
                    @keyup.enter="sendMessage"
                    v-model="newMessage"
                    type="text"
                    name="message"
                    class="form-control"
                    :disabled="!isInChatRoom"></input>
            </div>
            <span class="text-muted" v-if="this.activeUser">{{ activeUser.name }} is typing...</span>
        </div>

        <div v-if="!isInChatRoom">
            <div class="card card-default">
                <div class="card-header">Active Users</div>
                <div class="card-body">
                    <ul class="user-list list-unstyled">
                        <li class="py-2"
                            v-for="(user, index) in this.users.filter(u=> u.id !== this.user.id)"
                            :key="index">
                            <span><b-icon-person-fill></b-icon-person-fill></span>
                            <button @click="enterChatRoom(user.id)"> {{ user.name }}</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</template>

<style scoped>
    .dialog-own {
        background-color: #cdf1f6;
        text-align: right;
        padding: 5px 10px;
        border-radius: 25px;
        margin-left: 10%;
    }

    .dialog-to {
        background-color: #ffdede6e;
        text-align: left;
        padding: 5px 10px;
        border-radius: 25px;
        margin-right: 10%;
    }

</style>
<script>
    export default {
        props: ['user'],
        data() {
            return {
                newMessage: '',
                isInChatRoom: false,
                toUserId: null,
            }
        },
        computed: {
            activeUser() {
                return this.$store.state.currentUser;
            },

            messages: {
                get() {
                    return this.$store.getters.getMessages;
                },
                set(value) {
                    this.$store.dispatch('updateMessages', value);
                }
            },

            users() {
                console.log('users = ' + this.$store.state.activeUsers);
                return this.$store.state.activeUsers;
            }
        },
        created() {
            this.fetchMessages();
        },
        methods: {

            dialogClassObject(userId) {
                return {
                    'dialog-own': this.toUserId !== userId,
                    'dialog-to': this.toUserId === userId
                }
            },
            enterChatRoom(id) {
                this.isInChatRoom = !this.isInChatRoom;
                if (this.toUserId != null) {
                    this.toUserId = null;
                } else {
                    this.toUserId = id;
                }
            },

            fetchMessages() {
                console.log('this user id :', this.user.id);
                this.$store.dispatch('getAllMessages', this.user.id);
            },
            sendMessage() {
                console.log('This User = ', this.$props.user);
                let msgObj = {
                    message: this.newMessage,
                    to_user_id: this.toUserId,
                    user_id: this.user.id,
                    user: {
                        id: this.user.id,
                        name: this.user.name
                    }
                }
                this.$store.dispatch('updateMessages', msgObj);
                let formData = new FormData();
                formData.append("message", this.newMessage);
                formData.append("user_id", this.toUserId);
                axios
                    .post('/messages', formData, {
                        headers: {"Content-Type": "multipart/form-data"}
                    }).then(res => console.log('message sent!'));
                this.newMessage = '';
            },
            sendTypingEvent() {
                Echo.join('message')
                    .whisper('typing', this.user);
                console.log(this.user.name + ' is typing now')
            }
        }
    }
</script>
