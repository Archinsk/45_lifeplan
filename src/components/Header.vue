<template>
  <header>
    <div class="container">
      <img id="logo" src="@/assets/lifeplan_logo.jpg" alt="Life Plan Logo" />
      <div>
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

<style scoped>
header {
  background-color: RGB(96, 192, 96);
  color: white;
}

header div {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

#logo {
  height: 4.5rem;
}

ul {
  list-style: none;
  padding-left: 0;
}
</style>
