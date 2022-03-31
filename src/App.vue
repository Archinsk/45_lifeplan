<template>
  <div id="app">
    <router-view
      :url="url"
      :is-app-loaded="isAppLoaded"
      :theme="theme"
      :tasks-db="tasks"
      :categories-db="categories"
      :icons-db="icons"
      :colors-db="colors"
      :themes="basicThemes"
      :lightness-mode="darkMode"
      :is-auth-user="isAuthUser"
      @add-new-task="addNewTask($event)"
      @toggle-task-status="toggleTaskStatus($event)"
      @delete-task="deleteTask($event)"
      @create-category="createCategory($event)"
      @edit-category="editCategory($event)"
      @delete-category="deleteCategory($event)"
      @change-color-theme="changeColorTheme($event)"
      @change-dark-mode="changeDarkMode($event)"
      @auth-user="authUser($event)"
      @sign-out="signOut"
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
        id: "1",
        name: "mihail",
      },
      // loggedUser: {
      //   id: null,
      //   name: "",
      // },
      // loggedUser: {
      //   id: 79,
      //   name: "Гость",
      // },
      tasks: [],
      defaultTasks: [
        {
          id: "1534",
          task: "Бытовые. Заменить выключатель в детской комнате",
          done: "0",
          creationDate: 1642636460,
          completionDate: null,
          categoryid: "121",
        },
        {
          id: "1533",
          task: "Саморазвитие. Поучаствовать в соревнованиях по настольному теннису",
          done: "0",
          creationDate: 1642636430,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1532",
          task: "Саморазвитие. Разучить на гитаре песню Depeche Mode «Personal Jesus»",
          done: "0",
          creationDate: 1642636400,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1531",
          task: "Саморазвитие. Прочитать книгу Экзюпери «Цитадель»",
          done: "0",
          creationDate: 1642241690,
          completionDate: null,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1530",
          task: "Саморазвитие. Пройти интерактивный курс htmlacademy.ru",
          done: "1",
          creationDate: 1642241660,
          completionDate: 1645600075,
          categoryid: "123",
          category: {
            id: "123",
            name: "Саморазвитие",
            iconid: "13",
            icon: "self_improvement",
            colorid: "6",
            color: "#9060C0",
          },
        },
        {
          id: "1529",
          task: "Бытовые. Заменить светильник в кухне",
          done: "0",
          creationDate: 1642241630,
          completionDate: null,
          categoryid: "121",
        },
        {
          id: "1528",
          task: "Бытовые. Собрать компьютерный стол",
          done: "1",
          creationDate: 1642241600,
          completionDate: 1642670000,
          categoryid: "121",
        },
        {
          id: "1527",
          task: "Жизненный план. Закупить строительные материалы",
          done: "0",
          creationDate: 1641550460,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1525",
          task: "Жизненный план. Выполнить проект дома",
          done: "1",
          creationDate: 1641550430,
          completionDate: 1645600045,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1526",
          task: "Жизненный план. Приобрести участок под строительство",
          done: "1",
          creationDate: 1641550400,
          completionDate: 1644559611,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1524",
          task: "Жизненный план. Вырастить сына",
          done: "0",
          creationDate: 1641032060,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1523",
          task: "Жизненный план. Построить дом",
          done: "0",
          creationDate: 1641032030,
          completionDate: null,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
        {
          id: "1522",
          task: "Жизненный план. Посадить дерево",
          done: "1",
          creationDate: 1641032000,
          completionDate: 1641550400,
          categoryid: "122",
          category: {
            id: "122",
            name: "Жизненный план",
            iconid: "7",
            icon: "stars",
            colorid: "1",
            color: "#60C060",
          },
        },
      ],
      categories: [],
      defaultCategories: [
        {
          id: "122",
          name: "Жизненный план",
          iconid: "7",
          icon: "stars",
          colorid: "1",
          color: "#60C060",
        },
        {
          id: "123",
          name: "Саморазвитие",
          iconid: "13",
          icon: "self_improvement",
          colorid: "6",
          color: "#9060C0",
        },
      ],
      icons: [],
      colors: [],
      isAppLoaded: false,
      themeColor: "amethyst",
      darkMode: "light",
      basicThemes: [
        {
          id: 1,
          value: "emerald",
          name: "Изумруд",
        },
        {
          id: 2,
          value: "jade",
          name: "Нефрит",
        },
        {
          id: 3,
          value: "turquoise",
          name: "Бирюза",
        },
        {
          id: 4,
          value: "steel",
          name: "Сталь",
        },
        {
          id: 5,
          value: "azure",
          name: "Лазурь",
        },
        {
          id: 6,
          value: "amethyst",
          name: "Аметист",
        },
        {
          id: 7,
          value: "fuchsia",
          name: "Фуксия",
        },
        {
          id: 8,
          value: "honeysuckle",
          name: "Жимолость",
        },
        {
          id: 9,
          value: "chestnut",
          name: "Каштан",
        },
        {
          id: 10,
          value: "copper",
          name: "Медь",
        },
        {
          id: 11,
          value: "khaki",
          name: "Хаки",
        },
        {
          id: 12,
          value: "asparagus",
          name: "Спаржа",
        },
      ],
    };
  },

  computed: {
    isAuthUser: function () {
      return !!this.loggedUser.id;
    },
    theme: function () {
      return {
        primary: this.darkMode + "-" + this.themeColor + "-primary",
        secondary: this.darkMode + "-" + this.themeColor + "-secondary",
        info: this.darkMode + "-" + this.themeColor + "-info",
      };
    },
  },

  methods: {
    initApp() {
      const startDate = new Date();
      const user = JSON.stringify(this.loggedUser);

      const checkAuth = new Promise((resolve) => {
        axios.post(this.url + "checkauth.php", {}).then((response) => {
          if (response.data.user) {
            this.loggedUser = response.data.user;
          }
          resolve();
        });
      });

      const iconsDB = axios
        .post(this.url + "geticons.php", user)
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
        .post(this.url + "getcolors.php", user)
        .then((response) => {
          this.logGroup(
            "Список цветов получен за " +
              (new Date() - startDate) +
              "мс со старта программы"
          );
          this.colors = response.data.colors;
        });

      if (this.loggedUser.id) {
        const tasksDB = new Promise((resolve) => {
          checkAuth.then(() => {
            axios
              .post(this.url + "gettasks.php", this.loggedUser)
              .then((response) => {
                this.logGroup(
                  "Список заданий получен через " +
                    (new Date() - startDate) +
                    "мс со старта программы",
                  response.data.tasks
                );
                this.tasks = response.data.tasks;
                resolve();
              });
          });
        });

        const categoriesDB = new Promise((resolve) => {
          checkAuth.then(() => {
            axios
              .post(this.url + "getcategories.php", this.loggedUser)
              .then((response) => {
                this.logGroup(
                  "Список категорий получен за " +
                    (new Date() - startDate) +
                    "мс со старта программы",
                  response.data.categories
                );
                this.categories = response.data.categories;
                resolve();
              });
          });
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
            this.tasks
          );
        });

        categoriesWithIconsAndColors.then(() => {
          this.isAppLoaded = true;
          console.log(
            "Програма инициализирована за " + (new Date() - startDate) + "мс"
          );
        });
      } else {
        this.tasks = this.defaultTasks;
        this.categories = this.defaultCategories;
        this.isAppLoaded = true;
        console.log(
          "Програма инициализирована за " + (new Date() - startDate) + "мс"
        );
      }
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
            category.color = color.name;
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

    assignCategoryToTasksByName(category) {
      let tasks = this.tasks;
      tasks.forEach(function (task) {
        if (task.task.startsWith(category.name)) {
          task.category = category;
        }
      });
    },

    addNewTask(createdTask) {
      const newTask = {
        login: this.loggedUser.name,
        userid: this.loggedUser.id,
        task: createdTask,
      };
      axios.post(this.url + "createtask.php", newTask).then((response) => {
        let task = response.data.task;
        // Разобраться с типами данных
        task.id = "" + task.id;
        if (task.categoryid) {
          task.category = this.categories.find(
            (category) => category.id === task.categoryid
          );
        }
        this.tasks.unshift(task);
      });
    },

    toggleTaskStatus(updatedTask) {
      axios
        .post(this.url + "toggletaskstatus.php", updatedTask)
        .then((response) => {
          const task = this.tasks.find(
            (task) => task.id === response.data.task.id
          );
          task.done = task.done === "0" ? "1" : "0";
          task.completionDate =
            task.completionDate === null
              ? response.data.task.completion_date
              : null;
        });
    },

    deleteTask(taskId) {
      const task = { id: taskId };
      axios.post(this.url + "deletetask.php", task).then(() => {
        let taskIndex = this.tasks.findIndex((task) => task.id === taskId);
        this.tasks.splice(taskIndex, 1);
      });
    },

    changeColorTheme(basicThemeId) {
      console.log("Смена темы");
      const colorTheme = this.basicThemes[basicThemeId - 1];
      this.themeColor = colorTheme.value;
      document.body.className = "bg-" + this.theme.secondary;
    },

    changeDarkMode(darkMode) {
      this.darkMode = darkMode === "light" ? "dark" : "light";
      document.body.className = "bg-" + this.theme.secondary;
    },

    createCategory(createdCategory) {
      const newCategory = Object.assign({}, createdCategory);
      newCategory.userid = this.loggedUser.id;
      newCategory.user_name = this.loggedUser.name;
      axios
        .post(this.url + "createcategory.php", newCategory)
        .then((response) => {
          this.categories.push(response.data.category);
          if (newCategory.search) {
            this.assignCategoryToTasksByName(response.data.category);
          }
          this.logGroup("Новая категория", response.data);
        });
    },

    editCategory(updatedCategory) {
      updatedCategory.userid = this.loggedUser.id;
      updatedCategory.user_name = this.loggedUser.name;
      axios
        .post(this.url + "editcategory.php", updatedCategory)
        .then((response) => {
          let editableCategoryIndex = this.categories.findIndex(
            (category) => category.id === response.data.category.id.toString()
          );
          // При присвоении объекта категории не срабатывает реактивность
          // this.categories[editableCategoryIndex] = response.category;
          this.categories[editableCategoryIndex].name =
            response.data.category.name;
          this.categories[editableCategoryIndex].iconid =
            response.data.category.iconid;
          this.categories[editableCategoryIndex].icon =
            response.data.category.icon;
          this.categories[editableCategoryIndex].colorid =
            response.data.category.colorid;
          this.categories[editableCategoryIndex].color =
            response.data.category.color;
          this.logGroup("Измененная категория", response.data);
        });
    },

    deleteCategory(deletedCategory) {
      deletedCategory.userid = this.loggedUser.id;
      deletedCategory.user_name = this.loggedUser.name;
      axios
        .post(this.url + "deletecategory.php", deletedCategory)
        .then((response) => {
          const deletedCategoryIndex = this.categories.findIndex(
            (category) => category.id === response.data.category.id
          );
          this.categories.splice(deletedCategoryIndex, 1);
          this.tasks.forEach(function (task) {
            if (
              task.category &&
              task.category.id === response.data.category.id
            ) {
              delete task.category;
            }
          });
          this.logGroup("Удаленная категория", response.data);
        });
    },

    authUser(user) {
      this.loggedUser = user;
      this.initApp();
      this.$router.push("/");
    },

    signOut() {
      console.log("Выход");
      axios.post(this.url + "signout.php").then(() => {
        this.loggedUser = {
          id: null,
          name: "",
        };
        this.initApp();
        this.$router.push("/");
      });
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
    document.body.className = "bg-" + this.theme.secondary;
    console.log("Компонент App смонтирован");
  },
};
</script>
