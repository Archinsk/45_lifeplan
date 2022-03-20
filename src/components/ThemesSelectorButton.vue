<template>
  <div
    :class="'btn btn-' + lightnessMode + '-' + theme.value + '-primary'"
    @click="$emit('change-color-theme')"
  >
    {{ theme.name }}
  </div>
</template>

<script>
export default {
  name: "ThemesSelectorButton",
  props: ["theme", "lightnessMode"],
};
</script>
