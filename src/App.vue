<template>
  <div id="app">
    <router-view
      :url="url"
      :is-app-loaded="isAppLoaded"
      :tasks="tasks"
      :categories="categories"
      :icons="icons"
      :colors="colors"
    />
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/gettasks.php",
      tasks: [],
      categories: [],
      icons: [],
      colors: [],
      isAppLoaded: false,
    };
  },

  methods: {
    async initApp() {
      const startDate = new Date();
      const user = JSON.stringify({
        id: 1,
        name: "mihail",
      });

      const tasksDB = axios
        .post("https://www.d-skills.ru/45_lifeplan/php/gettasks.php", user)
        .then((response) => {
          this.logGroup(
            "Список заданий получен через " +
              (new Date() - startDate) +
              "мс со старта программы",
            response.data.tasks
          );
          this.tasks = response.data.tasks;
        });

      const categoriesDB = axios
        .post("https://www.d-skills.ru/45_lifeplan/php/getcategories.php", user)
        .then((response) => {
          this.logGroup(
            "Список категорий получен за " +
              (new Date() - startDate) +
              "мс со старта программы",
            response.data.categories
          );
          this.categories = response.data.categories;
        });

      const iconsDB = axios
        .post("https://www.d-skills.ru/45_lifeplan/php/geticons.php", user)
        .then((response) => {
          this.logGroup(
            "Список иконок получен за " +
              (new Date() - startDate) +
              "мс со старта программы",
            response.data.icons
          );
          this.icons = response.data.icons;
        });

      const colorsDB = axios
        .post("https://www.d-skills.ru/45_lifeplan/php/getcolors.php", user)
        .then((response) => {
          this.logGroup(
            "Список цветов получен за " +
              (new Date() - startDate) +
              "мс со старта программы"
          );
          this.icons = response.data.colors;
        });

      const categoriesWithIcons = Promise.all([categoriesDB, iconsDB]).then(
        () => {
          this.assignIconsToCategories();
          this.logGroup(
            "Категориям присвоены иконки через " +
              (new Date() - startDate) +
              "мс со старта программы",
            this.categories
          );
        }
      );

      const categoriesWithColors = Promise.all([categoriesDB, colorsDB]).then(
        () => {
          this.assignColorsToCategories();
          this.logGroup(
            "Категориям присвоены цвета через " +
              (new Date() - startDate) +
              "мс со старта программы",
            this.categories
          );
        }
      );

      const categoriesWithIconsAndColors = Promise.all([
        tasksDB,
        categoriesWithIcons,
        categoriesWithColors,
      ]).then(() => {
        this.assignCategoriesToTasks();
        this.logGroup(
          "Заданиям присвоены категории с иконками и цветами через " +
            (new Date() - startDate) +
            "мс со старта программы",
          this.categories
        );
      });

      categoriesWithIconsAndColors.then(() => {
        this.isAppLoaded = true;
        console.log(
          "Програма инициализирована за " + (new Date() - startDate) + "мс"
        );
      });
    },

    assignIconsToCategories() {
      let categories = this.categories;
      let icons = this.icons;
      categories.forEach(function (category) {
        icons.forEach(function (icon) {
          if (category.iconid === icon.id) {
            category.icon = icon.icon;
          }
        });
      });
    },

    assignColorsToCategories() {
      let categories = this.categories;
      let colors = this.colors;
      categories.forEach(function (category) {
        colors.forEach(function (color) {
          if (category.colorid === color.id) {
            category.color = color.hex_color;
          }
        });
      });
    },

    assignCategoriesToTasks() {
      let tasks = this.tasks;
      let categories = this.categories;
      tasks.forEach(function (task) {
        categories.forEach(function (category) {
          if (task.categoryid === category.id) {
            task.category = category;
          }
        });
      });
    },

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },
  },

  mounted() {
    this.initApp();
  },
};
</script>
