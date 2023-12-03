<template>
    <div id="register">
        <div class="limiter">
            <div class="container-login100" style="background-image: url('/image/logo/bg-01.jpg');">
                <div class="wrap-login100 p-wrap-login">
                    <form class="login100-form validate-form" @submit.prevent="createUser" :form="user" method="POST"
                        action="">
                        <span class="login100-form-title pb-5">
                            REGISTER
                        </span>

                        <div class="wrap-input100 validate-input  mb-3" data-validate="Username is reauired">
                            <span class="label-input100">Username</span>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-user"></i>
                                <input v-model="user.name" class="input100" type="text" name="username"
                                    placeholder="Type your username">
                            </div>
                            <span v-if="errors.name" class="text-danger">{{ errors.name[0] }}</span>
                        </div>

                        <div class="wrap-input100 validate-input  mb-3" data-validate="Username is reauired">
                            <span class="label-input100">Email</span>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-envelope"></i>
                                <input v-model="user.email" class="input100" type="email" name="email"
                                    placeholder="Type your username">
                            </div>
                            <span v-if="errors.email" class="text-danger">{{ errors.email[0] }}</span>
                        </div>

                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <span class="label-input100">Password</span>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-lock"></i>
                                <input v-model="user.password" class="input100" type="password" name="pass"
                                    placeholder="Type your password">
                            </div>
                            <span v-if="errors.password" class="text-danger">{{ errors.password[0] }}</span>
                        </div>
                        <br>
                        <div class="wrap-input100 validate-input" data-validate="Password is required">
                            <span class="label-input100">Comfirm Password</span>
                            <div class="d-flex align-items-center">
                                <i class="fa-solid fa-lock"></i>
                                <input v-model="user.confirm_password" class="input100" type="password" name="comfirm_pass"
                                    placeholder="Type your password">
                            </div>
                            <span v-if="errors.confirm_password" class="text-danger">{{ errors.confirm_password[0] }}</span>
                        </div>

                        <div class="text-right  pt-1 pb-3">
                            <label for="" class="me-3">Bạn là admin</label>
                            <input type="checkbox" id="myCheckbox" v-model="user.admin" name="admin">

                            <select name="university_id" id="inputContainer" class="form-select"
                                v-model="user.university_id" aria-label="Default select example">
                                <option :value="0">Tên trường đại học của bạn</option>
                                <option v-for="university in university.name" :key="university.id" :value="university.id">{{
                                    university.name }}</option>
                            </select>
                            <span v-if="errors.university_id" class="text-danger">{{ errors.university_id[0] }}</span>
                        </div>

                        <div class="container-login100-form-btn">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button class="login100-form-btn" type="submit">
                                    REGISTER
                                </button>
                            </div>
                        </div>

                        <div class="txt1 text-center pt-5 pb-2">
                            <span>
                                Or Sign Up Using
                            </span>
                        </div>

                        <div class="d-flex flex-column align-items-center p-t-155">
                            <span class="txt1 pb-2">
                                Or Login
                            </span>

                            <router-link :to="{ name: 'login' }" lass="txt2">
                                Sign Up
                            </router-link>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import axios from "axios";
import { message } from 'ant-design-vue';
import { useRoute } from 'vue-router';
import { ref } from "vue";
import { reactive } from 'vue';
export default {
    setup() {
        const router = useRoute();
        const errors = ref({})

        const university = reactive({
            name: '',
            description: '',
            avatar: '',
            location: '',
        });
        const user = reactive({
            name: '',
            email: '',
            password: '',
            confirm_password: '',
            admin: false,
            university_id: '',
        });
        const getUniversity = async () => {
            axios.get('api/university/info')
                .then((response) => {
                    if (response.status == 200) {
                        university.name = response.data.listUniversity
                    }
                    return response.data.message;
                })
        }
        getUniversity()
        const createUser = async () => {
            axios.post('api/user/create', user)
                .then((response) => {
                    if (response.status == 200) {
                        Object.assign(user, {
                            name: '',
                            email: '',
                            password: '',
                            confirm_password: '',
                            admin: false,
                            university_id: ''
                        })
                        errors.value = '';
                        message.success("Đăng ký thành công");
                        router.push({ name: 'login' });
                    }
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        errors.value = error.response.data.errors;
                        console.log(errors);
                    }
                })
        }
        return {
            university,
            user,
            errors,
            router,
            createUser,
        }
    }
}
</script>
  
