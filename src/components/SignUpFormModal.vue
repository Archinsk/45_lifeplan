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
                v-model.trim="user.login"
                @blur="$emit('sign-up-login-validation', user.login)"
                @input="$emit('sign-up-login-oninput', user.login)"
              />
              <label for="signUpLogin">Логин</label>
              <div v-if="signUpLoginError" class="form-text">
                {{ signUpLoginError }}
              </div>
            </div>
            <div class="form-floating mb-3">
              <input
                type="password"
                class="form-control"
                id="signUpPassword"
                placeholder="Введите пароль"
                v-model.trim="user.password"
                @blur="$emit('sign-up-password-validation', user.password)"
                @input="$emit('sign-up-password-oninput', user.password)"
              />
              <label for="signUpPassword">Пароль</label>
              <div v-if="signUpPasswordError" class="form-text">
                {{ signUpPasswordError }}
              </div>
            </div>
            <div class="form-floating">
              <input
                type="password"
                class="form-control"
                id="signUpPasswordRepeat"
                placeholder="Пароль ещё раз"
                v-model.trim="user.passwordRepeat"
                @blur="$emit('sign-up-password-repeat-validation', user.passwordRepeat)"
                @input="$emit('sign-up-password-repeat-oninput', user.passwordRepeat)"
              />
              <label for="signUpPasswordRepeat">Пароль ещё раз</label>
              <div v-if="signUpPasswordRepeatError" class="form-text">
                {{ signUpPasswordRepeatError }}
              </div>
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
            <button type="submit" class="btn btn-primary">Отправить</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignUpFormModal",

  props: ["signUpLoginError", "signUpPasswordError", "signUpPasswordRepeatError"],

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
