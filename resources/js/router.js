import { createRouter, createWebHistory } from 'vue-router';
import BaseLayout from "./components/layouts/BaseLayout.vue";

// Import views
import Home from './views/Home.vue';
import About from './views/About.vue';


const routes = [
    {
      path: "/",
      component: BaseLayout,
      children: [
        {
          path: "",
          name: "Home",
          component: Home,
        },
        {
          path: "about",
          name: "About",
          component: About,
        },
      ],
    },
  ];

const router = createRouter({
    history: createWebHistory(),
    routes
});

export default router;
