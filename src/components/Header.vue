<template>
  <header class="header bg-primary">
    <nav class="navbar navbar-expand-xl navbar-dark">
      <div class="container">
        <img
          id="logo"
          class="navbar-brand"
          src="@/assets/lifeplan_logo.svg"
          alt="Life Plan Logo"
          @click="$emit('lists-toggle')"
        />
        <HeaderButton
          icon="menu"
          class="d-xl-none"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
        />
        <div
          class="offcanvas offcanvas-end bg-primary"
          tabindex="-1"
          id="offcanvasNavbar"
          aria-labelledby="offcanvasNavbarLabel"
        >
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Меню</h5>
            <button
              type="button"
              class="btn-close text-reset"
              data-bs-dismiss="offcanvas"
              aria-label="Close"
            ></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1">
              <li class="nav-item">
                <router-link to="/" class="nav-link d-flex align-items-center">
                  <span class="material-icons"> check_circle </span>
                  Задания
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/categories_settings"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> category </span>
                  Категории
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/themes_settings"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> brush </span>
                  Темы
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/statistics"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> leaderboard </span>
                  Статистика
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/settings"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> settings </span>
                  Настройки
                </router-link>
              </li>
              <li class="nav-item">
                <router-link
                  to="/help"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> help </span>
                  Помощь
                </router-link>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>

<script>
import HeaderButton from "@/components/HeaderButton";

export default {
  name: "Header",

  components: {
    HeaderButton,
  },
};
</script>
