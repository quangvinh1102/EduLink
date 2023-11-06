<template>
  <div class="container">
    <div class="p-5 mt-5 d-flex justify-content-center align-items-center flex-column">
      <div class="card my-3" style="width: 35rem;">
        <div class="card-body">
          <div class="article-user d-flex align-items-center mb-2">
            <a-avatar :size="45">
              <template #icon>
                <UserOutlined />
              </template>
            </a-avatar>
            <div class="ms-3">
              <h5>Quang Vinh</h5>
              <span>10 giờ trước</span>
            </div>
          </div>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
        </div>
        <img src="https://cdn.sforum.vn/sforum/wp-content/uploads/2022/05/kich-thuoc-anh-quang-cao-facebook1.jpg"
          class="card-img-top" alt="...">
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
    </div>
  </div>
</template>

<script>
export default {

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