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
        @sign-in-login-validation="signInLoginValidation(arguments)"
        @sign-in-password-validation="signInPasswordValidation(arguments)"
        @sign-in="signIn($event)"
      />
      <SignUpFormModal
        :sign-up-login-error="errors.signUp.login.errorText"
        :sign-up-password-error="errors.signUp.password.errorText"
        :sign-up-password-repeat-error="errors.signUp.passwordRepeat.errorText"
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
      serverErrors: {
        signIn: {
          login: [],
          password: [],
        },
        signUp: {
          login: [],
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
      const parser = this.signInResponseParsing;
      const callback = function (response) {
        return parser(response, user);
      };
      this.postAjaxRequest(
        this.url + "signin.php",
        JSON.stringify(user),
        callback
      );
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
      const parser = this.signUpResponseParsing;
      const callback = function (response) {
        return parser(response, user);
      };
      this.postAjaxRequest(
        this.url + "signup.php",
        JSON.stringify(user),
        callback
      );
    },

    signUpResponseParsing(response, user) {
      if (response.error) {
        this.signUpErrorRecord(response.error);
        this.serverErrors.signUp.login.push(user.login);
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
