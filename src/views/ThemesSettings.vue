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
import Header from "../components/Header";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "ThemesSettings",
  components: {
    Header,
    ColorScheme,
  },
};
</script>

<style scoped></style>
