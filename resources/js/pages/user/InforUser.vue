<template>
    <div class="container">
        <div class="p-5 mt-5 d-flex justify-content-center align-items-center flex-column">
            <section style="background-color: #eee;" class="mt-5">
                <div class="container py-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img v-if="user.avatar != null" :src="user.avatar" alt="avatar"
                                        class="rounded-circle img-fluid" style="width: 150px;">
                                    <h5 class="my-3">{{ user.name }}</h5>
                                    <p class="text-muted mb-1">{{ user.description }}</p>
                                    <p class="text-muted mb-4">{{ user.location }}</p>
                                    <div class="d-flex justify-content-center mb-2">
                                        <button type="button" class="btn btn-primary">Follow</button>
                                        <button type="button" class="btn btn-outline-primary ms-1">Message</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4 mb-lg-0">
                                <div class="card-body p-0">
                                    <ul class="list-group list-group-flush rounded-3">
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fas fa-globe fa-lg text-warning"></i>
                                            <p class="mb-0">https://mdbootstrap.com</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                                            <p class="mb-0">mdbootstrap</p>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                                            <p class="mb-0">@mdbootstrap</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <form class="row" @submit.prevent="saveUser" :form="user">
                                <div class="form-outline" data-mdb-input-init>
                                    <label class="form-label" for="formControlDefault">Họ và Tên: </label>
                                    <input v-model="user.name" type="text" id="formControlDefault" class="form-control" />
                                </div>
                                <div class="form-outline" data-mdb-input-init>
                                    <label class="form-label" for="formControlDefault">Email: </label>
                                    <input v-model="user.email" type="email" id="formControlDefault" class="form-control" />
                                </div>
                                <div class="form-outline" data-mdb-input-init>
                                    <label class="form-label" for="formControlDefault">Giới Thiệu: </label>
                                    <input v-model="user.description" type="text" id="formControlDefault"
                                        class="form-control" />
                                </div>
                                <div class="form-outline" data-mdb-input-init>
                                    <label class="form-label" for="formControlDefault">Địa Chỉ: </label>
                                    <input v-model="user.location" type="text" id="formControlDefault"
                                        class="form-control" />
                                </div>
                                <div class="form-outline" data-mdb-input-init>
                                    <label class="form-label" for="formControlDefault">Giới Tính: </label>
                                    <select v-model="user.gender" class="form-select" aria-label="Default select example">
                                        <option selected>Vui lòng chọn giới tính</option>
                                        <option value="1">Nam</option>
                                        <option value="2">Nữ</option>
                                    </select>
                                </div>
                                <div class="form-outline mt-3" data-mdb-input-init>
                                    <label class="form-label me-3" for="formControlDefault">Ảnh Đại diện: </label>
                                    <a-upload list-type="picture" :before-upload="uploadImage" :max-count="1" action="">
                                        <a-button html-type="button">
                                            <i class="fa-solid fa-upload"></i>
                                            <span class="ms-2">Chọn ảnh</span>
                                        </a-button>
                                    </a-upload>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary mt-3"> Lưu </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script>
import { reactive, ref } from 'vue';
import axios from 'axios';
import { useRoute } from 'vue-router';
export default {
    setup() {

        const user = reactive({
            id: '',
            name: '',
            email: '',
            description: '',
            location: '',
            gender: 1,
            avatar: null,
        });

        const uploadImage = event => {
            user.avatar = event;
        };

        const getUserInfo = async () => {
            axios.get('api/user/getUserInfor')
                .then((response) => {
                    console.log(response);
                    user.id = response.data.user.id;
                    user.name = response.data.user.name;
                    user.email = response.data.user.email;
                    user.description = response.data.user.description;
                    user.location = response.data.user.location;
                    user.gender = response.data.user.gender;
                    user.avatar = response.data.user.avatar;

                })
                .catch(err => console.log(err))
        }
        getUserInfo()

        const saveUser = async () => {
            console.log(user);
            const formData = new FormData();
            formData.append('name', user.name);
            formData.append('email', user.email);
            formData.append('description', user.description);
            formData.append('location', user.location);
            formData.append('gender', user.gender);
            formData.append('avatar', user.avatar);
            formData.append('_method', 'put');

            axios.post(`api/user/editProfile/${user.id}`, formData)
                .then((response) => {
                    console.log(response)
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        return {
            user,
            saveUser,
            uploadImage
        }
    }
}
</script>

<style></style>