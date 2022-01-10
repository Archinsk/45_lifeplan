<template>
  <button type="button" class="buttonIconSquare" @click="$emit('clickHandler')">
    <span class="material-icons">{{ icon }}</span>
  </button>
</template>

<script>
export default {
  name: "ButtonIconSquare",
  props: ["icon"],
};
</script>

<style scoped>
.buttonIconSquare {
  padding: 0;
  border: none;
}

.material-icons {
  padding: 0.6875rem;
}
</style>
