<template>
  <div>
    <TheHeader :theme="theme" />
    <div class="container">
      <h4>Темы</h4>
      <ColorScheme :theme="theme" />
    </div>
  </div>
</template>

<script>
import TheHeader from "../components/TheHeader";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "ThemesView",
  components: {
    TheHeader,
    ColorScheme,
  },
  props: ["theme"],
};
</script>

<style scoped></style>
