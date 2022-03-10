<template>
  <div>
    <Header />
    <div class="container">
      <h4>Темы</h4>
      <ColorScheme />
    </div>
  </div>
</template>

<script>
import Header from "../components/TheHeader";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "ThemesView",
  components: {
    Header,
    ColorScheme,
  },
};
</script>

<style scoped></style>
