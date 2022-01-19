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
        <form @submit.prevent="$emit('sign-in', user)">
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

<!--          <form action="https://www.d-skills.ru/45_lifeplan/php/signin.php" method="post">-->
<!--          <div class="modal-body">-->
<!--            <div class="form-floating mb-3">-->
<!--              <input-->
<!--                type="text"-->
<!--                class="form-control"-->
<!--                id="signInLogin2"-->
<!--                name="signInLogin2"-->
<!--                placeholder="Введите логин"-->
<!--                v-model="user.login"-->
<!--              />-->
<!--              <label for="signInLogin2">Логин</label>-->
<!--            </div>-->
<!--            <div class="form-floating">-->
<!--              <input-->
<!--                type="password"-->
<!--                class="form-control"-->
<!--                id="signInPassword2"-->
<!--                name="signInPassword2"-->
<!--                placeholder="Введите пароль"-->
<!--                v-model="user.password"-->
<!--              />-->
<!--              <label for="signInPassword2">Пароль</label>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div class="modal-footer">-->
<!--            <button-->
<!--              class="btn btn-outline-primary"-->
<!--              data-bs-target="#signUpFormModal"-->
<!--              data-bs-toggle="modal"-->
<!--            >-->
<!--              Регистрация-->
<!--            </button>-->
<!--            <button type="submit" class="btn btn-primary">Войти</button>-->
<!--          </div>-->
<!--        </form>-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignInFormModal",

  data() {
    return {
      user: {
        login: "",
        password: "",
      },
    };
  },
};
</script>

<style scoped></style>
