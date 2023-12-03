<template>
    <header class="p-3 border-bottom">
        <div class="row">
            <router-link :to="{ name: 'home' }" class="text-decoration-none text-left col-3 text-center">
                <h1 class="">Edu-Link</h1>
            </router-link>
            <div class="log-school col-6">
                <div class="d-flex justify-content-center align-items-center">
                    <li class="mx-1">
                        <a-avatar :size="64">
                            <template #icon>
                                <UserOutlined />
                            </template>
                        </a-avatar>
                    </li>
                    <li class="mx-1">
                        <a-avatar :size="64">
                            <template #icon>
                                <UserOutlined />
                            </template>
                        </a-avatar>
                    </li>
                    <li class="mx-1">
                        <a-avatar :size="64">
                            <template #icon>
                                <UserOutlined />
                            </template>
                        </a-avatar>
                    </li>
                    <li class="mx-1">
                        <a-avatar :size="64">
                            <template #icon>
                                <UserOutlined />
                            </template>
                        </a-avatar>
                    </li>
                    <li class="mx-1">
                        <a-avatar :size="64">
                            <template #icon>
                                <UserOutlined />
                            </template>
                        </a-avatar>
                    </li>
                </div>
            </div>
            <div class="col-3 d-none d-lg-block">
                <div class="d-flex justify-content-between align-items-center">
                    <button v-if="user.role == 1" type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        Đăng Bài
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tạo Bài Viết</h5>
                                    <button type="button" @click="reFresh()" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="" @submit.prevent="createArticle" :form="articles">
                                    <div class="modal-body">
                                        <h6>Nội dung bài viết</h6>
                                        <textarea v-model="articles.content" id="textBox" rows="3" style="width: 100%;"
                                            @click="focuText()" placeholder="Nhập nội dung">
                                    </textarea>
                                        <label for="input-img" class="file-img">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                            <span>Upload to preview image</span>
                                        </label>
                                        <input type="file" class="img-file" hidden id="input-img"
                                            @change="ChangeImg($event)" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <div class="log-user float-end d-flex justify-content-between align-items-center">
                                <h5 class="me-3">{{ user.name }}</h5>
                                <img :src="user.avatar" width="50">
                            </div>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li>
                                <router-link :to="{ name: 'profile', params: {id: user.id } }" class="text-decoration-none dropdown-item">
                                    <span>Trang cá nhân</span>
                                </router-link>
                            </li>
                            <li><a class="dropdown-item btn" @click="logout">Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import { message } from 'ant-design-vue';
import axios from 'axios'
import { useRouter } from 'vue-router';
import { reactive, ref, watch } from 'vue';
export default {
    setup() {
        const router = useRouter();
        const articles = reactive({
            content: '',
            img: null,
        })
        const user = reactive({
            id: '',
            name: '',
            email: '',
            avatar: '',
            role: '',
            university_id: '',
        })
        const getUserInfo = () => {
            axios.get('api/user/getUserInfor')
                .then((response) => {
                console.log(response);
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
        getUserInfo()
        const focuText = () => {
            const texBox = document.getElementById('textBox')
            texBox.selectionStart = 0;
            texBox.selectionEnd = 0;
            texBox.focus();
        }

        const ChangeImg = (e) => {
            let file = e.target.files[0]
            articles.img = e.target.files[0]
            if (!file) return
            let img = document.createElement('img')
            img.classList.add('img-forcus')
            img.src = URL.createObjectURL(file)
            document.querySelector('.file-img').appendChild(img)
        }

        const reFresh = () => {
            articles.content = ''
            const imgRefesh = document.getElementsByTagName('img')
            if (imgRefesh[0]) {
                imgRefesh[0].remove()
            }
        }
        const logout = () => {
            axios.get('/api/user/logout')
                .then((response) => {
                    console.log(response);
                    if (response.status == 200 && response.data.status_code == 200) {
                        localStorage.removeItem('user_token');
                        user.value = '';
                        router.push({ name: 'login' });
                    }
                })
        }

        const createArticle = async () => {
            const imgRefesh = document.getElementsByTagName('img')
            const formData = new FormData();
            formData.append('content', articles.content);
            formData.append('img', articles.img);
            formData.append('user_id', user.id);
            axios.post('api/article/create', formData)
                .then(response => {
                    articles.content = ''
                    imgRefesh[0].remove()
                    message.success("Bài viết đã được tải lên");
                    window.location.reload()
                })
                .catch(error => {
                    console.error(error);
                });
        }


        return {
            focuText,
            ChangeImg,
            reFresh,
            createArticle,
            articles,
            user,
            logout
        }
    }
}
</script>

<style>
li {
    list-style: none;
}

.modal-backdrop {
    z-index: unset !important;
}

.file-img {
    height: 200px;
    border: 2px dashed #fff;
    color: black;
    font-size: 22px;
    border-radius: 6px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    cursor: pointer;
}

.file-img i {
    font-size: 60px;
    margin-bottom: 20px;
}

.img-file {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.img-forcus {
    width: 100%;
    height: 67%;
    object-fit: cover;
    object-position: center;
    position: absolute;
    padding: 15px;
    left: 0;
    right: 0;
    z-index: 1;
    bottom: 0;
}
</style>