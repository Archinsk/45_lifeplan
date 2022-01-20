<template>
  <div
    class="modal fade"
    id="signUpFormModal"
    aria-hidden="true"
    aria-labelledby="signUpFormModalLabel"
    tabindex="-1"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signUpFormModalLabel">Регистрация</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form @submit.prevent="$emit('sign-up', user)">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                id="signUpLogin"
                placeholder="Введите логин"
                v-model="user.login"
              />
              <label for="signUpLogin">Логин</label>
            </div>
            <div v-if="backEndSignUpLoginError" class="form-text">
              {{ backEndSignUpLoginError }}
            </div>
            <div class="form-floating mb-3">
              <input
                type="password"
                class="form-control"
                id="signUpPassword"
                placeholder="Введите пароль"
                v-model="user.password"
              />
              <label for="signUpPassword">Пароль</label>
            </div>
            <div class="form-floating">
              <input
                type="password"
                class="form-control"
                id="signUpPasswordRepeat"
                placeholder="Пароль ещё раз"
                v-model="user.passwordRepeat"
              />
              <label for="signUpPasswordRepeat">Пароль ещё раз</label>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-outline-primary"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              Отмена
            </button>
            <button
              class="btn btn-outline-primary"
              data-bs-target="#signInFormModal"
              data-bs-toggle="modal"
            >
              Вход
            </button>
            <button type="submit" class="btn btn-primary">
              Отправить
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignUpFormModal",

  props: ["backEndSignUpLoginError"],

  data() {
    return {
      user: {
        login: "",
        password: "",
        passwordRepeat: "",
      },
    };
  },
};
</script>

<style scoped></style>
