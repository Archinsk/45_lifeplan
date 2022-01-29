<template>
  <header class="header bg-primary">
    <nav class="navbar navbar-dark">
      <div class="container">
        <img
          id="logo"
          class="navbar-brand"
          src="@/assets/lifeplan_logo.svg"
          alt="Life Plan Logo"
          @click="$emit('lists-toggle')"
        />
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/" class="nav-link">
              Задания
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/categories_settings" class="nav-link">
              Категории
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/themes_settings" class="nav-link">
              Темы
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/statistics" class="nav-link">
              Статистика
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/settings" class="nav-link">
              Настройки
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/help" class="nav-link">
              Помощь
            </router-link>
          </li>
        </ul>
        <HeaderButton icon="menu" class="d-xl-none"/>
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
