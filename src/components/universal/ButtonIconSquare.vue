<template>
  <button type="button" class="buttonIconSquare btn" @click="$emit('clickHandler')">
    <span class="material-icons">{{ icon }}</span>
  </button>
</template>

<script>
export default {
  name: "ButtonIconSquare",
  props: ["icon"],
};
</script>
