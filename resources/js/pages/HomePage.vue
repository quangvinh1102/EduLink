<template>
  <div class="container">
    <div class="p-5 mt-5 d-flex justify-content-center align-items-center flex-column">
      <template v-for="article in articles" :key="article.id">
        <div class="card my-3" :article-id="article.id" style="width: 35rem;">
          <div class="card-body">
            <div class="article-user d-flex mb-2 justify-content-between">
              <div class="d-flex align-items-center">
                <img :src="article.user.avatar" width="45">
                <div class="ms-3">
                  <h5>{{ article.user.name }}</h5>
                  <span>10 giờ trước</span>
                </div>
              </div>
              <div class="dropdown">
                <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-bars"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="min-width: 100px !important;">
                  <li v-if="user.id == article.user.id"><a class="dropdown-item" href="#"
                      @click="deleteArticle(article.id)">Xóa bài</a></li>
                  <li v-if="user.id == article.user.id">
                    <router-link class="dropdown-item" :to="{ name: 'articles-edit', params: { id: article.id } }">
                      Sửa bài
                    </router-link>
                  </li>
                  <li><a class="dropdown-item" href="#" @click="hiddenArticle">Ẩn bài</a></li>
                </ul>
              </div>
            </div>
            <p class="card-text">{{ article.content }}</p>
          </div>
          <img v-bind:src="article.img" class="card-img-top" alt="...">
          <div class="operation d-flex p-3">
            <li class="mx-2">
              <i class="fa-regular fa-heart"></i>
            </li>
            <li class="mx-2">
              <i class="fa-regular fa-comment"></i>
            </li>
            <li class="mx-2">
              <i class="fa-solid fa-share"></i>
            </li>
          </div>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import dayjs from 'dayjs';
import axios from 'axios';
export default {
  setup() {

    const articles = ref([]);
    const user = ref([]);
    const getArticles = () => {
      axios.get('/api/article/index')
        .then((response) => {
          articles.value = response.data
        })
    }
    getArticles()

    const getCurrenUser = () => {
      axios.get('/api/user/getUserInfor')
        .then((response) => {
          user.value = response.data.user
        })
    }
    getCurrenUser()


    const hiddenArticle = (e) => {
      const div = e.currentTarget.closest('.card')
      div.classList.add("d-none");
    }

    const deleteArticle = (id) => {
      console.log(id);
      axios.delete(`api/article/${id}`)
        .then((response) => {
          getArticles()
        })
        .catch((error) => {
          console.log(error);
        })
    }

    return {
      articles,
      user,
      hiddenArticle,
      deleteArticle
    }
  }
}
</script>

<style scoped>
li {
  list-style: none;
}

li i {
  font-size: 24px;
}
</style>