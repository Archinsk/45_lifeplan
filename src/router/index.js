import Vue from "vue";
import VueRouter from "vue-router";
import Home from "../views/Home.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
  },
  {
    path: "/categories_settings",
    name: "CategoriesSettings",
    component: () => import("../views/CategoriesSettings"),
  },
  {
    path: "/themes_settings",
    name: "ThemesSettings",
    component: () => import("../views/ThemesSettings"),
  },
  {
    path: "/statistics",
    name: "Statistics",
    component: () => import("../views/Statistics"),
  },
  {
    path: "/settings",
    name: "Settings",
    component: () => import("../views/Settings"),
  },
  {
    path: "/help",
    name: "Help",
    component: () => import("../views/Help"),
  },
];

const router = new VueRouter({
  // mode: "history",
  base: process.env.BASE_URL,
  routes,
});

export default router;
