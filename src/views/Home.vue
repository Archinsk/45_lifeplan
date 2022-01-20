<template>
  <div>
    <Header />
    <div class="container">
      <FormAddTask @addNewTask="addNewTask($event)" />
      <TaskList :listItems="items" @toggleComplete="changeCompleted($event)" />
    </div>

    <SignInFormModal @sign-in="signIn($event)" :was-validated="wasValidated" :back-end-errors="errors.signIn" />
    <SignUpFormModal />

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
      items: [
        { id: 1, task: "Построить дом", completed: false, icon: "stars" },
        { id: 2, task: "Посадить дерево", completed: true, icon: "favorite" },
        { id: 3, task: "Вырастить сына", completed: false, icon: "home" },
      ],
      wasValidated: false,
      loggedUser: {},
      errors: {
        signIn: {},
        signUp: {},
      },
    };
  },
  methods: {
    addNewTask(event) {
      let newTask = {
        id: this.items.length + 1,
        task: event,
        completed: false,
        icon: "home",
      };
      this.items.push(newTask);
    },
    changeCompleted(id) {
      this.items = this.items.map(function (item) {
        if (item.id === id) {
          item.completed = !item.completed;
        }
        return item;
      });
    },

    postAjaxRequest(url, request, callback) {
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
      this.wasValidated = true;
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
      this.errors = {};
      this.loggedUser = user;
      this.logGroup(
        "Пользователь авторизован",
        "user.id = " + user.id,
        "user.name = " + user.name
      );
    },

    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },
  },
};
</script>
