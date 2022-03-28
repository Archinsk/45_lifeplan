<template>
  <div>
    <TheHeader :theme="theme" />
    <div class="container">
      <h4>Темы</h4>
      <ThemesSelector
        :themes="themes"
        :lightness-mode="lightnessMode"
        @change-color-theme="$emit('change-color-theme', $event)"
        @change-dark-mode="$emit('change-dark-mode', $event)"
      />
      <ColorScheme :theme="theme" />
    </div>
  </div>
</template>

<script>
import TheHeader from "../components/TheHeader";
import ThemesSelector from "../components/ThemesSelector";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "ThemesView",
  components: {
    TheHeader,
    ThemesSelector,
    ColorScheme,
  },
  props: ["theme", "themes", "lightnessMode"],
};
</script>

<style scoped></style>
