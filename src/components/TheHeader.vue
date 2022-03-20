<template>
  <header :class="'header bg-' + theme.primary">
    <nav class="navbar navbar-expand-xl navbar-dark">
      <div class="container">
        <img
          id="logo"
          :class="'navbar-brand text-' + lightnessMode + '-neutral-900'"
          src="@/assets/lifeplan_logo.svg"
          alt="Life Plan Logo"
          @click="$emit('lists-toggle')"
        />
        <TheHeaderButton
          icon="menu"
          :class="'d-xl-none text-' + lightnessMode + '-neutral-900'"
          data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasNavbar"
          aria-controls="offcanvasNavbar"
        />
        <div
          :class="'offcanvas offcanvas-end bg-' + theme.primary"
          tabindex="-1"
          id="offcanvasNavbar"
          ref="offcanvas"
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
              <li class="nav-item" @click="offcanvasHide">
                <router-link to="/" class="nav-link d-flex align-items-center">
                  <span class="material-icons"> check_circle </span>
                  Задания
                </router-link>
              </li>
              <li class="nav-item" @click="offcanvasHide">
                <router-link
                  to="/categories"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> category </span>
                  Категории
                </router-link>
              </li>
              <li class="nav-item" @click="offcanvasHide">
                <router-link
                  to="/themes"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> brush </span>
                  Темы
                </router-link>
              </li>
              <li class="nav-item" @click="offcanvasHide">
                <router-link
                  to="/statistics"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> leaderboard </span>
                  Статистика
                </router-link>
              </li>
              <li class="nav-item" @click="offcanvasHide">
                <router-link
                  to="/settings"
                  class="nav-link d-flex align-items-center"
                >
                  <span class="material-icons"> settings </span>
                  Настройки
                </router-link>
              </li>
              <li class="nav-item" @click="offcanvasHide">
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
import TheHeaderButton from "@/components/TheHeaderButton";
import { Offcanvas } from "bootstrap";

export default {
  name: "TheHeader",

  components: {
    TheHeaderButton,
  },

  props: ["theme", "lightnessMode"],

  data() {
    return {
      offcanvasModal: null,
    };
  },

  methods: {
    offcanvasHide() {
      this.offcanvasModal.hide();
    },
  },

  mounted() {
    this.offcanvasModal = new Offcanvas(this.$refs.offcanvas);
  },
};
</script>
