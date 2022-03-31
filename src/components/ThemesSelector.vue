<template>
  <div>
    <h4>Основная тема</h4>
    <div class="form-check form-switch">
      <input
        class="form-check-input"
        type="checkbox"
        role="switch"
        id="DarkModeSwitch"
        :checked="lightnessMode === 'dark'"
        @change="$emit('change-dark-mode', lightnessMode)"
      />
      <label class="form-check-label" for="DarkModeSwitch">Темная тема</label>
    </div>
    <div class="d-grid gap-2">
      <ThemesSelectorButton
        v-for="themesItem in themes"
        :theme="themesItem"
        :lightness-mode="lightnessMode"
        :key="themesItem.id"
        @change-color-theme="$emit('change-color-theme', themesItem.id)"
      />
    </div>
  </div>
</template>

<script>
import ThemesSelectorButton from "./ThemesSelectorButton";

export default {
  name: "ThemesSelector",
  components: {
    ThemesSelectorButton,
  },
  props: ["themes", "lightnessMode"],
  data() {
    return {};
  },
};
</script>
