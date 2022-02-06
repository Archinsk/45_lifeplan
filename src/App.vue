<template>
  <div id="app">
    <router-view
      :url="url"
      :is-app-loaded="isAppLoaded"
      :tasks-db="tasks"
      :categories-db="categories"
      :icons-db="icons"
      :colors-db="colors"
      @add-new-task="addNewTask($event)"
      @toggle-task-status="toggleTaskStatus($event)"
      @delete-task="deleteTask($event)"
      @create-category="createCategory($event)"
      @edit-category="editCategory($event)"
      @delete-category="deleteCategory($event)"
    />
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/",
      loggedUser: {
        id: 1,
        name: "mihail",
      },
      tasks: [],
      categories: [],
      icons: [],
      colors: [],
      defaultTasks: [
        {
          id: 1,
          task: "Построить дом",
          done: false,
          category: { color: "red", icon: "settings" },
        },
        {
          id: 2,
          task: "Посадить дерево",
          done: false,
          category: { color: "orange", icon: "stars" },
        },
        {
          id: 3,
          task: "Вырастить сына",
          done: false,
          category: { color: "yellow", icon: "verified" },
        },
      ],
      isAppLoaded: false,
    };
  },

  methods: {
    initApp() {
      const startDate = new Date();
      const user = JSON.stringify(this.loggedUser);

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
          this.colors = response.data.colors;
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

    postAjaxRequest(url, request, callback = this.doNothing) {
      const xhr = new XMLHttpRequest();
      // console.log(request);
      xhr.open("POST", url, true);
      xhr.responseType = "json";
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          callback(xhr.response);
        }
      };
      xhr.setRequestHeader("Content-type", "application/json");
      xhr.send(request);
    },

    addNewTask(createdTask) {
      let newTask;
      if (this.loggedUser.id) {
        newTask = {
          login: this.loggedUser.name,
          userid: this.loggedUser.id,
          task: createdTask,
        };
        this.postAjaxRequest(
          this.url + "createtask.php",
          JSON.stringify(newTask),
          this.newTaskRecord
        );
      } else {
        newTask = {
          id: this.items.length + 1,
          task: createdTask,
          completed: false,
          icon: "home",
        };
      }
    },

    newTaskRecord(response) {
      this.tasks.unshift(response.task);
    },

    toggleTaskStatus(task) {
      console.log("Изменение задания");
      this.postAjaxRequest(
        this.url + "toggletaskstatus.php",
        JSON.stringify(task)
      );
      console.log("Статус - " + task.done);
      console.log(typeof task.done);
      task.done === "1" ? (task.done = "0") : (task.done = "1");
      console.log("Статус - " + task.done);
    },

    deleteTask(taskId) {
      console.log("Удаление задание c id=" + taskId);
      const task = { id: taskId };
      this.postAjaxRequest(
        this.url + "deletetask.php",
        JSON.stringify(task),
        this.removeTaskFromList(taskId)
      );
    },

    removeTaskFromList(id) {
      let tasks = this.tasks;
      this.tasks.forEach(function (task, index) {
        if (task.id === id) {
          tasks.splice(index, 1);
        }
      });
    },

    createCategory(createdCategory) {
      const newCategory = Object.assign({}, createdCategory);
      newCategory.userid = this.loggedUser.id;
      newCategory.user_name = this.loggedUser.name;
      console.log(newCategory);
      this.postAjaxRequest(
        this.url + "createcategory.php",
        JSON.stringify(newCategory),
        this.newCategoryRecord
      );
    },

    newCategoryRecord(response) {
      this.categories.push(response.category);
      this.logGroup("Новая категория", response);
    },

    editCategory(updatedCategory) {
      updatedCategory.userid = this.loggedUser.id;
      updatedCategory.user_name = this.loggedUser.name;
      this.postAjaxRequest(
        this.url + "editcategory.php",
        JSON.stringify(updatedCategory),
        this.editCategoryRecord
      );
    },

    editCategoryRecord(response) {
      console.log(response);
      let editableCategoryIndex = this.categories.findIndex(
        (category) => category.id === response.category.id.toString()
      );
      console.log(editableCategoryIndex);
      console.log(this.categories[editableCategoryIndex]);
      // При присвоении объекта категории не срабатывает реактивность
      // this.categories[editableCategoryIndex] = response.category;
      this.categories[editableCategoryIndex].name = response.category.name;
      this.categories[editableCategoryIndex].iconid = response.category.iconid;
      this.categories[editableCategoryIndex].icon = response.category.icon;
      this.categories[editableCategoryIndex].colorid =
        response.category.colorid;
      this.categories[editableCategoryIndex].color = response.category.color;
      this.logGroup("Измененная категория", response.category);
    },

    deleteCategory(deletedCategory) {
      deletedCategory.userid = this.loggedUser.id;
      deletedCategory.user_name = this.loggedUser.name;
      console.log(deletedCategory);
      this.postAjaxRequest(
        this.url + "deletecategory.php",
        JSON.stringify(deletedCategory),
        this.deleteCategoryItem
      );
    },

    deleteCategoryItem(response) {
      const deletedCategoryIndex = this.categories.findIndex(
        (category) => category.id === response.category.id
      );
      this.categories.splice(deletedCategoryIndex, 1);
      this.logGroup("Удаленная категория", response);
    },

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    doNothing() {},

    // addNewIcons() {
    //   this.postAjaxRequest(
    //     this.url + "createicons.php",
    //     JSON.stringify(this.newIcons),
    //     this.logGroup("Записываю иконки", this.icons)
    //   );
    // },

    // createNewColors() {
    //   this.postAjaxRequest(
    //     this.url + "createcolors.php",
    //     JSON.stringify(this.newColors),
    //     this.logGroup("Записываю иконки", this.newColors)
    //   );
    // },

    // writeCategoriesToTasks() {
    //   this.postAjaxRequest(
    //           this.url + "assigncategoriestotasks.php",
    //           JSON.stringify({}),
    //           this.logGroup("Присвоение категорий существующим заданиям", this.tasks)
    //   );
    // },
  },

  mounted() {
    this.initApp();
    console.log("Компонент App смонтирован");
  },
};
</script>
