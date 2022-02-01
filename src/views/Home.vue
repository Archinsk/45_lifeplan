<template>
  <div>
    <Header @lists-toggle="listsToggle" />
    <div class="container">
      <FormAddTask @add-new-task="addNewTask($event)" />
      <div id="tasks">
        <TaskList
          :list-items="tasksDone"
          @toggle-task-status="toggleTaskStatus($event)"
          @filter-category="filterCategory($event)"
          @delete-task="deleteTask($event)"
          id="tasksDone"
          :class="{ active: tasksDoneVisibility }"
        />
        <TaskList
          :list-items="tasksTodo"
          @toggle-task-status="toggleTaskStatus($event)"
          @filter-category="filterCategory($event)"
          @delete-task="deleteTask($event)"
          id="tasksTodo"
        />
      </div>
      <button @click="this.writeCategoriesToTasks" class="btn btn-danger">
        action
      </button>
    </div>
  </div>
</template>

<script>
import Header from "../components/Header";
import FormAddTask from "../components/FormAddTask";
import TaskList from "../components/TaskList";

export default {
  name: "Home",
  components: {
    Header,
    FormAddTask,
    TaskList,
  },
  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/",
      loggedUser: {
        id: 1,
        name: "mihail",
      },
      tasks: [
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
      filteredTasks: [],
      categories: [
        {
          color: "",
          color_id: "",
          icon: "",
          icon_id: "",
          id: "",
          name: "",
        },
      ],
      icons: [
        {
          icon: "",
          id: "",
          name: "",
          rating: "",
          type: "",
        },
      ],
      colors: [
        {
          hex_color: "",
          id: "",
          name: "",
        },
      ],
      tasksDoneVisibility: false,
      // newIcons: [
      //   {
      //     name: "Home",
      //     icon: "home",
      //     type: "material-icons",
      //     rating: 5,
      //   },
      //   {
      //     name: "Settings",
      //     icon: "settings",
      //     type: "material-icons",
      //     rating: 1,
      //   },
      // ],
      // newColors: [
      //   {
      //     name: "Anything",
      //     hex_color: "#60C060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#60C090",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#60C0C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#6090C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#6060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#9060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C060C0",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C06090",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C06060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C09060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#C0C060",
      //   },
      //   {
      //     name: "Anything",
      //     hex_color: "#90C060",
      //   },
      // ],
      // newCategory: {
      //   name: "Test Category",
      //   user_id: "666",
      //   icon_id: "",
      //   color_id: "13",
      //   rating: 2,
      // },
    };
  },

  methods: {
    async postAjaxRequest(url, request, callback = this.doNothing) {
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

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    doNothing() {},

    addNewTask(event) {
      let newTask;
      if (this.loggedUser.id) {
        newTask = {
          login: this.loggedUser.name,
          user_id: this.loggedUser.id,
          task: event,
        };
        this.postAjaxRequest(
          this.url + "createtask.php",
          JSON.stringify(newTask),
          this.newTaskRecord
        );
      } else {
        newTask = {
          id: this.items.length + 1,
          task: event,
          completed: false,
          icon: "home",
        };
      }
    },

    newTaskRecord(response) {
      this.tasks.unshift(response.task);
      // this.tasksTodo.unshift(response.task);
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

    filterCategory(categoryId) {
      console.log("Фильтрация по категоии с id=", categoryId);
      if (this.filteredTasks.length === 0) {
        console.log("Добавление в массив фильтрации");
        this.filteredTasks = this.tasks.filter(
          (task) => task.category && task.category.id === categoryId
        );
        console.log(this.filteredTasks);
      } else {
        console.log("Очищаю массив фильтрации");
        this.filteredTasks = [];
      }
    },

    deleteTask(taskId) {
      console.log("Удаление задание c id=" + taskId);
      const task = { id: taskId };
      this.postAjaxRequest(
        this.url + "deletetask.php",
        JSON.stringify(task),
        this.removeTaskFromList(taskId)
      );
      // this.tasks.splice(index, 1);
    },

    removeTaskFromList(id) {
      let tasks = this.tasks;
      this.tasks.forEach(function (task, index) {
        if (task.id === id) {
          tasks.splice(index, 1);
        }
      });
    },

    getTasks() {
      this.postAjaxRequest(
        this.url + "gettasks.php",
        JSON.stringify(this.loggedUser),
        this.tasksRecord
      );
      console.log("1.1");
    },

    tasksRecord(response) {
      this.tasks = response.tasks;
      this.logGroup("Записи авторизованного пользователя", response);
      console.log("1.2");
    },

    listsToggle() {
      this.tasksDoneVisibility = !this.tasksDoneVisibility;
      console.log(this.tasksDoneVisibility);
    },

    // addNewIcons() {
    //   this.postAjaxRequest(
    //     this.url + "createicons.php",
    //     JSON.stringify(this.newIcons),
    //     this.logGroup("Записываю иконки", this.icons)
    //   );
    // },

    createCategory() {
      this.postAjaxRequest(
        this.url + "createcategory.php",
        JSON.stringify(this.newCategory),
        this.logGroup("Записываю категорию", this.newCategory)
      );
    },

    // createNewColors() {
    //   this.postAjaxRequest(
    //     this.url + "createcolors.php",
    //     JSON.stringify(this.newColors),
    //     this.logGroup("Записываю иконки", this.newColors)
    //   );
    // },

    writeCategoriesToTasks() {
      this.postAjaxRequest(
        this.url + "assigncategoriestotasks.php",
        JSON.stringify({}),
        this.logGroup("Присвоение категорий существующим заданиям", this.tasks)
      );
    },

    databaseAction() {
      this.postAjaxRequest(
        this.url + " ",
        JSON.stringify(this.newColors),
        this.logGroup("Записываю иконки", this.newColors)
      );
    },

    getCategories() {
      this.postAjaxRequest(
        this.url + "getcategories.php",
        JSON.stringify(this.loggedUser),
        this.categoriesRecord
      );
      console.log("2.1");
    },

    categoriesRecord(response) {
      this.categories = response.categories;
      this.logGroup("Список категорий", response);
      console.log("2.2");
    },

    getIcons() {
      this.postAjaxRequest(
        this.url + "geticons.php",
        JSON.stringify({}),
        this.iconsRecord
      );
      console.log("3.1");
    },

    iconsRecord(response) {
      this.icons = response.icons;
      this.logGroup("Список иконок", response);
      console.log("3.2");
    },

    getColors() {
      this.postAjaxRequest(
        this.url + "getcolors.php",
        JSON.stringify({}),
        this.colorsRecord
      );
      console.log("4.1");
    },

    colorsRecord(response) {
      this.colors = response.colors;
      this.logGroup("Список цветов", response);
      console.log("4.2");
    },

    assignIconsToCategories() {
      this.logGroup("Категории до присвоения иконок", this.categories);
      let categories = this.categories;
      let icons = this.icons;
      categories.forEach(function (category) {
        icons.forEach(function (icon) {
          if (category.icon_id === icon.id) {
            category.icon = icon.icon;
          }
        });
      });
      console.log("5.1");
      this.logGroup("Категории после присвоения иконок", this.categories);
    },

    assignColorsToCategories() {
      this.logGroup("Категории до присвоения цветов", this.categories);
      let categories = this.categories;
      let colors = this.colors;
      categories.forEach(function (category) {
        colors.forEach(function (color) {
          if (category.color_id === color.id) {
            category.color = color.hex_color;
          }
        });
      });
      console.log("6.1");
      this.logGroup("Категории после присвоения цветов", this.categories);
    },

    assignCategoriesToTasks() {
      let tasks = this.tasks;
      let categories = this.categories;
      tasks.forEach(function (task) {
        categories.forEach(function (category) {
          if (task.categoryId === category.id) {
            task.category = category;
          }
        });
      });
      console.log("7.1");
    },

    delay1() {
      return new Promise((resolve) =>
        setTimeout(() => {
          this.assignIconsToCategories();
          this.assignColorsToCategories();
          console.log("Промис 1 выполнен");
          resolve();
        }, 2000)
      );
    },

    delay2() {
      return new Promise((resolve) =>
        setTimeout(() => {
          this.assignCategoriesToTasks();
          console.log("Промис 2 выполнен");
          console.log(this.tasks);
          resolve();
        }, 1000)
      );
    },
  },

  computed: {
    tasksTodo: function () {
      const tasks =
        this.filteredTasks.length > 0 ? this.filteredTasks : this.tasks;
      let tasksWithIndexes = tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let todo = tasksWithIndexes.filter((task) => !!+task.done === false);
      this.logGroup("Невыполненные", todo);
      return todo;
    },
    tasksDone: function () {
      const tasks =
        this.filteredTasks.length > 0 ? this.filteredTasks : this.tasks;
      let tasksWithIndexes = tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let done = tasksWithIndexes.filter((task) => !!+task.done === true);
      this.logGroup("Выполненные", done);
      return done;
    },
  },

  updated() {
    console.log("Страница Home обновлена");
    this.logGroup("Задания при обновлении страницы", this.tasks);
  },

  mounted: async function () {
    console.log("Начало монтажа страницы Home");
    this.logGroup("Задания при монтировании страницы", this.tasks);
    this.getTasks();
    this.getCategories();
    this.getIcons();
    this.getColors();
    await this.delay1();
    await this.delay2();
    console.log("Окончание монтажа страницы Home");
    this.logGroup("Задания при монтировании страницы", this.tasks);
  },
};
</script>
