<template>
    <div class="container">
        <nav id="" class="navbar navbar-light flex-column mt-5 p-3 align-items-start ms-5">
            <li class="my-4">
                <router-link :to="{ name: 'home' }" class="text-decoration-none d-flex">
                    <i class="fa-solid fa-house"></i>
                    <span class="mx-3">HOME</span>
                </router-link>
            </li>
            <li class="my-4">
                <a href="" class="d-flex">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="mx-3">SEARCH</span>
                </a>
            </li>
            <li class="my-4" style="cursor: pointer;">
                <a @click="hiddenBoxChat" class="d-flex">
                    <i class="fa-brands fa-rocketchat"></i>
                    <span class="mx-3" style="font-weight: bold;">MESSAGES</span>
                </a>
            </li>
        </nav>
        <div class="box-chat">
            <div class="card" style="width: 18rem;">
                <div class="d-flex p-3 justify-content-between bg-primary align-items-center">
                    <span class="text-white">MESSAGES</span>
                    <i @click="hiddenBoxChat" class="fa-solid fa-x text-white" style="cursor: pointer;"></i>
                </div>
                <ul class="list-group scroll list-chat">
                    <li @click="selectUser(u)" class="list-group-item d-flex align-items-center" v-for="u in usersarr.users"
                        :key="u.id">
                        <template v-if="user.id != u.id">
                            <img class="me-3" width="30" :src="u.avatar" alt="">
                            <span>{{ u.name }}</span>
                        </template>
                    </li>
                </ul>
                <ul class="card-chat list-group chat-user d-none">
                    <li class="chat-message">
                        <div v-for="msg in arr.messages" :key="msg.id">
                            <span>{{ msg.name }}: </span>
                            <span>{{ msg.message }}</span>
                            <br />
                        </div>
                    </li>
                    <div class="d-flex" style="width: 100%;">
                        <input v-model="sate.message" type="text" style="width: 82%;">
                        <button @click="sendMessage" class="btn btn-primary">Gửi</button>
                    </div>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import { reactive, onBeforeMount } from 'vue';
import { database, ref, push, onValue, child, get } from "../firebase";
import axios from 'axios';
export default {
    setup() {
        let sate = reactive({
            message: "",
        })
        let arr = reactive({
            messages: []
        })
        let usersarr = reactive({
            users: []
        })

        let selectedUser = reactive({
            name: "",
            id: ""
        });

        const newChat = reactive({
            id_chat: '',
            user_id: '',
            currentUser_id: '',
        });

        const user = reactive({
            id: '',
            name: '',
            email: '',
            avatar: '',
            role: '',
            university_id: '',
        })


        const selectUser = (user) => {
            selectedUser.name = user.name;
            selectedUser.id = user.id;
            hiddenChat();
            console.log(selectedUser);
        };

        const hiddenBoxChat = () => {
            const boxMessage = document.querySelector(".chat-message")
            const boxChat = document.querySelector(".box-chat")
            boxChat.classList.toggle('d-none')
            const listChat = document.querySelector(".list-chat")
            const chatUser = document.querySelector(".chat-user")
            listChat.classList.remove('d-none')
            chatUser.classList.add('d-none')
            boxMessage.scrollTop = 10;
        }
        const hiddenChat = () => {
            const listChat = document.querySelector(".list-chat")
            const chatUser = document.querySelector(".chat-user")
            listChat.classList.add('d-none')
            chatUser.classList.remove('d-none')
            getMessage()
        }

        const sendMessage = () => {
            push(ref(database, user.id + "_" + selectedUser.id), {
                name: user.name,
                message: sate.message
            }).then((e) =>{
                newChat.user_id = selectedUser.id
                newChat.currentUser_id = user.id
                newChat.id_chat = user.id + "_" + selectedUser.id
                createChat(newChat)
            })
            sate.message = ""
        }
        const createChat = (data) => {
            axios.put('api/chat/create', data)
                .then(response => {
                    console.log(response);
                }).catch(error => {
                    console.log(error);
                })
        }
        const getMessage = () => {
            onValue(ref(database, "userId" + selectedUser.id ), (data) => {
                arr.messages = []
                data.forEach(d => {
                    arr.messages.push(d.val())
                });
                arr.messages.reverse();
            })
        }
        onBeforeMount(() => {
            getMessage()
        });
        const getAllUsers = () => {
            axios.get(`api/user/listchat/${user.id}`)
                .then((response) => {
                    console.log(user.id);
                    // usersarr.users = response.data

                })
        }

        const getCurrentUser = () => {
            axios.get('api/user/getUserInfor')
            .then((response) => {
                    user.id = response.data.user.id
                    user.name = response.data.user.name
                    user.email = response.data.user.email
                    user.avatar = response.data.user.avatar
                    user.role = response.data.user.role
                    user.university_id = response.data.user.university_id
                })
                .catch((error) => {
                    console.error(error);
                })
        }
        getCurrentUser()

        getAllUsers()
        return {
            hiddenBoxChat,
            hiddenChat,
            sendMessage,
            selectUser,
            sate,
            arr,
            usersarr,
            user
        }
    }
}
</script>

<style scoped>
li {
    list-style: none;
}

li i {
    font-size: 26px;
}

a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    line-height: 2;
}

.box-chat {
    position: fixed;
    bottom: 0;
}

.scroll {
    max-height: 235px;
    overflow-y: auto;
}

.chat-message {
    max-height: 200px;
    overflow-y: scroll;
    display: flex;
    flex-direction: column-reverse;
}
</style>