<style scoped>
#inputContainer {
    display: none;
}

#myCheckbox:checked+#inputContainer {
    display: block;
}


/*//////////////////////////////////////////////////////////////////
  [ RESTYLE TAG ]*/

* {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
}

body,
html {
    height: 100%;
    font-family: Poppins-Regular, sans-serif;
}

/*---------------------------------------------*/
a {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    margin: 0px;
    transition: all 0.4s;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    text-decoration: none;
}

a:focus {
    outline: none !important;
}

a:hover {
    text-decoration: none;
    color: #a64bf4;
}

/*---------------------------------------------*/
h1,
h2,
h3,
h4,
h5,
h6 {
    margin: 0px;
}

p {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.7;
    color: #666666;
    margin: 0px;
}

ul,
li {
    margin: 0px;
    list-style-type: none;
}


/*---------------------------------------------*/
input {
    outline: none;
    border: none;
}

textarea {
    outline: none;
    border: none;
}

textarea:focus,
input:focus {
    border-color: transparent !important;
}

input:focus::-webkit-input-placeholder {
    color: transparent;
}

input:focus:-moz-placeholder {
    color: transparent;
}

input:focus::-moz-placeholder {
    color: transparent;
}

input:focus:-ms-input-placeholder {
    color: transparent;
}

textarea:focus::-webkit-input-placeholder {
    color: transparent;
}

textarea:focus:-moz-placeholder {
    color: transparent;
}

textarea:focus::-moz-placeholder {
    color: transparent;
}

textarea:focus:-ms-input-placeholder {
    color: transparent;
}

input::-webkit-input-placeholder {
    color: #adadad;
}

input:-moz-placeholder {
    color: #adadad;
}

input::-moz-placeholder {
    color: #adadad;
}

input:-ms-input-placeholder {
    color: #adadad;
}

textarea::-webkit-input-placeholder {
    color: #adadad;
}

textarea:-moz-placeholder {
    color: #adadad;
}

textarea::-moz-placeholder {
    color: #adadad;
}

textarea:-ms-input-placeholder {
    color: #adadad;
}

/*---------------------------------------------*/
button {
    outline: none !important;
    border: none;
    background: transparent;
}

button:hover {
    cursor: pointer;
}

iframe {
    border: none !important;
}

/*//////////////////////////////////////////////////////////////////
  [ Utility ]*/
.txt1 {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.5;
    color: #666666;
}

.txt2 {
    font-family: Poppins-Regular;
    font-size: 14px;
    line-height: 1.5;
    color: #333333;
    text-transform: uppercase;
}

.bg1 {
    background-color: #3b5998
}

.bg2 {
    background-color: #1da1f2
}

.bg3 {
    background-color: #ea4335
}



/*//////////////////////////////////////////////////////////////////
  [ login ]*/
.limiter {
    width: 100%;
    margin: 0 auto;
}

