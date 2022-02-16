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
        :is-auth-user="isAuthUser"
        @sign-in-login-validation="signInLoginValidation(arguments)"
        @sign-in-password-validation="signInPasswordValidation(arguments)"
        @sign-in="signIn($event)"
      />
      <SignUpFormModal
        :sign-up-login-error="errors.signUp.login.errorText"
        :sign-up-password-error="errors.signUp.password.errorText"
        :sign-up-password-repeat-error="errors.signUp.passwordRepeat.errorText"
        :is-auth-user="isAuthUser"
        @sign-up-login-validation="signUpLoginValidation($event)"
        @sign-up-password-validation="signUpPasswordValidation(arguments)"
        @sign-up-password-repeat-validation="
          signUpPasswordRepeatValidation(arguments)
        "
        @sign-up="signUp($event)"
      />
    </div>
  </div>
</template>

<script>
import Header from "../components/Header";
import SignInFormModal from "../components/SignInFormModal";
import SignUpFormModal from "../components/SignUpFormModal";
import axios from "axios";
import { Modal } from "bootstrap";

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
        id: null,
        name: "",
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
      serverErrors: {
        signIn: {
          login: [],
          password: [],
        },
        signUp: {
          login: [],
        },
      },
      emptyError: {
        id: "",
        type: "",
        errorText: "",
      },
      signInModal: null,
      signUpModal: null,
    };
  },

  methods: {
    logGroup(logHeader, ...logs) {
      console.groupCollapsed(logHeader);
      for (let log of logs) console.log(log);
      console.groupEnd(logHeader);
    },

    doNothing() {},

    signInLoginValidation([login, password]) {
      if (!login) {
        this.errors.signIn.login = {
          id: "4",
          type: "login",
          errorText: "Введите логин",
        };
      } else {
        if (this.serverErrors.signIn.login.length > 0) {
          if (this.serverErrors.signIn.login.indexOf(login) >= 0) {
            console.log("Совпадение найдено");
            this.errors.signIn.login = {
              id: "1",
              type: "login",
              errorText: "Пользователь не зарегистрирован!",
            };
          } else {
            this.errors.signIn.login = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signIn.login.errorText) {
          this.errors.signIn.login = {
            id: "",
            type: "",
            errorText: "",
          };
        }
        if (this.errors.signIn.password.errorText || password) {
          this.signInPasswordValidation([login, password]);
        }
      }
    },

    signInPasswordValidation([login, password]) {
      if (!password) {
        this.errors.signIn.password = {
          id: "5",
          type: "password",
          errorText: "Введите пароль",
        };
      } else {
        if (this.serverErrors.signIn.password.length > 0) {
          if (
            this.serverErrors.signIn.password.find(
              (user) => user.login === login && user.password === password
            )
          ) {
            console.log("Совпадение найдено");
            this.errors.signIn.password = {
              id: "2",
              type: "password",
              errorText: "Неверно введен пароль!",
            };
          } else {
            this.errors.signIn.password = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signIn.password.errorText) {
          this.errors.signIn.password = {
            id: "",
            type: "",
            errorText: "",
          };
        }
      }
    },

    signUpLoginValidation(login) {
      if (!login) {
        this.errors.signUp.login = {
          id: "6",
          type: "login",
          errorText: "Введите логин",
        };
      } else {
        if (this.serverErrors.signUp.login.length > 0) {
          if (this.serverErrors.signUp.login.indexOf(login) >= 0) {
            console.log("Совпадение найдено");
            this.errors.signUp.login = {
              id: "3",
              type: "login",
              errorText: "Логин уже занят",
            };
          } else {
            this.errors.signUp.login = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        } else if (this.errors.signUp.login.errorText) {
          this.errors.signUp.login = {
            id: "",
            type: "",
            errorText: "",
          };
        }
      }
    },

    signUpPasswordValidation([password, passwordRepeat]) {
      if (!password) {
        this.errors.signUp.password = {
          id: "7",
          type: "password",
          errorText: "Введите пароль",
        };
      } else {
        if (this.errors.signUp.password.errorText) {
          this.errors.signUp.password = {
            id: "",
            type: "",
            errorText: "",
          };
        }
        if (this.errors.signUp.passwordRepeat.errorText || passwordRepeat) {
          this.signUpPasswordRepeatValidation([password, passwordRepeat]);
        }
      }
    },

    signUpPasswordRepeatValidation([password, passwordRepeat]) {
      if (!passwordRepeat) {
        this.errors.signUp.passwordRepeat = {
          id: "8",
          type: "passwordRepeat",
          errorText: "Введите пароль ещё раз",
        };
      } else {
        if (!password) {
          this.signUpPasswordValidation([password, passwordRepeat]);
        } else {
          if (passwordRepeat !== password) {
            this.errors.signUp.passwordRepeat = {
              id: "9",
              type: "passwordRepeat",
              errorText: "Повтор не совпадает с паролем",
            };
          } else if (this.errors.signUp.passwordRepeat.errorText) {
            this.errors.signUp.passwordRepeat = {
              id: "",
              type: "",
              errorText: "",
            };
          }
        }
      }
    },

    signIn(user) {
      axios
        .post(this.url + "signin.php", JSON.stringify(user))
        .then((response) => {
          this.signInResponseParsing(response.data, user);
        });
    },

    signInResponseParsing(response, user) {
      if (response.error) {
        this.signInErrorRecord(response.error, user);
      }
      if (response.user) {
        this.authUser(response.user);
      }
    },

    signInErrorRecord(error, user) {
      if (error.type === "login") {
        this.errors.signIn.login = error;
        this.errors.signIn.password = {};
        this.serverErrors.signIn.login.push(user.login);
      }
      if (error.type === "password") {
        this.errors.signIn.password = error;
        this.errors.signIn.login = {};
        let errorPasswordUser = {
          login: user.login,
          password: user.password,
        };
        this.serverErrors.signIn.password.push(errorPasswordUser);
      }
      this.logGroup("Записана ошибка", error);
    },

    authUser(user) {
      this.errorsReset();
      this.loggedUser = user;
      this.logGroup(
        "Пользователь авторизован",
        "user.id = " + user.id,
        "user.name = " + user.name
      );
      this.signInModal.hide();
      this.signUpModal.hide();
      this.$emit("auth-user", user);
    },

    signUp(user) {
      axios
        .post(this.url + "signup.php", JSON.stringify(user))
        .then((response) => {
          this.signUpResponseParsing(response.data, user);
        });
    },

    signUpResponseParsing(response, user) {
      if (response.error) {
        this.signUpErrorRecord(response.error);
        this.serverErrors.signUp.login.push(user.login);
      }
      if (response.user) {
        this.authUser(response.user);
      }
    },

    signUpErrorRecord(error) {
      if (error.type === "login") {
        this.errors.signUp.login = error;
      }
      this.logGroup("Записана ошибка", error);
    },

    errorsReset() {
      this.errors.signIn.login = this.emptyError;
      this.errors.signIn.password = this.emptyError;
      this.errors.signUp.login = this.emptyError;
      this.errors.signUp.password = this.emptyError;
      this.errors.signUp.passwordRepeat = this.emptyError;
      this.serverErrors.signIn.login = [];
      this.serverErrors.signIn.password = [];
      this.serverErrors.signUp.login = [];
    },
  },

  computed: {
    isAuthUser: function () {
      return !!this.loggedUser.id;
    },
  },

  mounted() {
    this.signInModal = new Modal(this.$children[1].$refs.signInFormModal);
    this.signUpModal = new Modal(this.$children[2].$refs.signUpFormModal);
    console.log(this);
    console.log(this.$children[2].$refs.signUpFormModal);
  },
};
</script>

<style scoped></style>
