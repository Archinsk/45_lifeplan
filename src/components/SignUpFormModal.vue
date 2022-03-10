<template>
  <div
    class="modal fade"
    id="signUpFormModal"
    ref="signUpFormModal"
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
                @input="$emit('sign-up-login-validation', user.login)"
              />
              <label for="signUpLogin">Логин</label>
              <div v-if="signUpLoginError" class="form-text">
                {{ signUpLoginError }}
              </div>
            </div>
            <div class="form-floating input-group">
              <input
                :type="passwordHidden ? 'password' : 'text'"
                class="form-control"
                id="signUpPassword"
                placeholder="Введите пароль"
                v-model.trim="user.password"
                @blur="
                  $emit(
                    'sign-up-password-validation',
                    user.password,
                    user.passwordRepeat
                  )
                "
                @input="
                  $emit(
                    'sign-up-password-validation',
                    user.password,
                    user.passwordRepeat
                  )
                "
              />
              <label for="signUpPassword">Пароль</label>
              <button
                class="btn btn-outline-secondary"
                type="button"
                @click="togglePasswordVisibility"
              >
                <span class="material-icons">
                  {{ passwordHidden ? "visibility_off" : "visibility" }}
                </span>
              </button>
            </div>
            <div v-if="signUpPasswordError" class="form-text">
              {{ signUpPasswordError }}
            </div>
            <div class="form-floating input-group mt-3">
              <input
                :type="passwordRepeatHidden ? 'password' : 'text'"
                class="form-control"
                id="signUpPasswordRepeat"
                placeholder="Пароль ещё раз"
                v-model.trim="user.passwordRepeat"
                @blur="
                  $emit(
                    'sign-up-password-repeat-validation',
                    user.password,
                    user.passwordRepeat
                  )
                "
                @input="
                  $emit(
                    'sign-up-password-repeat-validation',
                    user.password,
                    user.passwordRepeat
                  )
                "
              />
              <label for="signUpPasswordRepeat">Пароль ещё раз</label>
              <button
                class="btn btn-outline-secondary"
                type="button"
                @click="togglePasswordRepeatVisibility"
              >
                <span class="material-icons">
                  {{ passwordRepeatHidden ? "visibility_off" : "visibility" }}
                </span>
              </button>
            </div>
            <div v-if="signUpPasswordRepeatError" class="form-text">
              {{ signUpPasswordRepeatError }}
            </div>
            <p>
              Уже зарегистрированы?
              <a
                role="button"
                data-bs-target="#signInFormModal"
                data-bs-toggle="modal"
              >
                Войти
              </a>
            </p>
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
              type="submit"
              class="btn btn-primary"
              :class="{ disabled: !isValidForm }"
            >
              Зарегистрироваться
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

  props: [
    "signUpLoginError",
    "signUpPasswordError",
    "signUpPasswordRepeatError",
    "isAuthUser",
  ],

  data() {
    return {
      user: {
        login: "",
        password: "",
        passwordRepeat: "",
      },
      passwordHidden: true,
      passwordRepeatHidden: true,
    };
  },

  methods: {
    togglePasswordVisibility() {
      this.passwordHidden = !this.passwordHidden;
    },
    togglePasswordRepeatVisibility() {
      this.passwordRepeatHidden = !this.passwordRepeatHidden;
    },
  },

  computed: {
    isValidForm() {
      return (
        !this.signUpLoginError &&
        this.user.login &&
        !this.signUpPasswordError &&
        this.user.password &&
        !this.signUpPasswordRepeatError &&
        this.user.passwordRepeat
      );
    },
  },

  watch: {
    isAuthUser() {
      if (this.isAuthUser) {
        this.user = {
          login: "",
          password: "",
          passwordRepeat: "",
        };
      }
    },
  },
};
</script>

<style scoped></style>
