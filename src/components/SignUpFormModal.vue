<template>
  <div
    class="modal fade"
    id="signUpFormModal"
    aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1"
  >
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="signUpFormModalLabel2">Регистрация</h5>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <form @submit.prevent>
          <div class="modal-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="signUpLogin" placeholder="Логин"/>
              <label for="signUpLogin">Логин</label>
            </div>
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="signUpPassword" placeholder="Пароль"/>
              <label for="signUpPassword">Пароль</label>
            </div>
            <div class="form-floating">
              <input type="password" class="form-control" id="signUpPassword" placeholder="Пароль ещё раз"/>
              <label for="signUpPassword">Пароль ещё раз</label>
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
            <button type="submit" class="btn btn-primary">Авторизация</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SignUpFormModal",
};
</script>

<style scoped></style>
