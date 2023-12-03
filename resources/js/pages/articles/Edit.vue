<template>
    <div class="container">
        <div class="p-5 mt-5 d-flex justify-content-center align-items-center flex-column">
            <h2 class="m-4">Sửa bài viết</h2>
            <form @submit.prevent="updateArticle" style="width: 100%;" :form="article"
                class="text-center d-flex justify-content-center align-items-center flex-column">
                <textarea v-model="article.content" id="textBox" rows="3" style="width: 60%;"
                    placeholder="Nhập nội dung"></textarea>
                <br />
                <br />
                <label for="input-content" class="file-content">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Upload to preview image</span>
                    <img :src="article.img" class="img-forcus-content" alt="">
                </label>
                <input type="file" class="img-content" hidden id="input-content" @change="handle($event)" />
                <div class="d-flex mt-5 ">
                    <button type="button" class="btn btn-secondary mx-3" data-bs-dismiss="modal">Trở về</button>
                    <button type="submit" class="btn btn-primary mx-3">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { reactive } from 'vue';
import { useRoute } from 'vue-router';
import { message } from 'ant-design-vue';
export default {
    setup() {
        const router = useRoute();
        const article = reactive({
            content: '',
            img: null,
        })
        const handle = (e) => {
            let file = e.target.files[0]
            article.img = e.target.files[0]
            console.log(file);
            let img = document.createElement('img')
            img.classList.add('img-forcus-content')
            img.src = URL.createObjectURL(file)
            document.querySelector('.file-content').appendChild(img)
        }

        const getArticleById = () => {
            axios.get(`/api/article/${router.params.id}/edit`)
                .then((response) => {
                    console.log(response);
                    article.content = response.data.article.content
                    article.img = response.data.article.img
                })
        }
        getArticleById()

        const updateArticle = () => {
            const formData = new FormData();
            formData.append('content', article.content);
            formData.append('img', article.img);
            formData.append('_method', 'put');
            axios.post(`/api/article/${router.params.id}`, formData)
                .then((response) => {
                    console.log(response);
                    if (response.status == 200) {
                        message.success("Cập nhật bài viết thành công");
                        setTimeout(() => {
                            history.back(-1);
                        }, "1000");
                    }
                })
                .catch((error) => {
                    log.error(error);
                });
        }

        return {
            handle,
            article,
            updateArticle
        }
    }
}
</script>

<style>
.file-content {
    position: relative;
    height: 346px;
    width: 60%;
    border: 2px dashed #1d1b1b;
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

.file-content i {
    font-size: 60px;
    margin-bottom: 20px;
}

.img-content {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    position: absolute;
    top: 0;
    left: 0;
    z-index: 1;
}

.img-forcus-content {
    width: 100%;
    height: 100%;
    padding: 3px;
    object-fit: cover;
    object-position: center;
    position: absolute;
    left: 0;
    right: 0;
    z-index: 1;
    bottom: 0;
}
</style>