.container-login100 {
    width: 100%;
    min-height: 100vh;
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    padding: 15px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.wrap-login100 {
    width: 500px;
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
}


/*------------------------------------------------------------------
  [ Form ]*/

.login100-form {
    width: 100%;
}

.login100-form-title {
    display: block;
    font-family: Poppins-Bold;
    font-size: 39px;
    color: #333333;
    line-height: 1.2;
    text-align: center;
}



/*------------------------------------------------------------------
  [ Input ]*/

.wrap-input100 {
    width: 100%;
    position: relative;
    border-bottom: 2px solid #d9d9d9;
}

.label-input100 {
    font-family: Poppins-Regular;
    font-size: 14px;
    color: #333333;
    line-height: 1.5;
    padding-left: 7px;
}

.input100 {
    font-family: Poppins-Medium;
    font-size: 16px;
    color: #333333;
    line-height: 1.2;

    display: block;
    width: 100%;
    height: 55px;
    background: transparent;
    padding: 0 7px 0 23px;
}


/*---------------------------------------------*/
.focus-input100 {
    position: absolute;
    display: block;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    pointer-events: none;
}

.focus-input100::after {
    content: attr(data-symbol);
    font-family: Material-Design-Iconic-Font;
    color: #adadad;
    font-size: 22px;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    height: calc(100% - 20px);
    bottom: 0;
    left: 0;
    padding-left: 13px;
    padding-top: 3px;
}

.focus-input100::before {
    content: "";
    display: block;
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #7f7f7f;
    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}


.input100:focus+.focus-input100::before {
    width: 100%;
}

.has-val.input100+.focus-input100::before {
    width: 100%;
}

.input100:focus+.focus-input100::after {
    color: #a64bf4;
}

.has-val.input100+.focus-input100::after {
    color: #a64bf4;
}


/*------------------------------------------------------------------
  [ Button ]*/
.container-login100-form-btn {
    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.wrap-login100-form-btn {
    width: 100%;
    display: block;
    position: relative;
    z-index: 1;
    border-radius: 25px;
    overflow: hidden;
    margin: 0 auto;

    box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -moz-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -webkit-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -o-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
    -ms-box-shadow: 0 5px 30px 0px rgba(3, 216, 222, 0.2);
}

.login100-form-bgbtn {
    position: absolute;
    z-index: -1;
    width: 300%;
    height: 100%;
    background: #a64bf4;
    background: -webkit-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -o-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: -moz-linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    background: linear-gradient(right, #00dbde, #fc00ff, #00dbde, #fc00ff);
    top: 0;
    left: -100%;

    -webkit-transition: all 0.4s;
    -o-transition: all 0.4s;
    -moz-transition: all 0.4s;
    transition: all 0.4s;
}

.login100-form-btn {
    font-family: Poppins-Medium;
    font-size: 16px;
    color: #fff;
    line-height: 1.2;
    text-transform: uppercase;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0 20px;
    width: 100%;
    height: 50px;
}

.wrap-login100-form-btn:hover .login100-form-bgbtn {
    left: 0;
}


/*------------------------------------------------------------------
  [ Alert validate ]*/

.validate-input {
    position: relative;
}

.alert-validate::before {
    content: attr(data-validate);
    position: absolute;
    max-width: 70%;
    background-color: #fff;
    border: 1px solid #c80000;
    border-radius: 2px;
    padding: 4px 25px 4px 10px;
    bottom: calc((100% - 20px) / 2);
    -webkit-transform: translateY(50%);
    -moz-transform: translateY(50%);
    -ms-transform: translateY(50%);
    -o-transform: translateY(50%);
    transform: translateY(50%);
    right: 2px;
    pointer-events: none;

    font-family: Poppins-Regular;
    color: #c80000;
    font-size: 13px;
    line-height: 1.4;
    text-align: left;

    visibility: hidden;
    opacity: 0;

    -webkit-transition: opacity 0.4s;
    -o-transition: opacity 0.4s;
    -moz-transition: opacity 0.4s;
    transition: opacity 0.4s;
}

.alert-validate::after {
    content: "\f06a";
    font-family: FontAwesome;
    display: block;
    position: absolute;
    color: #c80000;
    font-size: 16px;
    bottom: calc((100% - 20px) / 2);
    -webkit-transform: translateY(50%);
    -moz-transform: translateY(50%);
    -ms-transform: translateY(50%);
    -o-transform: translateY(50%);
    transform: translateY(50%);
    right: 8px;
}

.alert-validate:hover:before {
    visibility: visible;
    opacity: 1;
}

@media (max-width: 992px) {
    .alert-validate::before {
        visibility: visible;
        opacity: 1;
    }
}


/*//////////////////////////////////////////////////////////////////
  [ Social item ]*/
.login100-social-item {
    font-size: 25px;
    color: #fff;

    display: -webkit-box;
    display: -webkit-flex;
    display: -moz-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin: 5px;
}

.login100-social-item:hover {
    color: #fff;
    background-color: #333333;
}

.p-wrap-login {
    padding-left: 55px;
    padding-right: 55px;
    padding-top: 65px;
    padding-bottom: 54px;
}

.p-t-155 {
    /* padding-top: 50px; */
}

/*//////////////////////////////////////////////////////////////////
  [ Responsive ]*/

@media (max-width: 576px) {
    .wrap-login100 {
        padding-left: 15px;
        padding-right: 15px;
    }
}
</style>