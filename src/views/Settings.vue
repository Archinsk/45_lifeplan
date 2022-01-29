<template>
  <div>
    <Header />
    <div class="container">
      <h4>Настройки</h4>
      <button
        class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#signInFormModal"
      >
        Войти
      </button>

      <SignInFormModal
        :sign-in-login-error="errors.signIn.login.errorText"
        :sign-in-password-error="errors.signIn.password.errorText"
        @sign-in-login-validation="signInLoginValidation($event)"
        @sign-in-login-oninput="signInLoginOninput($event)"
        @sign-in-password-validation="signInPasswordValidation($event)"
        @sign-in-password-oninput="signInPasswordOninput($event)"
        @sign-in="signIn($event)"
      />
      <SignUpFormModal
        :sign-up-login-error="errors.signUp.login.errorText"
        :sign-up-password-error="errors.signUp.password.errorText"
        :sign-up-password-repeat-error="errors.signUp.passwordRepeat.errorText"
        @sign-up-login-validation="signUpLoginValidation($event)"
        @sign-up-login-oninput="signUpLoginOninput($event)"
        @sign-up-password-validation="signUpPasswordValidation($event)"
        @sign-up-password-oninput="signUpPasswordOninput($event)"
        @sign-up-password-repeat-validation="
          signUpPasswordRepeatValidation($event)
        "
        @sign-up-password-repeat-oninput="signUpPasswordRepeatOninput($event)"
        @sign-up="signUp($event)"
      />
    </div>
  </div>
</template>

<script>
import Header from "../components/Header";
import SignInFormModal from "../components/SignInFormModal";
import SignUpFormModal from "../components/SignUpFormModal";

export default {
  name: "Settings",

  components: {
    Header,
    SignInFormModal,
    SignUpFormModal,
  },

  data() {
    return {
      url: "https://www.d-skills.ru/45_lifeplan/php/",
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
          password: {
            id: "",
            type: "",
            errorText: "",
          },
          passwordRepeat: {
            id: "",
            type: "",
            errorText: "",
          },
        },
      },
    };
  },

  methods: {
    async postAjaxRequest(url, request, callback = this.doNothing) {
      const xhr = new XMLHttpRequest();
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

    signInLoginValidation(login) {
      if (!login) {
        this.errors.signIn.login = {
          id: "4",
          type: "login",
          errorText: "Введите логин",
        };
      }
    },

    signInLoginOninput(login) {
      if (login && this.errors.signIn.login.errorText) {
        this.errors.signIn.login = {
          id: "",
          type: "",
          errorText: "",
        };
      }
    },

    signInPasswordValidation(password) {
      if (!password) {
        this.errors.signIn.password = {
          id: "5",
          type: "password",
          errorText: "Введите пароль",
        };
      }
    },

    signInPasswordOninput(password) {
      if (password && this.errors.signIn.password.errorText) {
        this.errors.signIn.password = {
          id: "",
          type: "",
          errorText: "",
        };
      }
    },

    signUpLoginValidation(login) {
      if (!login) {
        this.errors.signUp.login = {
          id: "6",
          type: "login",
          errorText: "Введите логин",
        };
      }
    },

    signUpLoginOninput(login) {
      if (login && this.errors.signUp.login.errorText) {
        this.errors.signUp.login = {
          id: "",
          type: "",
          errorText: "",
        };
      }
    },

    signUpPasswordValidation(password) {
      if (!password) {
        this.errors.signUp.password = {
          id: "7",
          type: "password",
          errorText: "Введите пароль",
        };
      }
    },

    signUpPasswordOninput(password) {
      if (password && this.errors.signUp.password.errorText) {
        this.errors.signUp.password = {
          id: "",
          type: "",
          errorText: "",
        };
      }
    },

    signUpPasswordRepeatValidation(passwordRepeat) {
      if (!passwordRepeat) {
        this.errors.signUp.passwordRepeat = {
          id: "8",
          type: "login",
          errorText: "Введите пароль ещё раз",
        };
      }
    },

    signUpPasswordRepeatOninput(passwordRepeat) {
      if (passwordRepeat && this.errors.signUp.passwordRepeat.errorText) {
        this.errors.signUp.passwordRepeat = {
          id: "",
          type: "",
          errorText: "",
        };
      }
    },

    signIn(user) {
      this.postAjaxRequest(
        this.url + "signin.php",
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
        this.url + "signup.php",
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
  },
};
</script>

<style scoped></style>
