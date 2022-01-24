<template>
  <div>
    <Header @lists-toggle="listsToggle" />
    <div class="container">
      <FormAddTask @add-new-task="addNewTask($event)" />
      <div id="tasks">
        <TaskList
          :list-items="tasksDone"
          @toggle-task-status="toggleTaskStatus($event)"
          @filter-task="filterCategory"
          @delete-task="deleteTask($event)"
          id="tasksDone"
          :class="{ active: tasksDoneVisibility }"
        />
        <TaskList
          :list-items="tasksTodo"
          @toggle-task-status="toggleTaskStatus($event)"
          @filter-task="filterCategory"
          @delete-task="deleteTask($event)"
          id="tasksTodo"
        />
      </div>
    </div>

    <SignInFormModal
      @sign-in="signIn($event)"
      :back-end-sign-in-login-error="errors.signIn.login.errorText"
      :back-end-sign-in-password-error="errors.signIn.password.errorText"
    />
    <SignUpFormModal
      @sign-up="signUp($event)"
      :back-end-sign-up-login-error="errors.signIn.login.errorText"
    />

    <ColorScheme />
  </div>
</template>

<script>
import Header from "../components/Header";
import FormAddTask from "../components/FormAddTask";
import TaskList from "../components/TaskList";
import SignInFormModal from "../components/SignInFormModal";
import SignUpFormModal from "../components/SignUpFormModal";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "Home",
  components: {
    Header,
    FormAddTask,
    TaskList,
    SignInFormModal,
    SignUpFormModal,
    ColorScheme,
  },
  data() {
    return {
      loggedUser: {
        id: 1,
        name: "mihail",
      },
      errors: {
        signIn: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
          password: {
            id: "",
            type: "",
            errorText: "",
          },
        },
        signUp: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
        },
      },
      tasks: [
        { id: 1, task: "Построить дом", completed: false, icon: "stars" },
        { id: 2, task: "Посадить дерево", completed: true, icon: "favorite" },
        { id: 3, task: "Вырастить сына", completed: false, icon: "home" },
      ],
      tasksDoneVisibility: false,
    };
  },

  methods: {
    addNewTask(event) {
      let newTask;
      if (this.loggedUser.id) {
        newTask = {
          login: this.loggedUser.name,
          user_id: this.loggedUser.id,
          task: event,
        };
        this.postAjaxRequest(
          "https://www.d-skills.ru/45_lifeplan/php/createtask.php",
          // "php/createtask.php",
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
        this.items.unshift(newTask);
      }
    },

    newTaskRecord(response) {
      this.tasks.unshift(response.task);
      this.tasksTodo.unshift(response.task);
    },

    toggleTaskStatus(task) {
      console.log("Изменение задания");
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/toggletaskstatus.php",
        // "php/toggletaskstatus.php",
        JSON.stringify(task)
      );
      console.log("Статус - " + task.done);
      console.log(typeof task.done);
      task.done === "1" ? (task.done = "0") : (task.done = "1");
      console.log("Статус - " + task.done);
    },
    doNothing() {},
    filterCategory() {},
    deleteTask(index) {
      console.log("Удаляю задание" + index);
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/deletetask.php",
        // "php/deletetask.php",
        JSON.stringify(this.tasks[index]),
      );
      this.tasks.splice(index, 1);
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

    signIn(user) {
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/signin.php",
        // "php/signin.php",
        JSON.stringify(user),
        this.signInResponseParsing
      );
    },

    signInResponseParsing(response) {
      if (response.error) {
        this.signInErrorRecord(response.error);
      }
      if (response.user) {
        this.authUser(response.user);
      }
    },

    signInErrorRecord(error) {
      if (error.type === "login") {
        this.errors.signIn.login = error;
        this.errors.signIn.password = {};
      }
      if (error.type === "password") {
        this.errors.signIn.password = error;
        this.errors.signIn.login = {};
      }
      this.logGroup("Записана ошибка", error);
    },

    authUser(user) {
      this.errors = {
        signIn: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
          password: {
            id: "",
            type: "",
            errorText: "",
          },
        },
        signUp: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
        },
      };
      this.loggedUser = user;
      this.logGroup(
        "Пользователь авторизован",
        "user.id = " + user.id,
        "user.name = " + user.name
      );
    },

    signUp(user) {
      console.log("в отправке");
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/signup.php",
        // "php/signup.php",
        JSON.stringify(user),
        this.signUpResponseParsing
      );
    },

    signUpResponseParsing(response) {
      if (response.error) {
        this.signUpErrorRecord(response.error);
      }
      if (response.user) {
        this.registerUser(response.user);
      }
    },

    signUpErrorRecord(error) {
      if (error.type === "login") {
        this.errors.signUp.login = error;
      }
      this.logGroup("Записана ошибка", error);
    },

    registerUser(user) {
      this.errors = {
        signIn: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
          password: {
            id: "",
            type: "",
            errorText: "",
          },
        },
        signUp: {
          login: {
            id: "",
            type: "",
            errorText: "",
          },
        },
      };
      this.loggedUser = user;
      this.logGroup(
        "Пользователь зарегистрирован и авторизован",
        "user.id = " + user.id,
        "user.name = " + user.name
      );
    },

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    getTasks() {
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/gettasks.php",
        // "php/gettasks.php",
        JSON.stringify(this.loggedUser),
        this.tasksRecord
      );
    },

    tasksRecord(response) {
      this.tasks = response.tasks;
      this.logGroup("Записи авторизованного пользователя", response);
    },

    listsToggle() {
      this.tasksDoneVisibility = !this.tasksDoneVisibility;
      console.log(this.tasksDoneVisibility);
    },
  },

  computed: {
    tasksTodo: function () {
      let tasksWithIndexes = this.tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let todo = tasksWithIndexes.filter((task) => !!+task.done === false);
      this.logGroup("Невыполненные", todo);
      return todo;
    },
    tasksDone: function () {
      let tasksWithIndexes = this.tasks.map(function (item, index) {
        item.index = index;
        return item;
      });
      let done = tasksWithIndexes.filter((task) => !!+task.done === true);
      this.logGroup("Выполненные", done);
      return done;
    },
  },

  mounted: function () {
    this.getTasks();
  },
};
</script>
