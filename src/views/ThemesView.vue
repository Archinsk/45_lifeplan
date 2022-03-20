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
      <button class="btn btn-primary">Button</button>
      <div class="bg-primary">background</div>
      <div class="text-primary">color-text</div>
      <button class="btn btn-white">Button</button>
      <div class="bg-white">background</div>
      <div class="text-white">color-text</div>
      <button class="btn btn-light-amethyst-primary">Button</button>
      <div class="bg-light-amethyst-primary">background</div>
      <div class="text-light-amethyst-primary">color-text</div>
      <button class="btn btn-light-neutral-300">Button</button>
      <div class="bg-light-neutral-300">background</div>
      <div class="text-light-neutral-300">color-text</div>
      <button class="btn btn-dark-neutral-700">Button</button>
      <div class="bg-dark-neutral-700">background</div>
      <div class="text-dark-neutral-700">color-text</div>
      <button class="btn btn-light-neutral-900">Button</button>
      <div class="bg-light-neutral-900">background</div>
      <div class="text-light-neutral-900">color-text</div>
      <button class="btn btn-dark-neutral-900">Button</button>
      <div class="bg-dark-neutral-900">background</div>
      <div class="text-dark-neutral-900">color-text</div>
      <div class="border border-light-neutral-900">border</div>
      <div class="border border-light-amethyst-primary">border</div>
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
