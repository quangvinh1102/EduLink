<template>
    <header class="p-3 border-bottom ">
        <div class="row">
            <h1 class="text-left col">Edu-Link</h1>
            <div class="log-school col">
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
            <div class="col">
                <div class="log-user float-end">
                    <a-avatar :size="64">
                    <template #icon>
                        <UserOutlined />
                    </template>
                </a-avatar>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import axios from 'axios'
export default {
    setup() {
        const getUserInfo = () => {
            axios.get('api/user123/infor123')
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    console.error(error);
                })
        }
        getUserInfo()

        return {
        }
    }
}
</script>

<style scoped>
li {
    list-style: none;
}
</style>