import Vue from "vue";
import VueRouter from "vue-router";
import HomeView from "../views/HomeView.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/",
    name: "Home",
    component: HomeView,
  },
  {
    path: "/categories",
    name: "CategoriesView",
    component: () => import("../views/CategoriesView"),
  },
  {
    path: "/themes",
    name: "ThemesView",
    component: () => import("../views/ThemesView"),
  },
  {
    path: "/statistics",
    name: "StatisticsView",
    component: () => import("../views/StatisticsView"),
  },
  {
    path: "/settings",
    name: "SettingsView",
    component: () => import("../views/SettingsView"),
  },
  {
    path: "/help",
    name: "HelpView",
    component: () => import("../views/HelpView"),
  },
];

const router = new VueRouter({
  routes,
});

export default router;
