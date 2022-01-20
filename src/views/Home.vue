<template>
  <div>
    <Header />
    <div class="container">
      <FormAddTask @addNewTask="addNewTask($event)" />
      <TaskList :listItems="items" @toggleComplete="changeCompleted($event)" />
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
      items: [
        { id: 1, task: "Построить дом", completed: false, icon: "stars" },
        { id: 2, task: "Посадить дерево", completed: true, icon: "favorite" },
        { id: 3, task: "Вырастить сына", completed: false, icon: "home" },
      ],
      loggedUser: {},
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
  },
};
</script>
