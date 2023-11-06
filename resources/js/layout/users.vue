<template>
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 position-fixed" style="z-index: 1;">
          <TheHeader />
        </div>
        <div class="col-12">
          <div class="row">
            <div class="col-3 d-none d-md-flex position-fixed mt-5" style="z-index: 1;">
              <TheMenu />
            </div>
            <div class="col">
              <router-view></router-view>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  

<script>
import TheHeader from '../components/TheHeader.vue';
import TheMenu from '../components/TheMenu.vue';
export default {
    components: { TheHeader, TheMenu},
}
</script>

<style>

</style>