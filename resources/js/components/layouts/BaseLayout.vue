<template>
    <div class="base-layout w-100">
      <div class="">
        <Navbar class="rounded-top-right " />
        <div class="main-content d-flex  w-100 bg-amethyst">
          <Sidebar/>
          <div class="content bg-white custom-rounded-20 w-100">
            <router-view />
          </div>
        </div>
      </div>
      <Footer />
    </div>
  </template>
  
  <script>
  import Navbar from "../layouts/Navbar.vue";
  import Sidebar from "../layouts/Sidebar.vue";
  import Footer from "../layouts/Footer.vue";
  
  export default {
    name: "BaseLayout",
    components: {
      Navbar,
      Sidebar,
      Footer,
    },
  };
  </script>
  
<style scoped>
  .content {
      padding: 1rem;
    }
  .bg-amethyst{
    background-color: #5A4C8E;
  }

  .custom-rounded-20 {
      border-top-left-radius: 20px;
  }
</style>
  