<template>
  <div>
    <Header />
    <div class="container">
      <FormAddTask @addNewTask="addNewTask($event)" />
      <TaskList :listItems="items" @toggleComplete="changeCompleted($event)" />
    </div>

    <SignInFormModal @sign-in="signIn($event)" />
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
      loggedUser: {},
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

    signIn(user) {
      this.postAjaxRequest(
        "https://www.d-skills.ru/45_lifeplan/php/signin.php",
        // "php/signin.php",
        JSON.stringify(user),
        "loggedUser",
        "Запрос авторизации"
      );
    },

    postAjaxRequest(url, request, responseTarget, logHeader) {
      const xhr = new XMLHttpRequest();
      console.log(request);
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          console.log(logHeader);
          console.log(xhr.response);
          this[responseTarget] = xhr.response;
        }
      };
      xhr.open("POST", url, true);
      xhr.setRequestHeader("Content-type", "application/json");
      xhr.send(request);
    },

    // addFooterMenuItem() {
    // JSON.stringify(this.user)
    //   const request =
    //     "userLogin=" + this.inputLogin + "&userPassword=" + this.inputPassword;
    //   log = "Авторизован пользователь " + this.inputLogin;
    //   this.ajaxRequest("auth.php", request, "this.user", log);
    // },
  },
};
</script>
