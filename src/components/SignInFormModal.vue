<template>
  <div
    class="modal fade"
    id="signInFormModal"
    ref="signInFormModal"
    aria-hidden="true"
    aria-labelledby="signInFormModalLabel"
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
        <form @submit.prevent="$emit('sign-in', user)">
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input
                type="text"
                class="form-control"
                id="signInLogin"
                placeholder="Введите логин"
                v-model.trim="user.login"
                @blur="
                  $emit('sign-in-login-validation', user.login, user.password)
                "
                @input="
                  $emit('sign-in-login-validation', user.login, user.password)
                "
              />
              <label for="signInLogin">Логин</label>
              <div v-if="signInLoginError" class="form-text">
                {{ signInLoginError }}
              </div>
            </div>
            <div class="form-floating input-group">
              <input
                :type="passwordHidden ? 'password' : 'text'"
                class="form-control"
                id="signInPassword"
                placeholder="Введите пароль"
                v-model.trim="user.password"
                @blur="
                  $emit(
                    'sign-in-password-validation',
                    user.login,
                    user.password
                  )
                "
                @input="
                  $emit(
                    'sign-in-password-validation',
                    user.login,
                    user.password
                  )
                "
              />
              <label for="signInPassword">Пароль</label>
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
            <div v-if="signInPasswordError" class="form-text">
              {{ signInPasswordError }}
            </div>
            <p>
              Ещё нет учетной записи?
              <a
                role="button"
                data-bs-target="#signUpFormModal"
                data-bs-toggle="modal"
              >
                Зарегистрироваться
              </a>
            </p>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              :class="'btn btn-outline-' + theme.primary"
              data-bs-dismiss="modal"
              aria-label="Close"
            >
              Отмена
            </button>
            <button
              type="submit"
              :class="
                'btn btn-' + theme.primary + ' ' + { disabled: !isValidForm }
              "
            >
              <!--              :class="{ disabled: !isValidForm }"-->
              Войти
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignInFormModal",

  props: ["signInLoginError", "signInPasswordError", "isAuthUser", "theme"],

  data() {
    return {
      user: {
        login: "",
        password: "",
      },
      passwordHidden: true,
    };
  },

  methods: {
    togglePasswordVisibility() {
      this.passwordHidden = !this.passwordHidden;
    },
  },

  computed: {
    isValidForm() {
      return (
        !this.signInLoginError &&
        this.user.login &&
        !this.signInPasswordError &&
        this.user.password
      );
    },
  },

  watch: {
    isAuthUser() {
      if (this.isAuthUser) {
        this.user = {
          login: "",
          password: "",
        };
      }
    },
  },
};
</script>

<style scoped></style>
