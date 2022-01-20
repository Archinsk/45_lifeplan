<template>
  <div
    class="modal fade"
    id="signInFormModal"
    aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel"
    tabindex="-1"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signInFormModalLabel">Вход</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form
          :class="{ 'was-validated': wasValidated }"
          @submit.prevent="$emit('sign-in', user)"
        >
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                id="signInLogin"
                placeholder="Введите логин"
                v-model="user.login"
              />
              <label for="signInLogin">Логин</label>
              <div v-if="backEndErrors.login" class="form-text">
                {{ backEndErrors.login.errorText }}
              </div>
            </div>
            <div class="form-floating">
              <input
                type="password"
                class="form-control"
                id="signInPassword"
                placeholder="Введите пароль"
                v-model="user.password"
              />
              <label for="signInPassword">Пароль</label>
              <div v-if="backEndErrors.password" class="form-text">
                {{ backEndErrors.password.errorText }}
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              class="btn btn-outline-primary"
              data-bs-target="#signUpFormModal"
              data-bs-toggle="modal"
            >
              Регистрация
            </button>
            <button type="submit" class="btn btn-primary">Войти</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignInFormModal",

  props: ["backEndErrors", "wasValidated"],

  data() {
    return {
      user: {
        login: "",
        password: "",
      },
      // isInvalidLogin: false,
      // isInvalidPassword: false,
    };
  },

  // watch: {
  //   // при каждом изменении `question` эта функция будет запускаться
  //   backEndErrors: function() {
  //     console.log("Я слежу")
  //     if (this.wasValidated) {
  //       if (this.backEndErrors.login) {
  //         this.isInvalidLogin = true;
  //         this.isInvalidPassword = false;
  //       }
  //       if (this.backEndErrors.password) {
  //         this.isInvalidLogin = false;
  //         this.isInvalidPassword = true;
  //       }
  //     }
  //   },
  // },

  // computed: {
  //   isInvalidLogin: function () {
  //     console.log("Я слежу");
  //     if (this.wasValidated) {
  //       return !!this.backEndErrors.login;
  //     }
  //     return false;
  //   },
  //   isInvalidPassword: function () {
  //     console.log("Я слежу");
  //     if (this.wasValidated) {
  //       return !!this.backEndErrors.password;
  //     }
  //     return false;
  //   },
  // },
};
</script>

<style scoped></style>
