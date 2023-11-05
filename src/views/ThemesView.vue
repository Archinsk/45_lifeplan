<template>
  <div>
    <div class="container">
      <h4>Темы</h4>
      <ThemesSelector
        :themes="themes"
        :theme="theme"
        :lightness-mode="lightnessMode"
        @change-color-theme="$emit('change-color-theme', $event)"
        @change-dark-mode="$emit('change-dark-mode', $event)"
      />
      <button
        :class="'btn btn-' + theme.primary"
        @click="$emit('save-color-themes')"
      >
        Применить тему
      </button>
      <ColorScheme :theme="theme" />
    </div>
  </div>
</template>

<script>
import ThemesSelector from "../components/ThemesSelector";
import ColorScheme from "../components/universal/ColorScheme";

export default {
  name: "ThemesView",
  components: {
    ThemesSelector,
    ColorScheme,
  },
  props: ["theme", "themes", "lightnessMode"],
};
</script>

<style scoped></style>
