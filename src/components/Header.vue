<template>
  <header class="header bg-primary">
    <div class="container">
      <img id="logo" src="@/assets/lifeplan_logo.jpg" alt="Life Plan Logo" />
      <div class="nav">
        <HeaderButton :icon="menu" />
        <HeaderButton :icon="logout" />
      </div>
    </div>
  </header>
</template>

<script>
import HeaderButton from "@/components/HeaderButton";

export default {
  name: "Header",
  data() {
    return {
      menu: "menu",
      logout: "logout",
    };
  },
  components: {
    HeaderButton,
  },
};
</script>
